/******************************************/
/*              PHP Report                */
/*                                        */
/*                                        */
/* Copyright (c) 2005 by                  */
/*                    Daniela Toniolo     */
/*                    Leonardo Galv�o     */
/*                    Marli Carneiro      */
/*                                        */
/*                                        */
/* This is a free software. You can       */
/* redistribute it and/or modify it       */
/* under the terms of the GNU General     */
/* Public License.                        */
/*                                        */
/******************************************/


1. Create PHP Report tables on database
   Use scripts in PHPREPORT_MYSQL_SCRIPTS.SQL for MySQL database
   OR PHPREPORT_INTERBASE_SCRIPTS.SQL for Firebird or Interbase databases

2. Extract PEAR Packges into root project
   2.1 http://pear.php.net/package/PEAR
   2.2 http://pear.php.net/package/MDB2
   2.3 http://pear.php.net/package/MDB2_Driver_ibase
       and/or http://pear.php.net/package/MDB2_Driver_mysql

2. Open config.ini and fill in the fields.

3. And enjoy it!


/******************************************/

            MANUAL DE INSTALA��O


- Configura��o do PHP 5

O PHP 5 pode ser obtido atrav�s do download no site oficial do PHP (http://php.net), seguindo as informa��es do site para concluir a instala��o. Vale ressaltar que � importante realizar a instala��o com acesso ao banco de dados MySQL e adicionar a biblioteca GD na configura��o inicial.

- Servidor

Descompactar o PHP REPORT no diret�rio PHPREPORT da �rea de disponibiliza��o de p�ginas do servidor (htdocs do Apache, por exemplo).

- Configura��o dos Bancos de Dados

  * Banco de Dados MySQL
Pode ser adquirido atrav�s do link http://www.mysql.com/downloads/ 

  * Banco de Dados Firebird
Pode ser adquirido atrav�s do link http://www.firebirdsql.org/en/downloads/

  * O administrador deve criar as tabelas do PHP REPORT no banco de dados e configurar os dados de acesso ao banco dentro do arquivo de configura��o do sistema, chamado config.inc.php, indicando o endere�o do servidor, nome da base de dados, usu�rio e senha de acesso.
Ap�s as configura��es, o sistema � acessado pelo primeiro usu�rio que ser� o usu�rio principal do sistema (GOD), sendo que este n�o poder� ser exclu�do. Dados para o acesso:
Nome de usu�rio: admin
Senha: admin 

  * Banco de Dados do usu�rio a ser integrado
O usu�rio dever� configurar os dados do banco a ser utilizado dentro do arquivo de configura��o do sistema, chamado config.php, indicando o tipo do banco de dados, endere�o do servidor, usu�rio e senha de acesso.
