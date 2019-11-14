<?php
include_once("../../includes/Jokes.php");

/* Get the Route */
$_ROOT                      =  dirname($_SERVER['SCRIPT_NAME']);
$BROUTE                     = explode("?",preg_replace("/".preg_quote($_ROOT,"/")."\//","",$_SERVER['REQUEST_URI']));
$ROUTE                      = $BROUTE[0];

/*Create the Object */
$jokeObject                 = new Jokes();
$return_array               = array();
$return_array['status']     = 404; // By Default we are a 404 unless they have a good route

/*Route Dependent Action */
switch (strtolower($ROUTE)) {

    // Return the Random Jokes as Json
    case "joke":
        $return_array['message']    = array();
        $jokes              = $jokeObject->get_random_jokes($_GET['num']);
        foreach ($jokes as $j) {
            $return_array['message'][] = $j->to_Array();
        }
        $return_array['status'] = 200;
        break;

    // Return How Many Jokes We Have
    case "jokecount":
        $return_array['message']    = array();
        $return_array['message']    = ['count'=>$jokeObject->get_number_jokes()];
        $return_array['status']     = 200;
        break;
    default:
        break;
}

header("Content-type: application/json");
echo json_encode($return_array);