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
$f3->route('GET /', function($f3){

    //Initialize variables for user input
    $userFlavors = array();
    $userName = array();

    //If the form has been submitted, validate the data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //If flavors are selected
        if (!empty($_POST['name'])) {

            //Get user input
            $userName = $_POST['name'];

            //If flavors are valid
            if (validName($userName)) {
                $_SESSION['name'] = implode(", ", $userName);
            } else {
                $f3->set('errors["name"]', 'Invalid selection');
            }
        }

        //If flavors are selected
        if (!empty($_POST['flavors'])) {

            //Get user input
            $userFlavors = $_POST['flavors'];

            //If flavors are valid
            if (validChoice($userFlavors)) {
                $_SESSION['flavors'] = implode(", ", $userFlavors);
            } else {
                $f3->set('errors["flavors"]', 'Invalid selection');
            }
        }

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

//Run Fat-Free
$f3->run();