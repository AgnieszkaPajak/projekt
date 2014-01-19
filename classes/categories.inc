<?php
class Categories{
	public function __construct() {
    }
	
	public function getCategories(){
		require_once('db_connect.inc');
		$query = "SELECT Nazwa FROM Categories;";
		$result = @mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			$return[] = $row;
		}
		return $return;
		}
	
}
?>