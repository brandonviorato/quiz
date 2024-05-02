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
$f3->route('GET|POST /survey', function($f3) {
    // echo '<h1>Hello survey!</h1>';

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Get the data from the post array
        if (isset($_POST['name']) and isset($_POST['options'])) {
            $name = $_POST['name'];
            $selectedOptions = implode(", ", $_POST['options']);
        }
        else {
            $name = "Not entered";
            $selectedOptions = "None selected";
        }

        // add data to session array
        $f3->set('SESSION.name', $name);
        $f3->set('SESSION.options', $selectedOptions);

        // send the user to next form
        $f3->reroute('summary');
    }

    // Get the data from the model
    // and add it to the F3 hive
    $options = getOptions();
    $f3->set('options', $options);

    // Render a view page
    $view = new Template();
    echo $view->render('views/survey.html');
});

// Survey summary
$f3->route('GET /summary', function($f3) {

    //var_dump($f3->get('SESSION'));

    // render a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$f3->run();