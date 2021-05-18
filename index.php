<?php

//This is my controller for the cupcakes project

//Turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require necessary files
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Define default route
$f3->route('GET|POST /', function($f3){

    //Reinitialize session array
    $_SESSION = array();

    //Initialize variables for user input
    $userName = "";
    $userFlavors = array();

    //If the form has been submitted, validate the data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        $userName = $_POST['name'];

        //If name is valid, store data
        if(validName($_POST['name'])) {
            $_SESSION['name'] = $userName;
        }
        //Otherwise, set an error variable in the hive
        else {
            $f3->set('errors["name"]', 'Please enter a name');
        }

        //If flavors are selected
        if (!empty($_POST['flavors'])) {

            //Get user input
            $userFlavors = $_POST['flavors'];

            //If flavors are valid
            if (validChoice($userFlavors)) {
                $_SESSION['flavors'] = $userFlavors;
                //$_SESSION['flavors'] = implode(", ", $userFlavors);
            }
            else {
                $f3->set('errors["flavors"]', 'Invalid selection');
            }
        }
        else {
            $f3->set('errors["flavors"]', 'Invalid selection');
        }

        //calc total
        $total = count($userFlavors) * 3.50;
        $_SESSION['total'] = $total;

        //If the error array is empty, redirect to summary page
        if (empty($f3->get('errors'))) {
            header('location: summary');
        }
    }

    //Get the flavors from the Model and send them to the View
    $f3->set('flavors', getFlavors());

    //Add the user data to the hive
    $f3->set('flavors', $userFlavors);

    //Display the second order form
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET /summary', function(){

    //Display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run Fat-Free
$f3->run();