/*
-----------------------------------------
|       PROCEDIMIENTOS ALMACENADOS      |
-----------------------------------------
*/

USE `educosvo_providers`;


DROP PROCEDURE IF EXISTS sp_getlvl;
DELIMITER //
CREATE PROCEDURE sp_getlvl( _id INT )
BEGIN
	SELECT
		n.level
	FROM
		tbl_users u
	INNER JOIN
		tbl_levels n ON u.idlvl = n.idlvl
	WHERE
		u.iduser = _id AND idstatus = 1;
END //


DROP PROCEDURE IF EXISTS sp_userinfo;
DELIMITER //
CREATE PROCEDURE sp_userinfo( _id INT )
BEGIN
	SELECT
		u.iduser,
		u.name,
        u.email,
		l.level,
		r.region,
        u.position,
        u.idlang,
        i.lancode,
        i.lanicon,
        p.picture,
        e.status,
        c.idcountry,
        u.infoprovider,
        u.revision
	FROM
		tbl_users u
	INNER JOIN
		tbl_levels l ON u.idlvl = l.idlvl
	INNER JOIN
		tbl_regions r ON u.idregion = r.idregion
	INNER JOIN
		tbl_countries c ON r.idcountry = c.idcountry
	INNER JOIN
		tbl_languages i ON u.idlang = i.idlang
	INNER JOIN
		tbl_profilepics p ON u.idpic = p.idpic
	INNER JOIN
		tbl_status e ON u.idstatus = e.idstatus
	WHERE
		u.iduser = _id;
END //


DROP PROCEDURE IF EXISTS sp_updtuser;
DELIMITER //
CREATE PROCEDURE sp_updtuser(
    _name 		VARCHAR(45),
    _position	VARCHAR(70),
    _level 		INT,
    _region 	INT,
    _lang		INT,
    _status 	INT,
    _iduser		INT
)
BEGIN
	UPDATE
		tbl_users
	SET
		name = _name,
        position = _position,
        idlvl = _level,
        idregion = _region,
        idlang = _lang,
        idstatus = _status
	WHERE
		iduser = _iduser;
END //


DROP PROCEDURE IF EXISTS sp_updtuserusers;
DELIMITER //
CREATE PROCEDURE sp_updtuserusers(
    _name 		VARCHAR(45),
    _position	VARCHAR(70),
    _lang		INT,
    _iduser		INT
)
BEGIN
	UPDATE
		tbl_users
	SET
		name = _name,
        position = _position,
        idlang = _lang
	WHERE
		iduser = _iduser;
END //


DROP PROCEDURE IF EXISTS sp_userlist;
DELIMITER //
CREATE PROCEDURE sp_userlist()
BEGIN
	SELECT
		u.iduser,
		u.name,
		u.email,
		u.position,
		r.region,
        i.language,
        u.idlvl,
        n.level,
        u.registertype,
        s.idstatus,
        s.status
	FROM
		tbl_users u
	INNER JOIN
		tbl_regions r ON u.idregion = r.idregion
	INNER JOIN
		tbl_languages i ON u.idlang = i.idlang
	INNER JOIN
		tbl_status s ON u.idstatus = s.idstatus
	INNER JOIN
		tbl_levels n ON u.idlvl = n.idlvl;
END //


DROP PROCEDURE IF EXISTS sp_useregister;
DELIMITER //
CREATE PROCEDURE sp_useregister(
	_name			VARCHAR(45),
	_email			VARCHAR(70),
	_pass			VARCHAR(100),
	_position		VARCHAR(70),
	_region  		INT,
	_lang 			INT,
	_level  		INT,
	_mailregister	INT,
	_status			INT,
	_accesstype 	VARCHAR(8)
)
BEGIN
	INSERT INTO
		`tbl_users`
	VALUES
		(NULL, _name, _level, _region, _email, _email, _pass, _position, NULL, NULL, _accesstype, _mailregister, 0, _lang, 1, _status, 0, 0);
END //


DROP PROCEDURE IF EXISTS sp_supportrequest;
DELIMITER //
CREATE PROCEDURE sp_supportrequest(
	_iduser		INT,
    _subject	VARCHAR(100),
    _mssg		VARCHAR(2000)
)
BEGIN
	INSERT INTO tbl_supports VALUES (NULL, _iduser, _subject, _mssg, '', 0, 5);
END //


DROP PROCEDURE IF EXISTS sp_supportlist;
DELIMITER //
CREATE PROCEDURE sp_supportlist()
BEGIN
	SELECT
		s.idsupport,
		u.name,
		u.email,
		u.position,
        l.level,
		s.subject,
		s.mssg,
		s.response,
		s.idstatus,
		e.status
	FROM
		tbl_supports s
	INNER JOIN
		tbl_users u ON s.iduser = u.iduser
	INNER JOIN
		tbl_status e ON s.idstatus = e.idstatus
    INNER JOIN
		tbl_levels l ON u.idlvl = l.idlvl;
END //


