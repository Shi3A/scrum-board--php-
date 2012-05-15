<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexander
 * Date: 09.05.12
 * Time: 15:51
 * To change this template use File | Settings | File Templates.
 */
include_once('mysql.class.php');

$_SERVER['HTTP_HOST'] = 'localhost';
define("PATH","http://".$_SERVER['HTTP_HOST']."/themes/");

class template extends make_tree
{
var $blocks_arr = array();
var $output;
var $project;
private $path;

    function check_auth() {
        (!empty($_GET['project'])) ? $this->project = htmlspecialchars($_GET['project'],ENT_QUOTES) : $this->project = '';
        (!empty($_SESSION['uid'])) ? $out = true : $out = false;
        return $out;
    }


    function make_variables($project) {
        $this->blocks_arr['content'] .= parent::makeTree($project);
        //return $this->blocks_arr['content'];
    }

    function make_template() {
        $this->output = false;
        $this->path = PATH . 'template.php';
        if($this->check_auth()){
            $this->blocks_arr['content'] = '<div class="exit"><a href="/auth.php?logout=1" title="Выход">Выход</a></div>';
            if(!empty($this->project) && is_numeric($this->project)){
                $this->make_variables($this->project);
            }
            else {
                //$this->blocks_arr['content'] = '';
                $project = $this->projectUidGet($_SESSION['uid']);
                // REFACTORING!
                foreach ($project as $key => $value){
                    $this->sql_query = "SELECT uid,title FROM projects WHERE pid ='$key'";
                    parent::sql_execute($this->sql_query);
                    if($this->sql_res) {
                        $this->blocks_arr['content'] .= '<ul>';
                        foreach($this->sql_res as $row){
                            $this->blocks_arr['content'] .= '<li><a href="index.php?project=' . $key . '" title="' . $row['title'] . '"   >' . $row['title'] . '</a></li>';
                        }
                        $this->blocks_arr['content'] .= '</ul>';
                    }
                }
            }

            $this->output = '';
            foreach ($this->blocks_arr as $key => $value){
                $this->output .= str_replace('[' . $key . ']', $value, file_get_contents($this->path));
            }
        }

        else {
            $this->blocks_arr['content'] = file_get_contents(PATH . 'auth-form.php');
            foreach ($this->blocks_arr as $key => $value){
                $this->output .= str_replace('[' . $key . ']', $value, file_get_contents($this->path));
            }
        }
        return $this->output;

    }

    function checkProject($uid) {

    }

}

