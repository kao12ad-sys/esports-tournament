# Project Note: Esports Tournament

เอกสารนี้สรุปสถานะโปรเจค `esports-tournament` ณ ตอนนี้ เพื่อให้ทีมเข้าใจภาพรวมตรงกันก่อนพัฒนาต่อ

## ภาพรวมโปรเจค

โปรเจคนี้เป็นระบบจัดการแข่งขันอีสปอร์ตระดับประเทศ พัฒนาด้วย CodeIgniter 4 และ MySQL สำหรับบริหารข้อมูลการแข่งขัน ทีม ผู้สมัคร ตารางแข่งขัน สมาชิก และรายงาน

ระบบแบ่งหน้าการใช้งานหลักเป็น 3 ส่วน:

- Frontend สำหรับผู้เข้าชมทั่วไป
- Admin สำหรับผู้ดูแลระบบที่ path `/adminz`
- Member สำหรับผู้จัดการทีม ผู้ฝึกสอน และนักกีฬา

## เทคโนโลยีที่ใช้

- PHP 8.2 จาก XAMPP
- CodeIgniter 4.7.2
- MySQL / MariaDB จาก XAMPP
- Apache จาก XAMPP
- Git สำหรับ version control

## URL หลัก

- หน้าแรก: `http://localhost/esports-tournament/`
- รายการแข่งขัน: `http://localhost/esports-tournament/tournaments`
- Login member: `http://localhost/esports-tournament/login`
- Login admin: `http://localhost/esports-tournament/adminz/login`
- Admin dashboard: `http://localhost/esports-tournament/adminz/`
- Member dashboard: `http://localhost/esports-tournament/member/`

## Template ที่ใช้งาน

Frontend ใช้ template จาก:

`template/html/index.html`

Admin ใช้ template จาก:

`templates/source/index.html`

หน้า login admin ใช้ asset จาก admin template:

`templates/source/login.html`

ระบบมีการ rewrite asset path ใน controller เพื่อให้ template เดิมสามารถรันผ่าน URL ของ CodeIgniter ได้

## ฐานข้อมูล

ฐานข้อมูลที่ใช้:

`esports_tournament`

ค่าตั้งต้น local อยู่ใน `.env` แต่ไฟล์นี้ไม่ถูก commit เข้า Git เพื่อความปลอดภัย ให้ดูตัวอย่างจาก `.env.example`

ตารางหลักที่สร้างแล้ว:

- `users`
- `teams`
- `member_profiles`
- `team_histories`
- `tournaments`
- `registrations`
- `match_schedules`
- `migrations`

Migration หลัก:

`app/Database/Migrations/2026-05-02-000001_CreateTournamentSchema.php`

Seeder เริ่มต้น:

`app/Database/Seeds/InitialSeeder.php`

## บัญชีทดสอบ

รหัสผ่านทุกบัญชีทดสอบคือ:

`Password@123`

บัญชีที่ seed ไว้:

- Admin: `admin@example.test`
- ผู้จัดการทีม: `manager@example.test`
- ผู้ฝึกสอน: `coach@example.test`
- นักกีฬา: `player@example.test`

## Role ในระบบ

Role ที่รองรับตอนนี้:

- `admin`
- `team_manager`
- `coach`
- `amateur_athlete`
- `pro_athlete`

Admin มีสิทธิ์เข้าถึง `/adminz/*`

Member roles ได้แก่ `team_manager`, `coach`, `amateur_athlete`, `pro_athlete` มีสิทธิ์เข้าถึง `/member/*`

หมายเหตุเรื่องการสร้างบัญชี:

- สมาชิกสมัครเองผ่าน `/register` ได้เฉพาะ `amateur_athlete` และ `pro_athlete`
- Role `team_manager` และ `coach` ต้องให้ admin เป็นผู้สร้างหรือกำหนดสิทธิ์เท่านั้น

## ฟีเจอร์ฝั่ง Admin

เมนู Admin ที่ทำแล้ว:

- Dashboard
- จัดการข้อมูลการแข่งขัน
- เพิ่มการแข่งขัน
- แสดงข้อมูลการแข่งขัน
- จัดการข้อมูลผู้จัดการทีม
- จัดการข้อมูลนักกีฬา
- จัดการข้อมูลนักกีฬาทั่วไป
- จัดการข้อมูลทีม
- จัดการข้อมูลผู้สมัครแข่งขัน
- จัดการข้อมูลตารางแข่งขัน
- ออกรายงาน
- ออกจากระบบ

