# AttendanceSystem

Attendance System

Simple Attendance System that records the time employee Log-ins and Logout, also records the Employee's Machine power-on and power-off.

This system is intended to be use as a service, perform features through respective API requests.

### Requirements:

-   Record Login/Logout of employee
-   Record PowerOn/PowerOff of employee's machine
-   Administrator to view the attendance records of each employees.

Entities:

-   users
    -   username
    -   password
-   roles
    -   id
    -   position
    -   permissions
-   user_roles
    -   role_id
    -   user_id
-   employees
    -   id
-   machines
    -   id
    -   MAC_Address
    -   employee_id
-   timelogs
    -   causer_type ( Entity Model of creator )
    -   causer_id ( Id of the creator )
    -   action [ time-in, time-out]
    -   created_at

### Installation steps:

1. Clone Repository
   `git clone https://github.com/ajDesamparado13/AttendanceSystem.git`
2. Install composer dependencies
   `composer install`
3. Install package dependencies
   `npm install`
4. Migrations and Seeders
   `php artisan migrate:refresh --seed`
5. Passport Installation
   `php artisan passport:install`
6. Running Mix
   `npm run dev`
   or ``npm run production` minified output...

7. `php artisan serve` or add your port `php artisan serve --port=8100`

8. Open your browser `http://127.0.0.1:8100/`
