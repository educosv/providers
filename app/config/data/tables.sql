/*
----------------------------------------
|         CREACIÓN Y SELECCION         |
----------------------------------------
*/

DROP DATABASE IF EXISTS `db_providers`;

CREATE DATABASE IF NOT EXISTS `db_providers` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `db_providers`;

/*
----------------------------------------
|          TABLAS PRINCIPALES          |
----------------------------------------
*/

/* *** TABLA Estados */

CREATE TABLE IF NOT EXISTS tbl_status(
	idstatus 	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	status 		VARCHAR(25) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Divisas */

CREATE TABLE IF NOT EXISTS tbl_currency(
    idcurrency  	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    currency    	VARCHAR(20) NOT NULL,
    symbol      	VARCHAR(5) NOT NULL,
    abbreviation VARCHAR(10) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Paises*/

CREATE TABLE IF NOT EXISTS tbl_countries(
	idcountry		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	country 		VARCHAR(45) NULL,
	idcurrency  INT NOT NULL,

	CONSTRAINT FK_countries_idcurrency FOREIGN KEY (idcurrency) REFERENCES tbl_currency(idcurrency)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Regiones*/

CREATE TABLE IF NOT EXISTS tbl_regions(
	idregion		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	region			VARCHAR(45) NOT NULL,
	idcountry 	INT NOT NULL,
	codregion   VARCHAR(10) NOT NULL,
  idstatus    INT NOT NULL,

  CONSTRAINT FK_regions_idcountry FOREIGN KEY (idcountry) REFERENCES tbl_countries (idcountry),
  CONSTRAINT FK_regions_idstatus FOREIGN KEY (idstatus) REFERENCES tbl_status(idstatus)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Niveles de Usuario*/

CREATE TABLE IF NOT EXISTS tbl_levels(
  idlvl 	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  level 	VARCHAR(20) NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Fotos de Perfil*/

CREATE TABLE IF NOT EXISTS tbl_profilepics(
	idpic 		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name 			VARCHAR(15) NOT NULL,
	format 		VARCHAR(12) NOT NULL,
	picture 	BLOB NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA idiomas */

CREATE TABLE IF NOT EXISTS tbl_languages(
	idlang 		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	language	VARCHAR(15) NOT NULL,
	lancode		VARCHAR(3) NOT NULL,
	lanicon 	VARCHAR(15) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Usuarios*/

CREATE TABLE IF NOT EXISTS tbl_users(
	iduser				INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name 					VARCHAR(45) NOT NULL,
	idlvl 				INT NOT NULL,
	idregion 			INT NOT NULL,
  user          VARCHAR(70) NOT NULL,
	email 				VARCHAR(70) NOT NULL,
	pass					VARCHAR(100) NOT NULL,
	position			VARCHAR(70) NOT NULL,
	token 				VARCHAR(70) NULL DEFAULT NULL,
	tokendate 		DATETIME NULL DEFAULT NULL,
	registertype 	VARCHAR(8) NOT NULL,
	registermail	INT NOT NULL DEFAULT 0,
	forgetpass		INT NOT NULL DEFAULT 0,
	idlang				INT NOT NULL,
  idpic					INT NOT NULL DEFAULT 1,
  idstatus			INT NOT NULL,
  infoprovider  INT NOT NULL DEFAULT 0,

	CONSTRAINT FK_users_idlvl FOREIGN KEY (idlvl) REFERENCES tbl_levels (idlvl),
	CONSTRAINT FK_users_idregion FOREIGN KEY (idregion) REFERENCES tbl_regions (idregion),
	CONSTRAINT FK_users_idlang FOREIGN KEY (idlang) REFERENCES tbl_languages (idlang),
  CONSTRAINT FK_users_idpic FOREIGN KEY (idpic) REFERENCES tbl_profilepics (idpic),
  CONSTRAINT FK_users_idstatus FOREIGN KEY (idstatus) REFERENCES tbl_status (idstatus)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Rubros*/

CREATE TABLE IF NOT EXISTS tbl_branches(
  idbranch    INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  branch      VARCHAR(100) NOT NULL,
  idstatus    INT NOT NULL,

  CONSTRAINT FK_branches_status FOREIGN KEY (idstatus) REFERENCES tbl_status (idstatus)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Tamaño de la compañía*/

CREATE TABLE IF NOT EXISTS tbl_company_size (
  idsize      INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  size        VARCHAR(100) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Proveedores*/

CREATE TABLE IF NOT EXISTS tbl_providers (
  idprovider  							INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name        							VARCHAR(200) NOT NULL,
  reason      							VARCHAR(200) NOT NULL,
  address     							VARCHAR(300) NOT NULL,
  activity    							VARCHAR(150) NOT NULL,
  tel         							VARCHAR(20) NOT NULL,
  email       							VARCHAR (100) NOT NULL,
  website     							VARCHAR(100) DEFAULT NULL,
  prodservice 							VARCHAR(10000) NOT NULL,
  legalrepresentative 			VARCHAR(150) NOT NULL,
  iva                       VARCHAR(50) DEFAULT NULL,
  nit                       VARCHAR(50) NOT NULL,
  type                  		VARCHAR(40) NOT NULL,
  idbranch    							INT NOT NULL,
  iduser      							INT NOT NULL,
  cartacompromiso 					VARCHAR(500) DEFAULT NULL,
  aceptaciondecumplimiento 	VARCHAR(500) DEFAULT NULL,
  approved 									ENUM ('0','1') DEFAULT '0',

  CONSTRAINT FK_providers_idbranch FOREIGN KEY (idbranch) REFERENCES tbl_branches (idbranch),
  CONSTRAINT FK_providers_users FOREIGN KEY (iduser) REFERENCES tbl_users (iduser)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Capacidad del proveedor */

CREATE table IF NOT EXISTS tbl_providers_capacity (
  idcapacity      INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idsize          INT NOT NULL,
  instalations    INT NOT NULL,
  methods         INT NOT NULL,
  politics        INT NOT NULL,
  services        INT NOT NULL,
  idprovider      INT NOT NULL,

  CONSTRAINT      FK_provider_capacity_idsize FOREIGN KEY (idsize) REFERENCES tbl_company_size (idsize),
  CONSTRAINT      FK_provider_capacity_idprovider FOREIGN KEY (idprovider) REFERENCES tbl_providers (idprovider)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Detalle del proveedor*/

CREATE TABLE IF NOT EXISTS tbl_providers_detail(
  idprovider  INT NOT NULL,
  doctype     VARCHAR(50) NOT NULL,
  registerid  VARCHAR(100) NOT NULL,

  CONSTRAINT  FK_providers_detail_idprovider FOREIGN KEY (idprovider) REFERENCES tbl_providers(idprovider)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Ejecutivos*/

CREATE TABLE IF NOT EXISTS tbl_executives(
  idexecutive     INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name            VARCHAR(200) NOT NULL,
  officephone     VARCHAR(12) NOT NULL,
  tel             VARCHAR(12) NOT NULL,
  email           VARCHAR(70) NOT NULL,
  idprovider      INT NOT NULL,

  CONSTRAINT      FK_executives_idprovider FOREIGN KEY (idprovider) REFERENCES tbl_providers (idprovider)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Varios*/

CREATE TABLE IF NOT EXISTS tbl_various(
  idvarious       			INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  processes       			INT NOT NULL,
  rights          			INT NOT NULL,
  environment     			INT NOT NULL,
  socialresponsability 	INT NOT NULL,
  idprovider      			INT NOT NULL,

  CONSTRAINT FK_various_idprovider FOREIGN KEY (idprovider) REFERENCES tbl_providers (idprovider)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Archivos*/

CREATE TABLE IF NOT EXISTS tbl_providers_files(
  idfile      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  filename    VARCHAR(100) NOT NULL,
  route       VARCHAR(500) NOT NULL,
  idprovider      INT NOT NULL,

  CONSTRAINT  FK_tbl_providers_files_iduser FOREIGN KEY (idprovider) REFERENCES tbl_providers (idprovider)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA productos*/

CREATE TABLE IF NOT EXISTS tbl_products(
  idprod          INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  codproduct      VARCHAR(1000) NOT NULL,
  description     VARCHAR(1000) NOT NULL,
  price           DECIMAL(10,2) DEFAULT 0,
  status          VARCHAR(20) DEFAULT 'Activo'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*** Seccion: Varios ***/


/* *** TABLA proyectos*/

CREATE TABLE IF NOT EXISTS tbl_projects(
  idproject   INT NOT NULl PRIMARY KEY AUTO_INCREMENT,
  codproject  VARCHAR(10) NOT NULL,
  name        VARCHAR(500) NOT NULL,
  shortname   VARCHAR(500) NOT NULl,
  idstatus    INT NOT NULL DEFAULT 1,

  CONSTRAINT FK_tblprojectsstatus FOREIGN KEY (idstatus) REFERENCES tbl_status (idstatus)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA actividades*/

CREATE TABLE IF NOT EXISTS tbl_activities(
  idactivity  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  codactivity VARCHAR(10) NOT NULL,
  description VARCHAR(500) NOT NULL,
  idproject   INT NOT NULL,
  idstatus    INT NOT NULL DEFAULT 1,

  CONSTRAINT FK_tblactivitiesstatus FOREIGN KEY (idstatus) REFERENCES tbl_status (idstatus),
  CONSTRAINT FK_activity_project_idproject FOREIGN KEY(idproject) REFERENCES tbl_projects(idproject)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA financiadores*/

CREATE TABLE IF NOT EXISTS tbl_funders(
  idfunder    INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name        VARCHAR(100) NOT NULL,
  codfunder   VARCHAR(10) NOT NULL,
  idstatus    INT NOT NULL DEFAULT 1,

  CONSTRAINT FK_tblfundersstatus FOREIGN KEY (idstatus) REFERENCES tbl_status (idstatus)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Centros de costo*/

CREATE TABLE IF NOT EXISTS tbl_cost_centers(
  idcostcenter        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  codcostcenter       VARCHAR(10) NOT NULL,
  idcostcenterregion  VARCHAR(50) NOT NULL,
  name                VARCHAR(500) NOT NULL,
  description         VARCHAR(500) DEFAULT NULL,
  idregion            INT NOT NULL,
  idstatus            INT NOT NULL DEFAULT 1,

  CONSTRAINT          FK_tblcostcentersstatus FOREIGN KEY (idstatus) REFERENCES tbl_status (idstatus),
  CONSTRAINT          FK_costcenterregion_idregion FOREIGN KEY(idregion) REFERENCES tbl_regions(idregion)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*TABLA cuentas*/

CREATE TABLE IF NOT EXISTS tbl_accounts(
  idaccount   INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  account     VARCHAR(100) NOT NULl,
  description VARCHAR(500) NOT NULL,
  idstatus    INT NOT NULL DEFAULT 1,

  CONSTRAINT FK_tblaccountsstatus FOREIGN KEY (idstatus) REFERENCES tbl_status (idstatus)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*********************************************************************************************************************/


/* *** TABLA Cookies*/

CREATE TABLE IF NOT EXISTS tbl_cookies(
	email			VARCHAR(60) NOT NULL,
	pass			VARCHAR(60) NOT NULL,
  sessiontoken	VARCHAR(125) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Comentarios*/

CREATE TABLE IF NOT EXISTS tbl_comments(
	idcomment	INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  iduser		INT NOT NULL,
  comment		VARCHAR(200) NOT NULL,
  dcomment	DATE NOT NULL,
  tcomment	TIME NOT NULL,

  CONSTRAINT FK_comments_iduser FOREIGN KEY (iduser) REFERENCES tbl_users (iduser) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* *** TABLA Soporte técnico*/

CREATE TABLE IF NOT EXISTS tbl_supports(
	idsupport	INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  iduser		INT NOT NULL,
  subject		VARCHAR(100) NOT NULL,
  mssg		VARCHAR(2000) NOT NULL,
  response	VARCHAR(2000) NOT NULL,
  sendmail	BOOLEAN NOT NULL,
  idstatus 	INT NOT NULL,

  CONSTRAINT FK_supports_iduser FOREIGN KEY (iduser) REFERENCES tbl_users (iduser) ON DELETE CASCADE,
  CONSTRAINT FK_supports_idstatus FOREIGN KEY (idstatus) REFERENCES tbl_status (idstatus)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* Registros de Entradas de usuarios */

CREATE TABLE IF NOT EXISTS tbl_inputs(
	idinput		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  iduser		INT NOT NULL,
  indate		DATETIME NOT NULL DEFAULT NOW(),

  CONSTRAINT FK_inputs_iduser FOREIGN KEY (iduser) REFERENCES tbl_users (iduser) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Registros de salidas */

CREATE TABLE IF NOT EXISTS tbl_outputs(
	idoutput	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  iduser		INT NOT NULL,
  outdate		DATETIME NOT NULL DEFAULT NOW(),

	CONSTRAINT FK_outputs_iduser FOREIGN KEY (iduser) REFERENCES tbl_users (iduser) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Registros de cron.php */

CREATE TABLE IF NOT EXISTS tbl_logscron(
	idlog		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idstatus 	INT NOT NULL,
  message		VARCHAR(100) NOT NULL,

  CONSTRAINT FK_logscron_idstatus FOREIGN KEY (idstatus) REFERENCES tbl_status (idstatus)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* Registros de cron.php */

CREATE TABLE IF NOT EXISTS tbl_carta_compromiso(
  iduser    INT NOT NULL,
  detalle   VARCHAR(100) NOT NULL,

  CONSTRAINT FK_carta_compromiso_iduser FOREIGN KEY (iduser) REFERENCES tbl_users (iduser)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;