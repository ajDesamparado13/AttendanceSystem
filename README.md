# AttendanceSystem
Attendance System

Simple Attendance System that records the time employee Log-ins and Logout, also records the Employee's Machine power-on and power-off.

This system is intended to be use as a service, perform features through respective API requests.

### Requirements:
- Record Login/Logout of employee
- Record PowerOn/PowerOff of employee's machine
- Administrator to view the attendance records of each employees.

Entities:
- users
  - username
  - password
- roles
  - id
  - position
  - permissions
- user_roles
  - role_id
  - user_id
- employees
  - id
- machines
  - id
  - MAC_Address
  - employee_id
- timelogs
  - causer_type ( Entity Model of creator )
  - causer_id   ( Id of the creator )
  - action [ time-in, time-out]
  - created_at
