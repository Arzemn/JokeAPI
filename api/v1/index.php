<?php

$_ROOT                      =  dirname($_SERVER['SCRIPT_NAME']);
$BROUTE                     = explode("?",preg_replace("/".preg_quote($_ROOT,"/")."\//","",$_SERVER['REQUEST_URI']));
$ROUTE                      = $BROUTE[0];
include_once("../../includes/Jokes.php");
$jokeObject                 = new Jokes();
header("Content-type: application/json");
$return_array               = array();
$return_array['status']     = 404;
switch (strtolower($ROUTE)) {
    case "joke":
        $return_array['message']    = array();
        $jokes              = $jokeObject->get_random_jokes($_GET['num']);
        foreach ($jokes as $j) {
            $return_array['message'][] = $j->to_Array();
        }
        $return_array['status'] = 200;
        break;
    case "jokecount":
        $return_array['message']    = ['count'=>$jokeObject->get_number_jokes()];

        $return_array['status'] = 200;
        break;
    default:
        break;
}


echo json_encode($return_array);