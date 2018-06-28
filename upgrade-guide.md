# VanDango 1.0.0
###### Production Date: 2017-09-01
This upgrade includes...

- Introduction of Blink, the enquiries and vacancies managing system.
- Integration with NAS Soap Service Interface

#### Steps
- Migrate new tables
- Add NAS, TP, AVA env variables
- Add new job role 'Vacancy Approver'
- Run `sudo service apache2 restart` to ensure new variables are loaded
- Ensure application has permission to write to the storage directory, if not run `sudo chmod -R 777 storage/`
- Add BLINK_ADMIN_EMAIL env variable