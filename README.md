
---

### Requirements

- XAMPP (for Apache & PHP)  
- PostgreSQL (v15 or higher)  
- pgAdmin 4 (for database management)

---

### Enable PostgreSQL Extension in PHP
1. Open the file: C:\xampp\php\php.ini
2. Find and **uncomment** (remove the `;` at the beginning) of the following lines:
    extension=pdo_pgsql
    extension=pgsql
3. Save the file and **restart Apache** from XAMPP Control Panel.

---

### Setup PostgreSQL
- user: postgres
- pass: mypass123
