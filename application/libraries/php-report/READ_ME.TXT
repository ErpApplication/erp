/******************************************/
/*              PHP Report                */
/*                                        */
/*                                        */
/* Copyright (c) 2005 by                  */
/*                    Daniela Toniolo     */
/*                    Leonardo Galvão     */
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

            MANUAL DE INSTALAÇÃO


- Configuração do PHP 5

O PHP 5 pode ser obtido através do download no site oficial do PHP (http://php.net), seguindo as informações do site para concluir a instalação. Vale ressaltar que é importante realizar a instalação com acesso ao banco de dados MySQL e adicionar a biblioteca GD na configuração inicial.

- Servidor

Descompactar o PHP REPORT no diretório PHPREPORT da área de disponibilização de páginas do servidor (htdocs do Apache, por exemplo).

- Configuração dos Bancos de Dados

  * Banco de Dados MySQL
Pode ser adquirido através do link http://www.mysql.com/downloads/ 

  * Banco de Dados Firebird
Pode ser adquirido através do link http://www.firebirdsql.org/en/downloads/

  * O administrador deve criar as tabelas do PHP REPORT no banco de dados e configurar os dados de acesso ao banco dentro do arquivo de configuração do sistema, chamado config.inc.php, indicando o endereço do servidor, nome da base de dados, usuário e senha de acesso.
Após as configurações, o sistema é acessado pelo primeiro usuário que será o usuário principal do sistema (GOD), sendo que este não poderá ser excluído. Dados para o acesso:
Nome de usuário: admin
Senha: admin 

  * Banco de Dados do usuário a ser integrado
O usuário deverá configurar os dados do banco a ser utilizado dentro do arquivo de configuração do sistema, chamado config.php, indicando o tipo do banco de dados, endereço do servidor, usuário e senha de acesso.
