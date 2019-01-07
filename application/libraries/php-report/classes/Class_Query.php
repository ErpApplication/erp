<?php
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class Query {
	
	var $dbType;
	var $dbName;
	
	function __construct($key)
	{
		$partes = split("¶", $key);
		$key_block = $partes[0];
		$db = (isset($partes[1])) ? $partes[1] : "";
		
		$this->dbType = Config::$Servers[$key_block]["DBType"];
		$this->dbName = $db;
	}
	
	static function GetDataBases()
	{
		$bases = array();
		
		foreach (Config::$Servers as $key => $server)
		{
			if (($server["DBType"] == 'mysql') && ($server["DBName"] == ""))
			{
				$conecta = Conexao::ConectaRel($key);
				$query = "SHOW DATABASES";
				$result = $conecta->query($query); 
				if (MDB2::isError($result)) die ($result->getMessage()); 
				$rows = $result->numRows(); 
				if ($rows > 0){
					while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
						$nome = $i->Database;
						$bases[$key."¶".$nome] = $nome;
					}
				}
				Conexao::Desconecta($conecta);
			}
			else 
			{
				$bases[$key] = $key;
			}
		}
		
		return $bases;
	}
	
	function ShowTables()
	{
		switch ($this->dbType)
		{
			case 'mysql':
				return "SHOW TABLES FROM `" . $this->dbName . "`";
				break;
			case 'ibase':
			case 'ibase(firebird)':
				return 'SELECT RDB$RELATION_NAME
					FROM RDB$RELATIONS
					WHERE RDB$VIEW_BLR IS NULL
					AND (RDB$SYSTEM_FLAG IS NULL OR RDB$SYSTEM_FLAG = 0)
					ORDER BY RDB$RELATION_NAME';
				break;
		}
	}
	
	function GetTableName($fetchTable)
	{

		switch ($this->dbType)
		{
			case 'mysql':
				$coluna_result = "Tables_in_".$this->dbName;
				return $fetchTable->$coluna_result;
				break;
			case 'ibase':
			case 'ibase(firebird)':
				$coluna_result = 'RDB$RELATION_NAME';
				return trim($fetchTable->$coluna_result);
				break;
		}
	}
	
	function ShowColumns($table)
	{
		switch ($this->dbType)
		{
			case 'mysql':
				return "SHOW COLUMNS FROM `" . $table . "`";
				break;
			case 'ibase':
			case 'ibase(firebird)':
				return 'SELECT RF.RDB$FIELD_NAME, RF.RDB$FIELD_ID, F.RDB$FIELD_TYPE, RC.RDB$CONSTRAINT_TYPE
					FROM RDB$RELATION_FIELDS RF
					JOIN RDB$RELATIONS R ON (RF.RDB$RELATION_NAME = R.RDB$RELATION_NAME)
					JOIN RDB$FIELDS F ON (F.RDB$FIELD_NAME = RF.RDB$FIELD_SOURCE)
					LEFT JOIN ( RDB$RELATION_CONSTRAINTS RC
					           JOIN RDB$INDEX_SEGMENTS I ON (I.RDB$INDEX_NAME = RC.RDB$INDEX_NAME)
					           JOIN RDB$INDICES IDX ON (IDX.RDB$INDEX_NAME = RC.RDB$INDEX_NAME))
					           ON (I.RDB$FIELD_NAME = RF.RDB$FIELD_NAME) AND (RC.RDB$RELATION_NAME = RF.RDB$RELATION_NAME)
					AND R.RDB$VIEW_BLR IS NULL
					AND (R.RDB$SYSTEM_FLAG IS NULL OR R.RDB$SYSTEM_FLAG = 0)
					WHERE RF.RDB$RELATION_NAME = \''. $table . '\'
					ORDER BY RF.RDB$FIELD_NAME'; //ORDER BY RF.RDB$FIELD_POSITION
				break;
		}
	}
	
	function GetFieldName($fetchColumn)
	{
		switch ($this->dbType)
		{
			case 'mysql':
				$coluna_result = "Field";
				return $fetchColumn->$coluna_result;
				break;
			case 'ibase':
			case 'ibase(firebird)':
				$coluna_result = 'RDB$FIELD_NAME';
				return trim($fetchColumn->$coluna_result);
				break;
		}
	}
	
	function GetFieldType($fetchColumn)
	{
		switch ($this->dbType)
		{
			case 'mysql':
				$coluna_result = "Type";
				return $fetchColumn->$coluna_result;
				break;
			case 'ibase':
			case 'ibase(firebird)':
				$coluna_result = 'RDB$FIELD_TYPE';
				return $fetchColumn->$coluna_result;
				break;
		}
	}
	
	function isColumnNumeric($type)
	{
		switch ($this->dbType)
		{
			case 'mysql':
				if((strpos($type,"int") !== false)
					||(strpos($type,"num") !== false)
					||(strpos($type,"dec") !== false)
					||(strpos($type,"float") !== false)
					||(strpos($type,"double") !== false))
				{
					return true;
				}
				break;
			case 'ibase':
			case 'ibase(firebird)':
//CASE f.RDB$FIELD_TYPE
//WHEN 261 THEN 'BLOB'
//WHEN 14 THEN 'CHAR'
//WHEN 40 THEN 'CSTRING'
//WHEN 11 THEN 'D_FLOAT'
//WHEN 27 THEN 'DOUBLE'
//WHEN 10 THEN 'FLOAT'
//WHEN 16 THEN 'INT64'
//WHEN 8 THEN 'INTEGER'
//WHEN 9 THEN 'QUAD'
//WHEN 7 THEN 'SMALLINT'
//WHEN 12 THEN 'DATE'
//WHEN 13 THEN 'TIME'
//WHEN 35 THEN 'TIMESTAMP'
//WHEN 37 THEN 'VARCHAR'
				if (($type == 11) 
					|| ($type == 27) 
					|| ($type == 10)
					|| ($type == 16) 
					|| ($type == 8)
					|| ($type == 7))
				return true;
				break;
		}
		return false;
	}
	
	function isPrimaryKey($fetchColumn)
	{
		switch ($this->dbType)
		{
			case 'mysql':
				$chave = $fetchColumn->Key;
				if ($chave=="PRI")
				{
					return true;
				}
				break;
			case 'ibase':
			case 'ibase(firebird)':
				$coluna_result = 'RDB$CONSTRAINT_TYPE';
				$constraint = $fetchColumn->$coluna_result;
				if ($constraint=="PRIMARY KEY")
				{
					return true;
				}
				break;
		}
		return false;
	}
	
	function isForeignKey($fetchColumn)
	{
		switch ($this->dbType)
		{
			case 'mysql':
				$chave = $fetchColumn->Key;
				if ($chave=="MUL")
				{
					return true;
				}
				break;
			case 'ibase':
			case 'ibase(firebird)':
				$coluna_result = 'RDB$CONSTRAINT_TYPE';
				$constraint = $fetchColumn->$coluna_result;
				if ($constraint=="FOREIGN KEY")
				{
					return true;
				}
				break;
		}
		return false;
	}
	
	static function lastID($conn, $dbType, $table, $idField)
	{
		switch ($dbType)
		{
			case 'mysql':
				$query = "SELECT ".$idField." AS ID FROM ".$table." ORDER BY ".$idField." DESC LIMIT 0, 1";
				$result = $conn->query($query); 
				if (MDB2::isError($result)) die ($result->getMessage()); 
				$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
				return $i->ID;
				
			case 'ibase':
			case 'ibase(firebird)':
				$query = 'SELECT CAST(GEN_ID(GEN_'.$table.'_'.$idField.', 0) AS INTEGER) 
					AS ID FROM rdb$DATABASE';
				$result = $conn->query($query); 
				if (MDB2::isError($result)) die ($result->getMessage()); 
				$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
				return $i->ID;
				break;
		}
	}
}
?>