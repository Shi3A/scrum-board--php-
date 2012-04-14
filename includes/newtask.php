<?php

include_once('mysql.class.php');
$task_text = htmlspecialchars($_POST['task_text'], ENT_QUOTES, 'UTF-8');

if (substr($_POST['cid'], 0, 6) == 'column' ) $cid = substr(htmlspecialchars($_POST['cid'], ENT_QUOTES, 'UTF-8'), 7);
else $cid = 'false';

$title = $comment='';
//if ( iconv_strlen($task_text) < 40 ) die('Too short');
//$task_text = preg_match("\r\n", $task_text);
$task_text = str_replace("\n", "<br />", $task_text);
if(strpos($task_text , '<br />')){
$title = substr($task_text, 0, strpos($task_text , '<br />'));
$comment = substr($task_text, strpos($task_text , '<br />') + 6);
}
else $title = $task_text;
$time = time();
$uid = 1;
if (is_numeric($cid)) {
$insert = new DBCON;
$insert->sql_query = "INSERT INTO tasks(cid,uid,created,changed,title,comment) VALUES ($cid,$uid,$time,$time,'$title','$comment')";
$insert->sql_execute($insert->sql_query);

//echo 'Task has been added';
}
else die('Error!');

?>