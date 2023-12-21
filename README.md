# WP Composed

This is a basic setup of WordPress, Composer (w/ WP Packagist), and Docker running on PHP 8.3, MySQL 8.2, phpMyAdmin, and nginx.

The goal is to make it easier to install and setup WordPress using proper version control, which is something that is generally more difficult to do in a default scenario of using the platform.

## WordPress

WordPress is setup to be installed via composer where packages are downloaded from [wpackagist.org](https://wpackagist.org/). All versions of WordPress, plugins, and themes are determined by `composer.json`

### Install Directories

`/app` Is there to make sure that the environment variables are loaded outside of the webroot, and gives a place for any other custom logic that may be needed during customization.

`/cms` Where all WordPress composer installations will happen,

`/cms/content` Where plugins and themes will be installed.

`/cms/core` WordPress core installation files.

`/docker` All docker related files go here, with appropriate subdirectories related each tech type.

## Usage

After cloning the repo, copy `/app/.env.example` to `/app/.env` and run `docker compose up --build -d`.

Then navigate to `http://localhost:4500` to complete the usual WordPress setup.

To use phpMyAdmin navigate to `http://localhost:4600`.

MySQL is Port forwarded `4506:3306` so port 4506 can be used by the host for database applications.

## Xdebug

If using xdebug, it is on port 9003. Set up your IDE accordingly for it. See the `/docker/php/xdebug.ini` for more info.

Here is an example VS Code `launch.json`

```JSON
{
  "version": "0.2.0",
  "configurations": [
    {
      "name": "WP Docker Xdebug",
      "type": "php",
      "request": "launch",
      "port": 9003,
      "pathMappings": {
        "/var/www/html": "${workspaceFolder}"
      },
      "xdebugSettings": {
        "max_data": 65535
      }
    }
  ]
}
```
