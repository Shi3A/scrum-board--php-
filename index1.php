<?php
include_once('includes/mysql.class.php');
$newclass = new DBCON;
//$newclass->connect();
//$newclass->sql_query = "INSERT INTO columns VALUES('','Column #1')";

//$time = time();
//$newclass->sql_query = "INSERT INTO tasks VALUES('','3','1',$time,$time,'Task #3','Task description')";

//$time = time();
//$newclass->sql_query = "INSERT INTO projects VALUES('','1',$time,'RosaSync','')";

//$newclass->sql_query = "INSERT INTO projects_columns VALUES('', '1', '3')";

/*$newclass->sql_execute();
$newclass->sql_close();
*/

$tree = new make_tree;
//    $pid = $tree->getProject('RosaSync');
    echo $tree->makeTree('RosaSync');
?>