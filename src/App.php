#!/usr/bin/env php
<?php

/**
 * App.php - created Nov 11, 2015 10:22:01 AM
 *
 * @author Ahmed Waqar Alam
 *
 */
require __DIR__ . '/../vendor/autoload.php';

use sainsburyswebscraper\Commands\ProductOverviewCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new ProductOverviewCommand());
$application->run();
