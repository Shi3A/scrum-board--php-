<?php 
class DBCON {
var $dbname = "scrum_db";
var $dbusername = "scrum_usr";
var $dbpassword = "scrumpass";
var $dbserver = "localhost";

var $conn_id;
var $sql_query;
var $sql_err;
var $sql_res;

var $SQLCHARSET = 'utf8';

 function connect()
  {
    $this->conn_id = new PDO ( 'mysql:host=' . $this->dbserver . ';dbname=' . $this->dbname, $this->dbusername, $this->dbpassword ) or die ('No connection to db-server');  
    $this->conn_id->query ( 'SET character_set_connection = ' . $this->SQLCHARSET . ';' );  
    $this->conn_id->query ( 'SET character_set_client = ' . $this->SQLCHARSET . ';' );  
    $this->conn_id->query ( 'SET character_set_results = ' . $this->SQLCHARSET . ';' );  

  }

 function sql_execute($sql_query)
  {
    $this->connect();
    $result = $this->conn_id->prepare($sql_query);
    $result->execute ();
    $this->sql_res = $result->fetchAll ();  

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
    $this->sql_query="SELECT pid FROM projects WHERE title = '$project_title'";
    parent::sql_execute($this->sql_query);

/*    while ($row = mysql_fetch_array($this->sql_res)) {
        $this->sql_ret = $row['pid'];
    }
*/
    foreach ($this->sql_res as $row){  
	//любые действия например  
	$this->sql_ret = $row['pid'];
    }  
//    mysql_free_result($this->sql_res);
    return $this->sql_ret;
  }

  function getTask($cid) {
    $this->sql_query = "SELECT * 
	FROM tasks 	
	WHERE cid = '$cid' AND status = '0' ";
    parent::sql_execute($this->sql_query);

    foreach ($this->sql_res as $row){  
	//любые действия например  
//       while ($row = mysql_fetch_array($this->sql_res)) {
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
     
//    mysql_free_result($this->sql_res);
    return $this->output;
  }
  
  function makeTree($project_id) {
    $this->sql_query="SELECT columns.cid,column_name 
	FROM columns 
	JOIN projects_columns WHERE pid = (
	SELECT pid
	FROM projects
	WHERE pid = '$project_id'
	LIMIT 1 )
	AND columns.cid = projects_columns.cid";
    $this->sql_rets = parent::sql_execute($this->sql_query);

//   while ($row = mysql_fetch_array($this->sql_rets)) {
    foreach ($this->sql_rets as $row){ 
	$this->output .= '<div class="columns" id="column_' . $row['cid'] . '"><div class="title">' . $row['column_name'] . '</div>';
	$this->output .= '<div class="tasks">';
	$this->getTask($row['cid']);
	$this->output .= '</div>';
	$this->output .= '<div class="newtextarea"><textarea class="new_task" id="newtask_' . $row['cid'] . '" readonly="readonly" >Новая задача</textarea></div>';
	$this->output .= '</div>';


    }

//    mysql_free_result($this->sql_rets);
    
    return $this->output;
  }
  
}

?>