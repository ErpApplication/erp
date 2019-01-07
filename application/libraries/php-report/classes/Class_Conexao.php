<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvуo and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class Conexao {
	static function Conecta(){
		require_once './MDB2.php'; // especificando o DSN (Data Source Name) 
		$dsn = Config::$PhpReportServer["DBType"] . 
		"://" . 
		Config::$PhpReportServer["DBUserName"] . 
		":" . 
		Config::$PhpReportServer["DBPassword"] . 
		"@" . 
		Config::$PhpReportServer["DBHostName"] . 
		"/" . 
		Config::$PhpReportServer["DBName"];
		
		$options = array('portability' => MDB2_PORTABILITY_NUMROWS);
		
		$conn= MDB2::connect( $dsn, $options );
		if (MDB2::isError($conn)) {
			die ($conn->getMessage()); 
		}
		
		return $conn;
	}

	static function ConectaRel($key){
		require_once './MDB2.php';
		$partes = split("Ж", $key);
		$key_block = $partes[0];
		$db = (isset($partes[1])) ? $partes[1] : "";
		
		if (Config::$Servers[$key_block])
		{
			$dsn = Config::$Servers[$key_block]["DBType"] . 
			"://" . 
			Config::$Servers[$key_block]["DBUserName"] . 
			":" . 
			Config::$Servers[$key_block]["DBPassword"] . 
			"@" . 
			Config::$Servers[$key_block]["DBHostName"];
			
			if (Config::$Servers[$key_block]["DBName"] == "")
			{
				if ($db != "") 
					$dsn .= "/" . $db;
			}
			else
			{
				$dsn .= "/" . Config::$Servers[$key_block]["DBName"];
			}
		}
		else 
		{
			die("Erro ao buscar '$key_block' no arquivo de configuraчуo. Ajustar config.ini com o bloco '$key_block'");
		}
		
		$options = array('portability' => MDB2_PORTABILITY_NUMROWS);
		
		$conn= MDB2::connect($dsn, $options);
		if (MDB2::isError($conn)) { 
			die ($conn->getMessage()); 
		} 
		
		return $conn;
	}

	static function Desconecta($conn){
		$conn->disconnect();
	}
}
?>