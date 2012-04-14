<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" media="all" href="/css/style.css" />
    <?php // <script src="/includes/jquery.js"></script> ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src="/includes/ajax.js"></script>
    <script src="/includes/autoresize.jquery.js"></script>
</head>
<body>

<div id="wrap">
<?php 
include_once('includes/mysql.class.php');

$tree = new make_tree;

//    $pid = $tree->getProject('RosaSync');

    echo $tree->makeTree('RosaSync');
    
?>
    <div class="clear"></div>
</div> <!-- /#wrap -->
</body>
</html>