ข้อมูลการแข่งขันรองรับ field หลัก:

- ชื่อการแข่งขัน
- ชื่อเกมที่แข่งขัน
- ประเภทการแข่งขัน: เดี่ยวหรือทีม
- รุ่นการแข่งขัน
- เกณฑ์การรับสมัคร
- กฏกติกา
- รูปแบบการแข่งขัน
- สถานที่การแข่งขัน
- วันที่เปิด/ปิดรับสมัคร
- วันที่เริ่ม/จบการแข่งขัน
- สถานะการแข่งขัน

## ฟีเจอร์ฝั่ง Member

Member สามารถ:

- ดู dashboard ทีมตัวเอง
- ดูข้อมูลทีม
- แก้ไขข้อมูลทีมได้เฉพาะ role `team_manager`
- แก้ไขข้อมูลส่วนตัว
- ดูรายการแข่งขัน
- สมัครแข่งขัน
- ตรวจสอบสถานะการเข้าร่วมการแข่งขัน
- ดูรายงานทีม
- ดูตารางแข่งขันที่เกี่ยวข้องกับทีม
- ดูประวัติการย้ายทีมจาก `team_histories`

## ความปลอดภัยที่ทำแล้ว

- ใช้ `password_hash()` และ `password_verify()` สำหรับรหัสผ่าน
- ใช้ session authentication
- regenerate session หลัง login
- มี `AuthFilter` ตรวจ login และ role
- เปิด CSRF filter
- เปิด secure headers filter
- `.env` ถูก ignore ไม่ให้ push ขึ้น Git
- session/log/debugbar ถูก ignore ไม่ให้เก็บใน Git
- `.htaccess` ป้องกันเข้าถึงไฟล์/โฟลเดอร์สำคัญบางส่วน

## Git / Version Control

ติดตั้ง Git และสร้าง repo แล้ว

Branch หลัก:

`main`

Remote GitHub:

`https://github.com/kao12ad-sys/esports-tournament.git`

Commit สำคัญ:

- `4799f51` Initial CodeIgniter esports tournament app
- `fcfd3a4` Add Thai admin management menu

## วิธี setup สำหรับเครื่องใหม่

1. Clone repo

```powershell
git clone https://github.com/kao12ad-sys/esports-tournament.git
```

2. วางโปรเจคไว้ใน XAMPP เช่น:

```text
C:\xampp\htdocs\esports-tournament
```

3. Copy `.env.example` เป็น `.env`

4. ตั้งค่าฐานข้อมูลใน `.env`

5. สร้างฐานข้อมูล

```powershell
C:\xampp\mysql\bin\mysql.exe -u root -p -e "CREATE DATABASE IF NOT EXISTS esports_tournament CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

6. รัน migration และ seeder

```powershell
C:\xampp\php\php.exe spark migrate
C:\xampp\php\php.exe spark db:seed InitialSeeder
```

7. เปิด Apache และ MySQL ใน XAMPP

8. เข้าใช้งานผ่าน:

`http://localhost/esports-tournament/`

## สิ่งที่ควรพัฒนาต่อ

- แยก admin dashboard จาก template static ให้เป็น view/component ของ CodeIgniter เต็มรูปแบบ
- ทำ CRUD แยกละเอียดสำหรับผู้จัดการทีม ผู้ฝึกสอน นักกีฬาทั่วไป และนักกีฬาอาชีพ
- เพิ่มระบบอนุมัติ/ตรวจเอกสารผู้สมัครแข่งขัน
- เพิ่มระบบจัด bracket หรือ match result ที่ละเอียดขึ้น
- เพิ่ม export รายงานเป็น PDF/Excel
- เพิ่มระบบ upload รูปทีม/รูปนักกีฬา
- เพิ่ม audit log สำหรับ action สำคัญของ admin
- เพิ่ม validation รายละเอียดทุก form
- เพิ่ม pagination และ search ในหน้ารายการ
- เพิ่ม test coverage สำหรับ auth, role, registration และ schedule
