<?php

/**
 * Fruitify Main Index
 *
 * @package fruitBin
 * @author Fruitify
 * @link https://github.com/Fruitify
 * @link https://github.com/Fruitify/fruitBin
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load the (optional) Composer auto-loader (if we end up needing composer)
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

// load fruitify configuration 
require 'app/config/config.php';

// load application class
require 'app/libs/application.php';
require 'app/libs/controller.php';

// start the application
$app = new Application();
