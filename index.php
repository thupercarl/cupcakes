<?php

//This is my controller for the diner project

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
$f3->route('GET /', function(){

    //Initialize variables for user input
    $userFlavors = array();

    //If the form has been submitted, validate the data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //If condiments are selected
        if (!empty($_POST['flavors'])) {

            //Get user input
            $userFlavors = $_POST['flavors'];

            //If condiments are valid
            if (validFlavors($userFlavors)) {
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

});

//Run Fat-Free
$f3->run();