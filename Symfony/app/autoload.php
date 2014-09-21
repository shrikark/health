<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
//use Composer\Autoload\ClassLoader;
use Symfony\Component\ClassLoader\UniversalClassLoader;
/**
 * @var ClassLoader $loader
 */
 
//$loader = new UniversalClassLoader();
$loader = require __DIR__.'/../vendor/autoload.php';
//$loader->add('FOS', __DIR__.'/../vendor/bundles');
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));


return $loader;
