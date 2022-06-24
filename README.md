
## How to start with PHP 70 MVC


## Project setup
```
composer install
```

### Project config
```
cp config.php  wp-config.php
```
Copy the example config file and set project congigurations

### Project database
```
php App/Database/InstallTables.php
```
Go to App/Database and run InstallTables.php file to install database tables

### Project data
```
php App/Database/InstallData.php
```
Go to App/Database and run InstallData.php file to install dummy Data

### Find Admin user details in your terminal after installing Data or in the Data files

## And here you go...
