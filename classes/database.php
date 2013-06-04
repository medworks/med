<?php  
  include_once("security.php");  
    
class Database
  {
    
 private static $me;
 private $link;
 public $cmd;
 
 function __construct()
 {
      $this->link = mysql_connect(_DB_SERVER,_DB_USER,_DB_PASS);  
      mysql_query("set names 'utf8'");
      mysql_select_db(_DB_NAME,$this->link);                  
 }
public static function getDatabase()
{
   if(is_null(self::$me))
       self::$me = new Database();
    return self::$me;
 } 
 
public function RunSQL()
{              
   $security = security::getSecurity ();
   $this->cmd = $security->xss_clean($this->cmd);
   //echo $this->cmd;
   $result =  mysql_query($this->cmd, $this->link);          
   //if (!$result) die ('Unable to run query:'.$this->errormessage()); else
    return $result;
}

public function affectedrows()
{
  return mysql_affected_rows($this->link);
}

public function insertid()
{
  return mysql_insert_id($this->link);
}

public function errormessage()
{
 return mysql_error($this->link);
}

public function errornumber()
{
  return mysql_errno($this->link);
}

function SelectFromTable($tableName, $fields=NULL, $where = NULL, $order = NULL)
{
	if (empty ($fields)) $fields="*";
    if ($where) $where = " WHERE " . $where;
	if ($order) $order = " ORDER BY " . $order;
	$this->cmd = "SELECT $fields FROM `$tableName` " . $where . $order;               
	$res = $this->RunSQL($this->cmd);
    if ($res)
	    return mysql_fetch_array($res);
	else
        return false;
}

public function  SelectAll($tableName, $fields,$where = NULL,
                 $order = NULL, $from = NULL, $count = NULL)
 {    
	$limit = "";
    if (!$fileds) $fields="*";
    if ($where) $where = " WHERE " . $where;
    if ($order) $order = " ORDER BY " . $order;
    if (($from || $from == 0) && $count) $limit = " LIMIT $from, $count";
    $this->cmd = "SELECT $fields FROM `$tableName` " . $where . " " . $order . " " . $limit;    
    $res =$this->RunSQL($this->cmd);
    $rows = array();
    if ($res)
    {
        while($row = mysql_fetch_array($res)) $rows[] = $row;
    }
    return $rows;
}

public function insertquery($table, $keys, $values)
{    
    $this->cmd =  "INSERT INTO ".$table." (".implode(', ', $keys).") VALUES (".implode(', ', $values).")";  
	//echo "<br/>",$this->cmd;
	return $this->RunSQL();
}

public function updatequery($table, $values, $where, $orderby = array())
{
    foreach ($values as $key => $val)
    {
            $valstr[] = $key . ' = ' . $val;
    }

    $limit = ( ! $limit) ? '' : ' LIMIT '.$limit;

    $orderby = (count($orderby) >= 1)?' ORDER BY '.implode(", ", $orderby):'';

    $sql = "UPDATE ".$table." SET ".implode(', ', $valstr);

    $sql .= ($where != '' AND count($where) >=1) ? " WHERE ".implode(" ", $where) : '';
    
    $sql .= $orderby;
    $this->cmd = $sql;
	return $this->RunSQL($this->cmd);
}

function delete($tablename,$IFfield,$IFvalue)
{
    $this->cmd = "DELETE FROM `{$tablename}` WHERE  $IFfield ='{$IFvalue}'";            
    return $this->RunSQL($this->cmd);
}
public function maxOf($column, $table, $where)
{
   $this->cmd ="SELECT MAX(`$column`) FROM `$table` WHERE $where";  
   return $this->RunSQL();
}

public function maxOfAll($column, $table)
{   
   $this->cmd ="SELECT MAX(`$column`) FROM `$table`";
   return $this->RunSQL();
}

public function countOf($table, $where)
{
  $this->cmd ="SELECT COUNT(*) FROM `$table` WHERE $where";
  return $this->RunSQL();
}

public function countAll($table)
{
  $this->cmd ="SELECT COUNT(*) FROM `$table`";
  return $this->RunSQL();
}

  }
?>