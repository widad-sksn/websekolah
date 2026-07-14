import paramiko

client = paramiko.SSHClient()
client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
client.connect(hostname='192.168.33.238', username='root', password='r00tunisa', timeout=10)

command = """cd /var/www/websekolah && php artisan tinker --execute="App\Models\Page::firstOrCreate(['slug' => 'profil-sekolah'], ['title' => 'Profil Sekolah', 'content' => '<p>Konten Profil Sekolah sedang disiapkan.</p>', 'status' => 'published']); App\Models\Page::firstOrCreate(['slug' => 'sejarah-sekolah'], ['title' => 'Sejarah Sekolah', 'content' => '<p>Konten Sejarah Sekolah sedang disiapkan.</p>', 'status' => 'published']); App\Models\Page::firstOrCreate(['slug' => 'visi-misi'], ['title' => 'Visi & Misi', 'content' => '<p>Konten Visi & Misi sedang disiapkan.</p>', 'status' => 'published']);" """

stdin, stdout, stderr = client.exec_command(command)
print("STDOUT:", stdout.read().decode('utf-8', errors='ignore'))
print("STDERR:", stderr.read().decode('utf-8', errors='ignore'))
