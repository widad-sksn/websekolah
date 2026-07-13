import sqlite3
conn = sqlite3.connect('database/database.sqlite')
cursor = conn.cursor()
cursor.execute("SELECT name, sql FROM sqlite_master WHERE type='table'")
tables = cursor.fetchall()
for t in tables:
    print(f'--- {t[0]} ---')
    print(t[1])
    print()
