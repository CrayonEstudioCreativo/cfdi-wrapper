<?php
/**
 * Created by PhpStorm.
 * User: IROXIT
 * Date: 24/01/2017
 * Time: 03:32 PM
 */
use Aura\Autoload\Loader;

$loader = new Loader;
$loader->addPrefix('Crayon', __DIR__);
$loader->register();