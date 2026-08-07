import paramiko
import sys

if hasattr(sys.stdout, 'reconfigure'):
    sys.stdout.reconfigure(encoding='utf-8')

hostname = "167.99.69.239"
username = "root"
passwords = ["Keith082703.1", "Keith082703."]

ssh = paramiko.SSHClient()
ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())

for pwd in passwords:
    try:
        ssh.connect(hostname, username=username, password=pwd, timeout=10)
        break
    except:
        pass

def run(cmd):
    stdin, stdout, stderr = ssh.exec_command(cmd)
    return stdout.read().decode('utf-8', errors='ignore')

print("--- EXCEPTION MESSAGE FROM LOG ---")
print(run("grep -i 'exception' /var/www/bacsaymedsys/storage/logs/laravel.log | tail -n 10"))

print("\n--- LAST 30 LINES ---")
print(run("tail -n 35 /var/www/bacsaymedsys/storage/logs/laravel.log"))

ssh.close()
