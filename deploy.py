import paramiko

client = paramiko.SSHClient()
client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
client.connect(hostname='192.168.33.238', username='root', password='r00tunisa', timeout=10)

stdin, stdout, stderr = client.exec_command('cd /var/www/websekolah && git pull origin main && npm run build && php artisan view:clear && php artisan migrate --force')
print(stdout.read().decode('utf-8', errors='ignore'))
print(stderr.read().decode('utf-8', errors='ignore'))