DROP PROCEDURE IF EXISTS sp_getsupportreq;
DELIMITER //
CREATE PROCEDURE sp_getsupportreq( _id INT )
BEGIN
	SELECT
		s.idsupport,
		u.name,
		s.subject,
		s.mssg,
        s.response
	FROM
		tbl_supports s
	INNER JOIN
		tbl_users u ON s.iduser = u.iduser
	WHERE
		s.idsupport = _id;
END //

DROP PROCEDURE IF EXISTS sp_savesupportres;
DELIMITER //
CREATE PROCEDURE sp_savesupportres( _id INT, _res VARCHAR(2000) )
BEGIN
	UPDATE tbl_supports SET response = _res, idstatus = 7 WHERE idsupport = _id;
END //

DROP PROCEDURE IF EXISTS sp_datareport;
DELIMITER //
CREATE PROCEDURE sp_datareport( _option VARCHAR(15) )
BEGIN
	IF _option = 'users' THEN
		SELECT
			u.name AS 'nombre',
			u.email,
			u.position AS 'cargo',
			v.level AS 'permiso',
			u.registertype AS 'tipo_registro',
			l.language AS 'idioma',
			p.picture AS 'imagen',
			s.status AS 'estado'
		FROM
			tbl_users u
		INNER JOIN
			tbl_languages l ON u.idlang = l.idlang
		INNER JOIN
			tbl_profilepics p ON u.idpic = p.idpic
		INNER JOIN
			tbl_status s ON u.idstatus = s.idstatus
		INNER JOIN
			tbl_levels v ON u.idlvl = v.idlvl;
	ELSE IF _option = 'supports' THEN
			SELECT
				u.name AS 'nombre',
				u.email,
				u.position AS 'cargo',
				v.level AS 'permiso',
				u.registertype AS 'tipo_registro',
				l.language AS 'idioma',
				p.picture AS 'imagen',
				s.status AS 'estado',
                sp.subject AS 'asunto',
                sp.mssg AS 'mensaje',
                sp.response AS 'respuesta'
			FROM
				tbl_supports sp
			INNER JOIN
				tbl_users u ON sp.iduser = u.iduser
			INNER JOIN
				tbl_languages l ON u.idlang = l.idlang
			INNER JOIN
				tbl_profilepics p ON u.idpic = p.idpic
			INNER JOIN
				tbl_status s ON sp.idstatus = s.idstatus
			INNER JOIN
				tbl_levels v ON u.idlvl = v.idlvl;
		ELSE IF _option = 'comments' THEN
				SELECT
					u.name AS 'nombre',
					u.email,
					u.position AS 'cargo',
					v.level AS 'permiso',
					u.registertype AS 'tipo_registro',
					l.language AS 'idioma',
					p.picture AS 'imagen',
					s.status AS 'estado',
					c.comment AS 'comentario',
                    c.dcomment AS 'fecha'
				FROM
					tbl_comments c
				INNER JOIN
					tbl_users u ON c.iduser = u.iduser
				INNER JOIN
					tbl_languages l ON u.idlang = l.idlang
				INNER JOIN
					tbl_profilepics p ON u.idpic = p.idpic
				INNER JOIN
					tbl_status s ON u.idstatus = s.idstatus
				INNER JOIN
					tbl_levels v ON u.idlvl = v.idlvl;
			END IF;
		END IF;
    END IF;
END //

-- *--------------------------------------------------------------------------------*

DROP PROCEDURE IF EXISTS sp_infoprovider;
DELIMITER //
CREATE PROCEDURE sp_infoprovider( _iduser INT )
BEGIN
	SELECT
		p.*,
		b.branch
	FROM
		tbl_providers p INNER JOIN tbl_branches b ON p.idbranch = b.idbranch
	WHERE
		iduser = _iduser;
END //


DROP PROCEDURE IF EXISTS sp_infocapacity;
DELIMITER //
CREATE PROCEDURE sp_infocapacity( _idprov INT )
BEGIN
	SELECT
		c.*,
		s.size
	FROM
		tbl_providers_capacity c INNER JOIN tbl_company_size s ON c.idsize = s.idsize
	WHERE
		idprovider = _idprov;
END //


DROP PROCEDURE IF EXISTS sp_filelist;
DELIMITER //
CREATE PROCEDURE sp_filelist( _idprov INT )
BEGIN
    SELECT
		idfile,
        CASE WHEN filename = '' THEN 'Pendiente' ELSE filename END AS 'filename',
        CASE WHEN route = '' THEN 'Pendiente' ELSE route END AS 'route'
	FROM
		tbl_providers_files
	WHERE
		idprovider = _idprov;
END //


DROP PROCEDURE IF EXISTS sp_login;
DELIMITER //
CREATE PROCEDURE sp_login( _email VARCHAR(70), _pass VARCHAR(100) )
BEGIN
	DECLARE _pwd VARCHAR(100);

	SET _pwd = MD5(SHA1(MD5(_pass)));

	SELECT * FROM tbl_users WHERE email = _email OR user = _email AND pass = _pass;
END //