<?php
    include_once('mysql.class.php');
    
    $cid = substr(htmlspecialchars($_POST['cid']), 8);
    $tasks = new make_tree;
    if (is_numeric($cid)) print $tasks->getTask($cid);
    else die('It\'s not numeric');
?>