# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:



- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

- - - -

# Setting Up the CodeIgniter Project on a Local Machine

To set up a CodeIgniter 4 project on another local machine, follow these steps:

### Prerequisites

1. Ensure the following requirements are met before starting:

PHP: Version 8.1 or higher is required. Check your PHP version with:
```php -v
```

2. Required PHP Extensions:

> - intl: For internationalization.
> - mbstring: For handling multibyte strings.
> - json (enabled by default).
> - mysqlnd: Needed if using MySQL.
> - libcurl: Required if using HTTP\CURLRequest library.

3. Composer: This is required to manage dependencies. If it is not installed, download it from getcomposer.org.

## Step-byStep Setup Guide

1. Clone or Copy the Project Files

- If you’re copying a project, transfer all project files to the desired directory on the local machine.
- If using Git, clone the repository:

```git clone <repository_url>
cd <project_directory>
```

2. Install Dependencies

- Run the following command to install dependencies:
```composer install
```

- To check for and apply updates to dependencies, run:
```composer update
```

3. Configure Environment Variables

- Copy the provided env file to create a .env file in the project’s root directory:
```cp env .env
```

- Open .env and adjust settings based on your environment:
> - App Base URL: Update app.baseURL to reflect the local environment.
> - Database: Configure your database settings under database.default for the local database connection:

```database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = your_database_user
database.default.password = your_database_password
database.default.DBDriver = MySQLi # Change if you're using another DB driver
```

4. Set Up the Database

- If your project includes database migrations or seed files, run these commands to set up the database schema:
```php spark migrate
php spark db:seed <SeederClassName>  # Optional, if seeder classes are available
```

## Set Up Web Server
- By default, CodeIgniter 4’s index.php is located inside the public folder for security reasons. Point your server’s root directory to this public folder, not the project root.
- If using Apache or Nginx, configure a virtual host to point to the public directory.
- Using PHP’s Built-In Server: If you don’t have a configured web server, you can use PHP’s built-in server for development:

```php spark serve
```
By default, this will start the server on http://localhost:8080. You can access the application there.

6. Verify Permissions

- Make sure that the writable directory in the project has appropriate write permissions, as CodeIgniter will store cache files, session files, and logs here:
```chmod -R 775 writable/
```

7. Testing the Application

- After setting up, navigate to the base URL of the application in your browser (e.g., http://localhost:8080 or your configured local server address) to confirm that the application runs successfully.

## Troubleshooting Tips

- Check PHP Extensions: Use php -m to list installed PHP modules and verify required extensions are enabled.
- Review Logs: Any issues encountered should be recorded in the writable/logs directory, where you can review error logs to troubleshoot.
- Verify Database Connection: Double-check .env file database settings and ensure the local database server is running.
