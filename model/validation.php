<?php

/* validation.php
 * validate data for the cupcakes app
 *
 */

//Return true if name is valid
function validName($name)
{
    return strLen(trim($name)) > 0;
}

//Return true if at least one checkbox is selected
function validChoice($choices)
{
    return count($choices) > 0;
}