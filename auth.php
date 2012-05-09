<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexander
 * Date: 09.05.12
 * Time: 20:39
 * To change this template use File | Settings | File Templates.
 */
include_once('./includes/auth.class.php');

$authorization = new auth();

$authorization->authorization($_POST['login'],$_POST['password']);
?>