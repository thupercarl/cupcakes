<?php

/* validation.php
 * validate data for the cupcakes app
 *
 */

//Return true if name is valid
function validName($name)
{
    return strLen(trim($name)) >= 2;
}

//Return true if *all* choices are valid
function validChoice($choices)
{
    $validChoices = getFlavors();

    //Make sure each selected choice is valid
    foreach ($choices as $userChoice) {
        if (!in_array($userChoice, $validChoices)) {
            return false;
        }
    }

    //All choices are valid
    return true;
}