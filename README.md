# CoderHub.me
---
CoderHub is an exciting new social media site that allows Software Engineers to not only display a resume, cite work that they have participated in, connect with their GitHub, but also connect with prospective employers and allowing them to see this information. Through these connections users will be able to start networking with organizations that are looking to hire new employees.

## Installation Instructions

CoderHub.me was built using the CodeIgniter framework and styled using the AdminLTE theme. To install CoderHub on your own system, please folow the instructions below:

**Prerequisites**
- LAMP stack
  - Linux (Tested on Ubuntu 14.04.4)
  - Apache2
  - MySQL
  - PHP5

**Instructions** 

1. Clone this repo into the directory of your choice. Commonly, you will use `/var/www/`. 
2. Configure Apache
  - Create and enable a configuration file and set the DocumentRoot to `/var/www/public`. See the sample.conf file in the installation directory of this repo
  - Enable the Apache2 ReWrite mod using the command `sudo a2enmod rewrite`
3. Configure the database
  - Run the following command to configure the database `mysql < installation/database_install_script.sql`
4. Configure the application
  - Go to the `codeigniter/application/config` directory
  - Open `database.php.default` and fill out the details for your database (hostname, username, password)
  - Rename the file `database.php.default` to `database.php`
  - Open the `config.php.default` and change the `$config['base_url']` to the url of your system.
  - Rename the file `config.php.default` to `config.php`
