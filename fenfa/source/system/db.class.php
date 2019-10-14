<?php
require_once 'config.inc.php';
if(!is_file(IN_ROOT.'./data/install.lock')){exit(header("location:install.php"));}
class db_mysql{
	protected $link_id;
	public function __construct($dbhost, $dbuser, $dbpw, $dbname, $charset = IN_DBCHARSET){
		if(!($this->link_id = @mysql_connect($dbhost, $dbuser, $dbpw))){
			die(mysql_error());
		}
		if(!@mysql_select_db($dbname, $this->link_id)){
			die(mysql_error());
		}
		mysql_set_charset($charset, $this->link_id);
		mysql_query("SET NAMES ".$charset, $this->link_id);
	}
	function result($query, $row){
		$query = mysql_result($query, $row);
		return $query;
	}
	public function select_database($dbname){
		return @mysql_select_db($dbname, $this->link_id);
	}
	public function list_tables($dbname){
		return mysql_query("SHOW TABLES FROM $dbname", $this->link_id);
	}
	public function list_fields($dbname, $tbname){
		return  mysql_list_fields($dbname, $tbname, $this->link_id);
	}
	public function fetch_array($query, $result_type = MYSQL_ASSOC){
		return mysql_fetch_array($query, $result_type);
	}
	public function query($sql){
		return mysql_query($sql, $this->link_id);
	}
	public function affected_rows(){
		return mysql_affected_rows($this->link_id);
	}
	public function num_rows($query){
		$rs = $this->fetch_array($query);
		return $rs['count(*)'];
	}
	public function insert_id(){
		return mysql_insert_id($this->link_id);
	}
	public function selectLimit($sql, $num, $start = 0){
		if($start == 0){
			$sql .= ' LIMIT '.$num;
		}else{
			$sql .= ' LIMIT '.$start.', '.$num;
		}
		return $this->query($sql);
	}
	public function getone($sql, $limited = false){
		if($limited == true){
			$sql = trim($sql.' LIMIT 1');
		}
		$res = $this->query($sql);
		if($res !== false){
			$row = mysql_fetch_row($res);
			return $row[0];
		}else{
			return false;
		}
	}
	public function getrow($sql){
		$res = $this->query($sql);
		if($res !== false){
			return mysql_fetch_assoc($res);
		}else{
			return false;
		}
	}
	public function getall($sql){
		$res = $this->query($sql);
		if($res !== false){
			$arr = array();
			while($row = mysql_fetch_assoc($res)){
				$arr[] = $row;
			}
			return $arr;
		}else{
			return false;
		}
	}
}
$db = new db_mysql(IN_DBHOST, IN_DBUSER, IN_DBPW, IN_DBNAME);
require_once 'function_common.php';
?>