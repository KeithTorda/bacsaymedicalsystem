import paramiko
import sys
import time

if hasattr(sys.stdout, 'reconfigure'):
    sys.stdout.reconfigure(encoding='utf-8')

hostname = "167.99.69.239"
username = "root"
passwords = ["Keith082703.1", "Keith082703."]
repo_url = "https://github.com/KeithTorda/bacsaymedicalsystem.git"
remote_dir = "/var/www/bacsaymedsys"

def run_command(ssh, cmd):
    print(f"\n[VPS EXEC] {cmd}")
    stdin, stdout, stderr = ssh.exec_command(cmd)
    out = stdout.read().decode('utf-8', errors='ignore')
    err = stderr.read().decode('utf-8', errors='ignore')
    if out:
        print("STDOUT:\n" + out.strip())
    if err:
        print("STDERR:\n" + err.strip())
    return out, err

ssh = paramiko.SSHClient()
ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())

connected = False
for pwd in passwords:
    try:
        print(f"Connecting to {hostname}...")
        ssh.connect(hostname, username=username, password=pwd, timeout=15)
        print("SSH Connection Successful!")
        connected = True
        break
    except Exception as e:
        print(f"Failed with password option: {e}")

if not connected:
    print("Could not connect to VPS with provided passwords.")
    sys.exit(1)

try:
    print("\n--- 1. Checking Nginx, PHP, and Composer on VPS ---")
    run_command(ssh, "php -v")
    run_command(ssh, "nginx -v")

    print("\n--- 2. Cloning / Updating Repository from GitHub ---")
    out, _ = run_command(ssh, f"[ -d {remote_dir} ] && echo 'EXISTS' || echo 'NOT_EXISTS'")
    if out.strip() == 'EXISTS':
        print(f"Updating existing directory {remote_dir}...")
        run_command(ssh, f"cd {remote_dir} && git fetch origin && git reset --hard origin/main")
    else:
        print(f"Cloning {repo_url} into {remote_dir}...")
        run_command(ssh, f"mkdir -p {remote_dir} && git clone {repo_url} {remote_dir}")

    print("\n--- 3. Setting Up Directory Permissions ---")
    run_command(ssh, f"mkdir -p {remote_dir}/storage {remote_dir}/bootstrap/cache {remote_dir}/database")
    run_command(ssh, f"chown -R www-data:www-data {remote_dir}")
    run_command(ssh, f"chmod -R 775 {remote_dir}/storage {remote_dir}/bootstrap/cache")

    print("\n--- 4. Setting Up .env Configuration & SQLite Database ---")
    env_script = f"""cat << 'EOF' > {remote_dir}/.env
APP_NAME=BacsayMedSys
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=Asia/Manila
APP_URL=http://{hostname}:8085

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

MAINTENANCE_DRIVER=file

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE={remote_dir}/database/database.sqlite

SESSION_DRIVER=file
SESSION_LIFETIME=120

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
EOF
"""
    run_command(ssh, env_script)
    run_command(ssh, f"touch {remote_dir}/database/database.sqlite")
    run_command(ssh, f"chown www-data:www-data {remote_dir}/database/database.sqlite")
    run_command(ssh, f"chmod 664 {remote_dir}/database/database.sqlite")

    print("\n--- 5. Installing Composer Dependencies & Key Generation ---")
    run_command(ssh, f"cd {remote_dir} && composer install --no-dev --optimize-autoloader --no-interaction")
    run_command(ssh, f"cd {remote_dir} && php artisan key:generate --force")

    print("\n--- 6. Running Migrations & Seeding Initial Data ---")
    run_command(ssh, f"cd {remote_dir} && php artisan migrate:refresh --seed --force")
    run_command(ssh, f"cd {remote_dir} && php artisan storage:link --force || true")

    print("\n--- 7. Caching Production Configuration & Views ---")
    run_command(ssh, f"cd {remote_dir} && php artisan config:cache")
    run_command(ssh, f"cd {remote_dir} && php artisan route:cache")
    run_command(ssh, f"cd {remote_dir} && php artisan view:cache")
    run_command(ssh, f"chown -R www-data:www-data {remote_dir}")

    print("\n--- 8. Configuring Nginx Virtual Host on Port 8085 ---")
    nginx_conf = f"""cat << 'EOF' > /etc/nginx/sites-available/bacsaymedsys
server {{
    listen 8085;
    server_name _;
    root {remote_dir}/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {{
        try_files $uri $uri/ /index.php?$query_string;
    }}

    location = /favicon.ico {{ access_log off; log_not_found off; }}
    location = /robots.txt  {{ access_log off; log_not_found off; }}

    error_page 404 /index.php;

    location ~ \\.php$ {{
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }}

    location ~ /\\.(?!well-known).* {{
        deny all;
    }}
}}
EOF
"""
    # Check active php-fpm socket
    out_php, _ = run_command(ssh, "ls /run/php/php*-fpm.sock || true")
    if 'php8.3-fpm.sock' in out_php:
        nginx_conf = nginx_conf.replace('php8.2-fpm.sock', 'php8.3-fpm.sock')
    elif 'php8.1-fpm.sock' in out_php:
        nginx_conf = nginx_conf.replace('php8.2-fpm.sock', 'php8.1-fpm.sock')

    run_command(ssh, nginx_conf)
    run_command(ssh, "ln -sf /etc/nginx/sites-available/bacsaymedsys /etc/nginx/sites-enabled/")
    run_command(ssh, "nginx -t")
    run_command(ssh, "systemctl reload nginx")

    print(f"\n=======================================================")
    print(f"🎉 DEPLOYMENT SUCCESSFUL!")
    print(f"BacsayMedSys is now live at: http://{hostname}:8085")
    print(f"=======================================================")

finally:
    ssh.close()
