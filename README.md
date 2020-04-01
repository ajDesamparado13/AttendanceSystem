# AttendanceSystem
Attendance System

Simple Attendance System that records the time employee Log-ins and Logout, also records the Employee's Machine power-on and power-off.


Entities:
- User
  - username
  - password
- Employee
  - id
  - user_id
- Machine
  - id
  - MAC_Address
- Timelogs
  - causer_type ( Entity Model of creator )
  - causer_id   ( Id of the creator )
  - action [ time-in, time-out]
  - created_at
