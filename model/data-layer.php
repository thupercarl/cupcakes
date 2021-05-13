<?php

/* data-layer.php
 *Return data for the cupcakes app
 *
 */

// Get the meals for the order form
function getFlavors()
{
    $arr = array();
    $arr['grasshopper'] = 'The Grasshopper';
    $arr['maple'] = 'Whiskey Maple Bacon';
    $arr['carrot'] = 'Carrot Walnut';
    $arr['caramel'] = 'Salted Caramel Cupcake';
    $arr['velvet'] = 'Red Velvet';
    $arr['lemon'] = 'Lemon Drop';
    $arr['tiramisu'] = 'Tiramisu';
    return $arr;
}
