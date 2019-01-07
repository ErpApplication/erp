# 
# PHP Report
# 

# --------------------------------------------------------

#
# Table structure for table `PHPREP_AGRUPAMENTO`
#

CREATE TABLE `PHPREP_AGRUPAMENTO` (
  `RELCODIGO` int(11) NOT NULL default '0',
  `AGRNIVEL` int(11) NOT NULL default '0',
  `AGRTABELA` varchar(100) NOT NULL default '',
  `AGRCAMPO` varchar(100) NOT NULL default '',
  KEY `RELATION_18_FK` (`RELCODIGO`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_DBACESSO`
#

CREATE TABLE `PHPREP_DBACESSO` (
  `USUCODIGO` int(11) NOT NULL default '0',
  `BASNOME` varchar(100) NOT NULL default '',
  KEY `RELATION_14_FK` (`USUCODIGO`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_CAMPO`
#

CREATE TABLE `PHPREP_CAMPO` (
  `RELCODIGO` int(11) NOT NULL default '0',
  `CAMTABELA` varchar(100) NOT NULL default '',
  `CAMCAMPO` varchar(100) NOT NULL default '',
  `CAMTITULO` varchar(20) NOT NULL default '',
  `CAMORDEM` int(11) NOT NULL default '0',
  `CAMLARGURA` int(11) default '0',
  KEY `RELATION_17_FK` (`RELCODIGO`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_CORCAMPO`
#

CREATE TABLE `PHPREP_CORCAMPO` (
  `RELCODIGO` int(11) NOT NULL default '0',
  `CORTABELA` varchar(100) NOT NULL default '',
  `CORCAMPO` varchar(100) NOT NULL default '',
  `CORCONDICAO1` varchar(10) NOT NULL default '',
  `CORCONTEUDO1` varchar(30) NOT NULL default '',
  `CORFILTRO` char(3) default NULL,
  `CORCONDICAO2` varchar(10) default NULL,
  `CORCONTEUDO2` varchar(30) default NULL,
  `CORRGB` varchar(6) NOT NULL default '',
  KEY `RELATION_629_FK` (`RELCODIGO`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_FILTRO`
#

CREATE TABLE `PHPREP_FILTRO` (
  `RELCODIGO` int(11) NOT NULL default '0',
  `FILTABELA` varchar(100) NOT NULL default '',
  `FILCAMPO` varchar(100) NOT NULL default '',
  `FILCONDICAO1` varchar(10) NOT NULL default '',
  `FILCONTEUDO1` varchar(30) NOT NULL default '',
  `FILFILTRO` char(3) default NULL,
  `FILCONDICAO2` varchar(10) default NULL,
  `FILCONTEUDO2` varchar(30) default NULL,
  KEY `RELATION_628_FK` (`RELCODIGO`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_FORMULA`
#

CREATE TABLE `PHPREP_FORMULA` (
  `RELCODIGO` int(11) NOT NULL default '0',
  `FORTIPO` char(3) NOT NULL default '',
  `FORTABELA` varchar(100) NOT NULL default '',
  `FORCAMPO` varchar(100) NOT NULL default '',
  `FORTITULO` varchar(20) NOT NULL default '',
  `FORAPLICACAO` char(1) NOT NULL default '',
  `FORORDEM` int(11) NOT NULL default '0',
  KEY `RELATION_19_FK` (`RELCODIGO`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_GRAFICO`
#

CREATE TABLE `PHPREP_GRAFICO` (
  `RELCODIGO` int(11) NOT NULL default '0',
  `GRATIPO` int(1) NOT NULL default '0',
  `GRATITULO` varchar(100) default NULL,
  `GRAXTABELA` varchar(100) NOT NULL default '',
  `GRAEIXOX` varchar(100) NOT NULL default '',
  `GRAYTABELA` varchar(100) NOT NULL default '',
  `GRAEIXOY` varchar(100) NOT NULL default '',
  `GRAXLEGENDA` varchar(20) NOT NULL default '',
  `GRAYLEGENDA` varchar(20) NOT NULL default '',
  KEY `RELATION_21_FK` (`RELCODIGO`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_GRUPOREL`
#

CREATE TABLE `PHPREP_GRUPOREL` (
  `GRURELCOD` int(11) NOT NULL auto_increment,
  `GRURELNOME` varchar(20) NOT NULL default '',
  `GRURELDESCRICAO` varchar(254) NOT NULL default '',
  `GRURELNIVEL` int(11) NOT NULL default '0',
  PRIMARY KEY  (`GRURELCOD`),
  UNIQUE KEY `PHPREP_GRUPOREL_PK` (`GRURELCOD`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_GRUPRELACESSO`
#

CREATE TABLE `PHPREP_GRUPRELACESSO` (
  `GRURELCOD` int(11) NOT NULL default '0',
  `USUCODIGO` int(11) NOT NULL default '0',
  PRIMARY KEY  (`GRURELCOD`,`USUCODIGO`),
  UNIQUE KEY `PHPREP_GRUPRELACESSO_PK` (`GRURELCOD`,`USUCODIGO`),
  KEY `RELATION_15_FK` (`USUCODIGO`),
  KEY `RELATION_16_FK` (`GRURELCOD`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_ORDENACAO`
#

CREATE TABLE `PHPREP_ORDENACAO` (
  `RELCODIGO` int(11) NOT NULL default '0',
  `ORDTABELA` varchar(100) NOT NULL default '',
  `ORDCAMPO` varchar(100) NOT NULL default '',
  `ORDNIVEL` int(11) NOT NULL default '0',
  `ORDORDEM` varchar(4) NOT NULL default '',
  KEY `RELATION_20_FK` (`RELCODIGO`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_RELACIONAM`
#

CREATE TABLE `PHPREP_RELACIONAM` (
  `RELCODIGO` int(11) NOT NULL default '0',
  `RTOTABELA1` varchar(100) NOT NULL default '',
  `RTOCAMPO1` varchar(100) NOT NULL default '',
  `RTOTABELA2` varchar(100) NOT NULL default '',
  `RTOCAMPO2` varchar(100) NOT NULL default '',
  KEY `RELATION_505_FK` (`RELCODIGO`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_RELATORIO`
#

CREATE TABLE `PHPREP_RELATORIO` (
  `RELCODIGO` int(11) NOT NULL auto_increment,
  `GRURELCOD` int(11) NOT NULL default '0',
  `USUCODIGO` int(11) NOT NULL default '0',
  `RELNOME` varchar(40) NOT NULL default '',
  `RELDATACRIACAO` date NOT NULL default '0000-00-00',
  `RELDATAEDICAO` date NOT NULL default '0000-00-00',
  `RELUSUEDICAO` int(11) NOT NULL default '0',
  `RELBASE` varchar(100) NOT NULL default '',
  `RELCABECALHO` text,
  `RELRODAPE` text,
  `RELTEMPLATE` int(1) NOT NULL default '0',
  `RELTEMPLATETIPO` int(1) NOT NULL default '0',
  `RELTEMPLATENUME` int(1) NOT NULL default '0',
  `RELSQLSELECT` text NOT NULL default '',
  `RELSQLFORMGRUP` text,
  `RELSQLFORMREL` text,
  `RELSQLFROM` text NOT NULL default '',
  `RELSQLWHERE` text,
  `RELSQLORDER` text,
  `RELSQLGROUP` text,
  PRIMARY KEY  (`RELCODIGO`),
  UNIQUE KEY `PHPREP_RELATORIO_PK` (`RELCODIGO`),
  KEY `RELATION_22_FK` (`GRURELCOD`),
  KEY `RELATION_23_FK` (`USUCODIGO`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

# --------------------------------------------------------

#
# Table structure for table `PHPREP_USUARIO`
#

CREATE TABLE `PHPREP_USUARIO` (
  `USUCODIGO` int(11) NOT NULL auto_increment,
  `USUUSUARIO` varchar(15) NOT NULL default '',
  `USUSENHA` varchar(50) NOT NULL default '',
  `USUNOME` varchar(40) NOT NULL default '',
  `USUEMAIL` varchar(50) NOT NULL default '',
  `USUIDIOMA` varchar(50) default NULL,
  `USUTIPO` int(11) NOT NULL default '0',
  PRIMARY KEY  (`USUCODIGO`),
  UNIQUE KEY `PHPREP_USUARIO_PK` (`USUCODIGO`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

#
# Dumping data for table `PHPREP_USUARIO`
#

INSERT INTO `PHPREP_USUARIO` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'GOD', '', '', 1);