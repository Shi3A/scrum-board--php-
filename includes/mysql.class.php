<?php 
class DBCON {
var $dbname = "";
var $dbusername = "";
var $dbpassword = "";
var $dbserver = "";

var $conn_id;
var $sql_query;
var $sql_err;
var $sql_res;

 function connect()
  {
    $this->conn_id = mysql_connect($this->dbserver, $this->dbusername, $this->dbpassword) or die('No connection to MySQL');
    mysql_select_db($this->dbname) or die('Can\'t select database');
    mysql_query("SET NAMES utf8");
  }

 function sql_execute($sql_query)
  {
    $this->connect();
    $this->sql_res=mysql_query($sql_query,$this->conn_id);
    $this->sql_err=mysql_error();
    $this->sql_close();

    return $this->sql_res;
  }

 function sql_close()
  {
//    mysql_free_result($this->sql_res);
    mysql_close($this->conn_id);
  }

}

class make_tree extends DBCON {

//var $conn_id;
//var $sql_query;
//var $sql_err;
//var $sql_res;
//var $sql_ret;
var $sql_rets;
var $pid;
var $cid;
var $columns;
var $output;
var $title;
var $comment;

  function getProject($project_title) {
    $this->sql_query="SELECT pid FROM projects WHERE title = '$project_title'" or die('Wrong query!');
    parent::sql_execute($this->sql_query);

    while ($row = mysql_fetch_array($this->sql_res)) {
        $this->sql_ret = $row['pid'];
    }
    mysql_free_result($this->sql_res);
    return $this->sql_ret;
  }

  function getTask($cid) {
    $this->sql_query = "SELECT * 
	FROM tasks 	
	WHERE cid = '$cid' AND status = '0' ";
    parent::sql_execute($this->sql_query);
       while ($row = mysql_fetch_array($this->sql_res)) {
	  if (isset($row['title'])) {
	    $this->output .= '<div class="task" id="task' . $row['tid'] . '">';
	    $this->output .= '<div class="task_title">' . $row['title'] . '</div>';
	    $this->output .= '<div class="task_content">' . $row['comment'] . '</div>';
	    $this->output .= '<div class="controls">';
	    $this->output .= '<div class="task_close" ><img src="/images/close.png" alt="Закрыть" /></div>';
	    $this->output .= '<div class="task_edit" ><img src="/images/edit.png" alt="Редактировать" /></div>';
	    $this->output .= '</div>';
	    $this->output .= '</div>';
	  }

       }
     
    mysql_free_result($this->sql_res);
    return $this->output;
  }
  
  function makeTree($project_title) {
    $this->sql_query="SELECT columns.cid,column_name 
	FROM columns 
	JOIN projects_columns WHERE pid = (
	SELECT pid
	FROM projects
	WHERE title = '$project_title'
	LIMIT 1 )
	AND columns.cid = projects_columns.cid";
    $this->sql_rets = parent::sql_execute($this->sql_query);

   while ($row = mysql_fetch_array($this->sql_rets)) {
	$this->output .= '<div class="columns" id="column_' . $row['cid'] . '"><div class="title">' . $row['column_name'] . '</div>';
	$this->output .= '<div class="tasks">';
	$this->getTask($row['cid']);
	$this->output .= '</div>';
	$this->output .= '<div class="newtextarea"><textarea class="new_task" id="newtask_' . $row['cid'] . '" readonly="readonly" >Новая задача</textarea></div>';
	$this->output .= '</div>';


    }

    mysql_free_result($this->sql_rets);
    
    return $this->output;
  }
  
}

?>