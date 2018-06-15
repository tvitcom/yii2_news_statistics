This is webapp - show statistic for posts, as testcase yii2-applications.

REQUIREMENTS
------------

- PHP 5.6 and above.
- MariaDB 10.0.32 - with readline 5.2.

INSTALLATION
------------

### Install  Composer and via Composer:
0. Download composer installer:
```
curl -sS https://getcomposer.org/installer | php;
```
1. From app folder:
~~~
php composer.phar update
~~~

2. Create database: 'nisa' with user 'nisa' and password: 'pass_to_nisa'

Then run:
3.
```
php yii migrate
```
4. Make secret file:
```
touch config/secret.php
```
5. Edit this file with code above:
```<?php
return '<secret random string goes here>';

```
6. You can then access the application through the following URL:

~~~
http://localhost/
~~~
