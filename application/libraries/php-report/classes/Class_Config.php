<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class Config {
	
	static $PhpReportServer;
	static $Servers;
	static $Language;
	
	static function Load()
	{
		$filename = "config.ini";
		
		if (file_exists($filename))
		{
			$ini = parse_ini_file($filename, true);
			
			self::$Language = $ini["phpreport"]["Language"];
			
			self::$Servers = array();
			
			foreach ($ini as $key => $vl)
			{
				if ($key == "phpreport")
				{
					self::$PhpReportServer = $vl;
				}
				else
				{
					self::$Servers[$key] = $vl;
				}
			}
		}
		else 
		{
			die("Erro ao carregar arquivo de configuração (config.ini)");
		}
		
	}
}
Config::Load();
?>