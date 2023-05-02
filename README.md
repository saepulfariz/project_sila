# Project SILA

## Tutorial Setup

1. **`git clone https://github.com/saepulfariz/project_sila.git`**
2. **`cd project_sila`**
3. **`composer update`**
4. copy env to .env
5. Create database in http://localhost/phpmyadmin with name project_sila
6. open cmd **`php spark migrate`** for migrate database or **`php spark migrate:rollback`** for rollback database
7. input again **`php spark db:seed all`** for seed database
8. next **`php spark serve`** for running project
9. visit http://localhost:8080

## User login

Role

1. Admin
2. Staff
3. Pimpinan
4. Mahasiswa

User

1. username : admin && password : 123
2. username : staff && password : 123
3. username : pimpinan && password : 123
4. username : penni && password : 123
5. username : ilham && password : 123

# by saepulfariz - PROFA ( Programmer Fasilkom )
