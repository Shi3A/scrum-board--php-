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
var $sql_row;

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
    $this->sql_res = $result->fetchAll();
    $this->sql_row = $result->rowCount();

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
    $sql_ret = '';
    $this->sql_query="SELECT pid
    FROM projects
    WHERE title = '$project_title'";

    parent::sql_execute($this->sql_query);

    foreach ($this->sql_res as $row){  
	    $sql_ret = $row['pid'];
    }

    return $sql_ret;
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
    if(empty($_SESSION['projects'])) exit;
    if(!empty($_SESSION['projects'])) {
        $this->output = '';
        $this->output = '<div class="project_link"><a href="/index.php" title="Ко всем проектам">Ко всем проектам</a> </div>';
        foreach($_SESSION['projects'] as $key => $value) {
            if ($project_id == $key) {

                $this->sql_query="SELECT cid,column_name
                FROM columns
                WHERE pid = '$project_id'";
                $this->sql_rets = parent::sql_execute($this->sql_query);

                foreach ($this->sql_rets as $row){
                $this->output .= '<div class="columns" id="column_' . $row['cid'] . '"><div class="title">' . $row['column_name'] . '</div>';
                $this->output .= '<div class="tasks">';
                $this->getTask($row['cid']);
                $this->output .= '</div>';
                $this->output .= '<div class="newtextarea"><textarea class="new_task" id="newtask_' . $row['cid'] . '" readonly="readonly" >Новая задача</textarea></div>';
                $this->output .= '</div>';
                }
            }
            else $this->output .= 'Permission Denied';

        }


        return $this->output;
    }

    return false;
  }

  function projectUidSet($uid,$mode) {

      $serialized_value = serialize($mode);
      $this->sql_query = "UPDATE projects_access SET mode = '$serialized_value' WHERE uid = '$uid'";
      parent::sql_execute($this->sql_query);
      $sql1 = $this->sql_row;
      $query2 = "SELECT mode FROM projects_access WHERE uid = '$uid'";
      parent::sql_execute($query2);
      $sql2 = $this->sql_row;
      if (!$sql1 && !$sql2) {
          $this->sql_query = "INSERT INTO projects_access (uid, mode) VALUES ('$uid', '$serialized_value')";
          parent::sql_execute($this->sql_query);
      }

  }
  function projectUidGet($uid) {
      $output = '';
      $this->sql_query = "SELECT mode FROM projects_access WHERE uid='$uid' LIMIT 1";
      parent::sql_execute($this->sql_query);
      foreach($this->sql_res as $row) {
          $output = unserialize($row['mode']);
      }

      $_SESSION['projects'] = $output;

      return $output;
  }
  
}

?>