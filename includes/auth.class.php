<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexander
 * Date: 09.05.12
 * Time: 19:16
 * To change this template use File | Settings | File Templates.
 */
session_start();

include_once('mysql.class.php');

class auth extends DBCON{

private $login;
private $password;
private $password_db;
private $uid;
private $salt;
//var $sql_query;

// очищение суперглобальных массивов от слешей
function slashes(&$el)
{
    if (is_array($el))
    foreach($el as $k=>$v)
        $this->slashes($el[$k]);
    else $el = stripslashes($el);
}

function authorization($login, $password){

    $this->login = htmlspecialchars($login,ENT_QUOTES);
    $this->password = htmlspecialchars($password,ENT_QUOTES);

    if (ini_get('magic_quotes_gpc'))
    {
        $this->slashes($_GET);
        $this->slashes($_POST);
        $this->slashes($_COOKIE);
    }

    $this->sql_query = "SELECT `uid`,`pass`,`salt` FROM `users` WHERE name = '" . $this->login . "';" ;
    $this->sql_res = parent::sql_execute($this->sql_query);

    foreach ($this->sql_res as $row) {
        $this->uid = $row['uid'];
        $this->password_db = $row['pass'];
        $this->salt = $row['salt'];
    }

    $this->password = md5(md5($this->password . $this->salt));

    if ($this->password_db == $this->password) {
        $_SESSION['uid'] = $this->uid;
        $_SESSION['user_name'] = $this->login;
    }
    header("Location: http://" . $_SERVER['HTTP_HOST'] );

}

}
?>