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
if (isset($_GET['logout']) && is_numeric($_GET['logout']) && $_GET['logout'] == 1) {
    unset($_SESSION['uid']);
    header("Location: http://" . $_SERVER['HTTP_HOST'] );
}
else $authorization->authorization($_POST['login'],$_POST['password']);

?>