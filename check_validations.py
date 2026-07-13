import glob, re
for f in glob.glob('app/Http/Controllers/Admin/*.php'):
    with open(f, 'r') as file:
        content = file.read()
        match = re.search(r'validate\(\[\s*(.*?)\s*\]\)', content, re.DOTALL)
        if match:
            print(f'--- {f} ---')
            print(match.group(1))
            print()
