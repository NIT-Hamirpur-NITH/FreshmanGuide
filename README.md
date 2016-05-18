========================
NITH Freshmen Guide
========================

This is a repository to store the website that is intended to be used by a fresher at NITH.
The website is under construction and will soon reach a alpha phase.


[![Join the chat at https://gitter.im/Nithmr/FreshmanGuide](https://badges.gitter.im/Nithmr/FreshmanGuide.svg)](https://gitter.im/Nithmr/FreshmanGuide?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
=======
To setup the development environment for the project, follow the instructions given below.

First of all, you need to install [Laravel](https://laravel.com) to run this project on your localhost.

Installation of Laravel
------------------------
To install Laravel, you need to install composer which is utilized by Laravel to manage its dependencies.
To install composer, download the composer [installer](https://getcomposer.org/installer) from this link:
https://getcomposer.org/installer

The installation of composer using the below steps is local installation, which means that composer would be available in your working directory only.

To begin with installation of composer, run the installer using:

`php installer`

This will check some settings on your machine and download a file `composer.phar` required for installation.
Now, to install Laravel using composer, execute the following command on the terminal:

`php composer.phar composer global require "laravel/installer"`

Once the Laravel is installed, download this project and change your working directory to FreshmanGuide.<br>
Execute the following command to install all the dependencies required by the project.

`php composer.phar install`

Before running the project, you need to generate an application key for your clone of the project. Rename .env.example file to .env and then generate the key by running the following command:

`php artisan key:generate`

Now, you are ready to run the website on your localhost. Type `php artisan serve` to do that.



In case of any problems, feel free to share them with us in the gitter chat room.
Keep contributing!
