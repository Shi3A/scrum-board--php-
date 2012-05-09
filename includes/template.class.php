<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexander
 * Date: 09.05.12
 * Time: 15:51
 * To change this template use File | Settings | File Templates.
 */
include_once('mysql.class.php');

//$_SERVER['HTTP_HOST'] = 'localhost';
define("PATH","http://".$_SERVER['HTTP_HOST']."/themes/");

class template extends make_tree
{
var $blocks_arr = array();
var $output;
private $path;

    function make_variables() {
        $this->blocks_arr['content'] = parent::makeTree('RosaSync');
        //return $this->blocks_arr['content'];
    }

    function make_template() {
        $this->path = PATH . 'template.php';
        //$template = include_once('./themes/template.php');
        //var_dump(file_get_contents('./themes/template.php'));
        if (!isset($_SESSION['uid'])) {
            $this->output = file_get_contents(PATH . 'auth-form.php');
            return $this->output;
        }
        else {
        $this->make_variables();

        foreach ($this->blocks_arr as $key => $value){
            $this->output = str_replace('[' . $key . ']', $value, file_get_contents($this->path));
        }
        return $this->output;
        }
    }
}
