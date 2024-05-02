<?php

// 328/quiz/index.php
// This is my CONTROLLER!

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require necessary files
require_once ('vendor/autoload.php');
require_once('model/data-layer.php');

// Instantiate the F3 Base class
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function() {
    // echo '<h1>Hello Quiz!</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// survey route
$f3->route('GET /survey', function($f3) {
    // echo '<h1>Hello survey!</h1>';


    // Get the data from the model
    // and add it to the F3 hive
    $options = getOptions();
    $f3->set('options', $options);

    // Render a view page
    $view = new Template();
    echo $view->render('views/survey.html');
});

// Run Fat-Free
$f3->run();