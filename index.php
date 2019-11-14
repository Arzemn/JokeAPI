<?php
include_once("includes/consume_rest.php");
include_once("includes/Jokes.php");
$count_response = consume_joke("http://localhost".dirname($_SERVER['SCRIPT_NAME'])."/api/v1/jokecount");

?>
<HTML>
<HEAD>
    <TITLE>The Jokester</TITLE>
</HEAD>
<BODY>
<FORM name="consume">
   Select Number of Jokes Needed for Laughter Threshold<BR>
    <SELECT name="num">
        <?php
        if ($count_response['status'] == '200') {
            for ($i = 0; $i < $count_response['message']['count']; $i++) {
                $selected = "";
                if (($i + 1) == $_GET['num']) {
                    $selected = "SELECTED";
                }
                ?>

                <OPTION VALUE="<?php echo($i + 1); ?>" <?php echo $selected; ?>><?php echo($i + 1); ?></OPTION>
                <?php
            }
        }
        ?>

    </SELECT>
    <INPUT TYPE="SUBMIT" value="Make Me Laugh">
</FORM>
<PRE>
<?php

if (isset($_GET['num'])) {
    $response = consume_joke("http://localhost".dirname($_SERVER['SCRIPT_NAME'])."/api/v1/joke?num=".$_GET['num']);
    $count = 0;
    foreach ($response['message'] as $r) {
        $count++;
        echo "Joke $count\nQuestion:\t".$r['question']."\nPunchline:\t".$r['punchline']."\n\n";
    }

}
?>
</PRE>
</BODY>
</HTML>
