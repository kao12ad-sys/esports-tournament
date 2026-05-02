# Esports Tournament

CodeIgniter 4 + MySQL system for national esports tournament management.

## Local Setup

1. Start Apache and MySQL in XAMPP.
2. Copy `.env.example` to `.env` and set the local database password.
3. Create the database if needed:

```powershell
C:\xampp\mysql\bin\mysql.exe -u root -p -e "CREATE DATABASE IF NOT EXISTS esports_tournament CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

4. Run migrations and seed data:

```powershell
C:\xampp\php\php.exe spark migrate
C:\xampp\php\php.exe spark db:seed InitialSeeder
```

## URLs

- Frontend: `http://localhost/esports-tournament/`
- Admin login: `http://localhost/esports-tournament/adminz/login`
- Member login: `http://localhost/esports-tournament/login`

## Default Test Users

- Admin: `admin@example.test` / `Password@123`
- Team manager: `manager@example.test` / `Password@123`
- Coach: `coach@example.test` / `Password@123`
- Athlete: `player@example.test` / `Password@123`
