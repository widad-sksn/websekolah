import paramiko

client = paramiko.SSHClient()
client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
client.connect(hostname='192.168.33.238', username='root', password='r00tunisa', timeout=10)

stdin, stdout, stderr = client.exec_command('sed -i \'s/APP_NAME=Laravel/APP_NAME="MTs MUGADA Sumberagung"/g\' /var/www/websekolah/.env')
print(stdout.read().decode())
print(stderr.read().decode())

stdin, stdout, stderr = client.exec_command('cd /var/www/websekolah && php artisan config:clear && php artisan cache:clear && php artisan view:clear')
print(stdout.read().decode())
print(stderr.read().decode())
