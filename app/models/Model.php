<?php

require_once APP.'/config/Connection.php';

class Model extends Connection
{
	public function pst($query, $arr_data = [], $expect_values = true)
    {
        $pdo = parent::connect();
        $pst = $pdo->prepare($query);
        if ($pst->execute($arr_data)) {
            if ($expect_values)
                $res = $pst->fetchAll();
            else
                $res = true;
        }else {
            $res = false;
        }
        return $res;
    }

    public function info_login($email, $pass = null, $cookie_token = null)
    {
        $cookie_res = (!is_null($cookie_token)) ? $this->pst("SELECT * FROM tbl_cookies WHERE sessiontoken = :token AND email = :email", ['token' => $cookie_token, 'email' => $email]) : false;

        $pass = ($cookie_res) ? "$2y$10$7yBh9vkVZSOkfKF8VTnrVegtPDoPzP/djiXc4/bzbZXlP1.z.6ZHW" : $pass;

        $res = $this->pst("SELECT * FROM tbl_users WHERE email = :email AND idstatus = 1", [ 'email' => $email ]);

        if (!empty($res))
        {
            if (is_null($pass)) {
                $iduser = false;
            }elseif ($pass === "$2y$10$7yBh9vkVZSOkfKF8VTnrVegtPDoPzP/djiXc4/bzbZXlP1.z.6ZHW") {
                $iduser = $res[0]->iduser;
            }else {
                $iduser = (password_verify($pass, $res[0]->pass)) ? $res[0]->iduser : false;
            }

            if ($iduser)
            {
                $res = $this->pst("CALL sp_getlvl(:iduser)", ['iduser' => $iduser]);

                if (!empty($res))
                {
                    $level = $res[0]->level;

                    $res = $this->pst("SELECT COUNT(*) AS 'total' FROM tbl_inputs WHERE iduser = :iduser", ['iduser' => $iduser]);

                    if (!empty($res))
                    {
                        if ($res[0]->total > 0)
                        {
                            # Guardamos los datos del usuario

                            $_SESSION['session_providers'] = $this->user_info($iduser);

                            # Guardamos los valores de idioma seleccionados

                            $_SESSION['lang'] = [ 'lanicon' => $_SESSION['session_providers']['lanicon'], 'lancode' => $_SESSION['session_providers']['lancode'] ];

                            /**** AGREGANDO DATOS PARA DASHBOARD DEL USUARIO ****/

                            # Guardamos el último ingreso

                            $llogin = $this->pst("SELECT DATE_FORMAT(indate, '🗓️ %d/%m/%Y ⌚ %r') as indate FROM tbl_inputs WHERE iduser = :iduser ORDER BY idinput DESC LIMIT 1", ['iduser' => $iduser]);

                            $_SESSION['session_providers']['llogin'] = $llogin[0]->indate;

                            # Guardamos el ingreso actual

                            $this->pst("INSERT INTO tbl_inputs(iduser) VALUES (:iduser)", ['iduser' => $iduser], false);

                            return true;
                        }
                        else
                        {
                            return 'firstIn';
                        }
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function deleteuser($id)
    {
        return $this->pst("DELETE FROM tbl_users WHERE iduser = :id", ['id' => $id], false);
    }

    public function outputs($id)
    {
        $this->pst("INSERT INTO tbl_outputs(iduser) VALUES (:id)", ['id' => $id], false);
    }

	public function user_info($iduser)
    {
    	$res = $this->pst("CALL sp_userinfo(:iduser)", ['iduser' => $iduser]);

    	if (!empty($res))
		{
			$info = [];

			foreach($res as $val)
			{
                $info['id'] = $val->iduser;
				$info['name'] = $val->name;
				$info['email'] = $val->email;
				$info['level'] = $val->level;
                $info['region'] = $val->region;
                $info['idlang'] = $val->idlang;
                $info['lancode'] = $val->lancode;
                $info['lanicon'] = $val->lanicon;
				$info['position'] = $val->position;
                $info['pic'] = base64_encode($val->picture);
                $info['status'] = $val->status;
                $info['idcountry'] = $val->idcountry;
                $info['register'] = $val->infoprovider;
                $info['revision'] = $val->revision;
			}

			return $info;
		}
		else
		{
			return false;
		}
    }

    public function lang_list()
    {
        $res = $this->pst("SELECT * FROM tbl_languages");

        if (!empty($res))
        {
            $info = [];

            foreach($res as $val)
            {
                $info['idlang'][] = $val->idlang;
                $info['language'][] = $val->language;
                $info['lancode'][] = $val->lancode;
                $info['lanicon'][] = $val->lanicon;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function region_list()
    {
        $res = $this->pst("SELECT * FROM tbl_regions");

        if (!empty($res))
        {
            $info = [];

            foreach($res as $val)
            {
                $info['idregion'][] = $val->idregion;
                $info['region'][] = $val->region;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function branch_list()
    {
        $res = $this->pst("SELECT b.*, s.status FROM tbl_branches b INNER JOIN tbl_status s ON b.idstatus = s.idstatus");

        if (!empty($res))
        {
            $info = [];

            foreach($res as $val)
            {
                $info['idbranch'][] = $val->idbranch;
                $info['branch'][] = $val->branch;
                $info['idstatus'][] = $val->idstatus;
                $info['status'][] = $val->status;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function ch_branch_status($data)
    {
        $res = $this->pst("UPDATE tbl_branches SET idstatus = :status WHERE idbranch = :id", $data, false);

        return $res;
    }

    public function new_branch($data)
    {
        $res = $this->pst("INSERT INTO tbl_branches VALUES (NULL, :branch, 1)", $data, false);

        return $res;
    }

    public function edit_branch($data)
    {
        try {
            $res = $this->pst("UPDATE tbl_branches SET branch = :branch WHERE idbranch = :id", $data, false);
        } catch (Exception $e) {
            $res = false;
        }

        return $res;
    }

    public function company_size_list()
    {
        $res = $this->pst("SELECT * FROM tbl_company_size");

        if (!empty($res))
        {
            $info = [];

            foreach($res as $val)
            {
                $info['idsize'][] = $val->idsize;
                $info['size'][] = $val->size;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function type_providers_list()
    {
        $res = $this->pst("SELECT * FROM tbl_typeofproviders");

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idtype'][] = $val->idtype;
                $info['typeprovider'][] = $val->typeprovider;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function info_provider($id)
    {
        $res = $this->pst("CALL sp_infoprovider(:id)", ['id' => $id]);

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idprovider'] = $val->idprovider;
                $info['name'] = $val->name;
                $info['reason'] = $val->reason;
                $info['address'] = $val->address;
                $info['activity'] = $val->activity;
                $info['tel'] = $val->tel;
                $info['email'] = $val->email;
                $info['website'] = $val->website;
                $info['prodservice'] = $val->prodservice;
                $info['legal'] = $val->legalrepresentative;
                $info['iva'] = $val->iva;
                $info['nit'] = $val->nit;
                $info['type'] = $val->type;
                $info['idbranch'] = $val->idbranch;
                $info['iduser'] = $val->iduser;
                $info['carta'] = $val->cartacompromiso;
                $info['aceptacion'] = $val->aceptaciondecumplimiento;
                $info['approved'] = $val->approved;
                $info['idstatus'] = $val->idstatus;
                $info['branch'] = $val->branch;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function list_homos($iduser)
    {
        $res = $this->pst("SELECT h.*, s.status FROM tbl_homologaciones h INNER JOIN tbl_status s ON h.idstatus = s.idstatus WHERE iduser = :id", ['id' => $iduser]);

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val) {
                $info['shipdate'][] = $val->shipdate;
                $info['recepdate'][] = $val->recepdate;
                $info['idstatus'][] = $val->idstatus;
                $info['status'][] = $val->status;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function validar_homologaciones($iduser)
    {
        $res = $this->pst("SELECT idstatus FROM tbl_homologaciones WHERE iduser = :id", ['id' => $iduser]);

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val) {
                $info['idstatus'][] = $val->idstatus;
            }

            $_SESSION['info'] = $info['idstatus'];

            return (in_array(4, $info['idstatus'])) ? false : true;
        }
        else
        {
            return true;
        }
    }

    public function homologacion_abierta($iduser)
    {
        $res = $this->pst("SELECT idstatus FROM tbl_homologaciones WHERE iduser = :id", ['id' => $iduser]);

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val) {
                $info['idstatus'][] = $val->idstatus;
            }

            return (in_array(4, $info['idstatus'])) ? true : false;
        }
        else
        {
            return false;
        }
    }

    public function iniciar_homologacion($iduser, $fecha)
    {
        $provider = $this->info_provider($iduser);

        $res = $this->pst("INSERT INTO tbl_homologaciones VALUES (:id, :shipdate, NULL, 4)", ['id' => $iduser, 'shipdate' => $fecha], false);

        return $res;
    }

    public function finalizar_homologacion($iduser)
    {
        $provider = $this->info_provider($iduser);

        $res = $this->pst("UPDATE tbl_homologaciones SET recepdate = :recepdate, idstatus = 5 WHERE iduser = :id AND idstatus = 4", ['id' => $iduser, 'recepdate' => date('Y-m-d')], false);

        $result = ($res) ? $this->pst("UPDATE tbl_providers SET hstatus = 5 WHERE iduser = :id", ['id' => $iduser], false) : false;

        return $result;
    }

    public function providers_list()
    {
        $res = $this->pst("SELECT p.*, b.branch FROM tbl_providers p INNER JOIN tbl_branches b ON p.idbranch = b.idbranch WHERE p.idstatus = 1 ORDER BY b.branch ASC");

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idprovider'][] = $val->idprovider;
                $info['name'][] = $val->name;
                $info['reason'][] = $val->reason;
                $info['address'][] = $val->address;
                $info['activity'][] = $val->activity;
                $info['tel'][] = $val->tel;
                $info['email'][] = $val->email;
                $info['website'][] = $val->website;
                $info['prodservice'][] = $val->prodservice;
                $info['legal'][] = $val->legalrepresentative;
                $info['iva'][] = $val->iva;
                $info['nit'][] = $val->nit;
                $info['type'][] = $val->type;
                $info['idbranch'][] = $val->idbranch;
                $info['iduser'][] = $val->iduser;
                $info['carta'][] = $val->cartacompromiso;
                $info['aceptacion'][] = $val->aceptaciondecumplimiento;
                $info['approved'][] = $val->approved;
                $info['branch'][] = $val->branch;
                $info['hstatus'][] = $val->hstatus;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function accounts_list()
    {
        $res = $this->pst("SELECT * FROM tbl_accounts");

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idaccount'][] = $val->idaccount;
                $info['account'][] = $val->account;
                $info['description'][] = $val->description;
                $info['idstatus'][] = $val->idstatus;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function projects_list()
    {
        $res = $this->pst("SELECT * FROM tbl_projects");

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idproject'][] = $val->idproject;
                $info['codproject'][] = $val->codproject;
                $info['name'][] = $val->name;
                $info['shortname'][] = $val->shortname;
                $info['idstatus'][] = $val->idstatus;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function activities_list($idproject)
    {
        $res = $this->pst("SELECT * FROM tbl_activities WHERE idproject = :id AND idstatus = 1", ['id' => $idproject]);

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idactivity'][] = $val->idactivity;
                $info['codactivity'][] = $val->codactivity;
                $info['description'][] = $val->description;
                $info['idproject'][] = $val->idproject;
                $info['idstatus'][] = $val->idstatus;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function funders_list()
    {
        $res = $this->pst("SELECT * FROM tbl_funders");

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idfunder'][] = $val->idfunder;
                $info['name'][] = $val->name;
                $info['codfunder'][] = $val->codfunder;
                $info['idstatus'][] = $val->idstatus;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function cost_centers()
    {
        $res = $this->pst("SELECT * FROM tbl_cost_centers");

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idcostcenter'][] = $val->idcostcenter;
                $info['codcostcenter'][] = $val->codcostcenter;
                $info['idcostcenterregion'][] = $val->idcostcenterregion;
                $info['name'][] = $val->name;
                $info['description'][] = $val->description;
                $info['idregion'][] = $val->idregion;
                $info['idstatus'][] = $val->idstatus;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function info_seller($id)
    {
        $res = $this->pst("SELECT * FROM tbl_executives WHERE idprovider = :id", ['id' => $id]);

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idseller'] = $val->idexecutive;
                $info['name'] = $val->name;
                $info['tel'] = $val->officephone;
                $info['cell'] = $val->tel;
                $info['email'] = $val->email;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function info_capacity($id)
    {
        $res = $this->pst("CALL sp_infocapacity(:id)", ['id' => $id]);

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idcapacity'] = $val->idcapacity;
                $info['idsize'] = ($val->idsize == 1) ? 'Si' : 'No';
                $info['size'] = $val->size;
                $info['installs'] = ($val->instalations == 1) ? 'Si' : 'No';
                $info['methods'] = ($val->methods == 1) ? 'Si' : 'No';
                $info['politics'] = ($val->politics == 1) ? 'Si' : 'No';
                $info['services'] = ($val->services == 1) ? 'Si' : 'No';
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function info_various($id)
    {
        $res = $this->pst("SELECT * FROM tbl_various WHERE idprovider = :id", ['id' => $id]);

        if (!empty($res))
        {
            $info = [];

            foreach ($res as $val)
            {
                $info['idvarious'] = $val->idvarious;
                $info['processes'] = ($val->processes == 1) ? 'Si' : 'No';
                $info['rights'] = ($val->rights == 1) ? 'Si' : 'No';
                $info['env'] = ($val->environment == 1) ? 'Si' : 'No';
                $info['social'] = ($val->socialresponsability == 1) ? 'Si' : 'No';
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function file_list($iduser)
    {
        $val = $this->pst("SELECT idprovider FROM tbl_providers WHERE iduser = :id", ['id' => $iduser]);

        if (!empty($val))
        {
            $res = $this->pst("CALL sp_filelist(:id)", ['id' => $val[0]->idprovider]);

            if (!empty($res))
            {
                $info = [];

                foreach ($res as $val)
                {
                    $info['idfile'][] = $val->idfile;
                    $info['filename'][] = $val->filename;
                    $info['route'][] = $val->route;
                }

                return $info;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function get_route_file($idfile)
    {
        $res = $this->pst("SELECT route FROM tbl_providers_files WHERE idfile = :id", ['id' => $idfile]);

        if (!empty($res))
        {
            return $res[0]->route;
        }
        else
        {
            return false;
        }
    }

    public function delete_file($idfile)
    {
        $res = $this->pst("DELETE FROM tbl_providers_files WHERE idfile = :id", ['id' => $idfile]);

        return $res;
    }

    public function add_file($nombre, $ruta, $iduser)
    {
        $val = $this->pst("SELECT idprovider FROM tbl_providers WHERE iduser = :id", ['id' => $iduser]);

        if (!empty($val))
        {
            $idprovider = $val[0]->idprovider;

            $arr_data = [
                'name' => $nombre,
                'ruta' => $ruta,
                'id' => $idprovider
            ];

            $res = $this->pst("INSERT INTO tbl_providers_files VALUES (NULL, :name, :ruta, :id)", $arr_data, false);

            return $res;
        }
        else
        {
            return false;
        }
    }

    public function pic_provprofile()
    {
        $res = $this->pst("SELECT * FROM tbl_profilepics WHERE idpic = 1");

        return base64_encode($res[0]->picture);
    }

    public function existe_provider($nit)
    {
        return empty($this->pst('SELECT * FROM `tbl_providers` WHERE nit = :nit', ['nit' => $nit]));
    }

    public function activar_revision($id)
    {
        $this->pst("UPDATE tbl_users SET revision = 1 WHERE iduser = :id", ['id' => $id], false);
    }

    public function add_provider($data_provider, $data_executive)
    {
        $provider = $this->pst("INSERT INTO tbl_providers VALUES (NULL, :name, :reason, :dir, :activity, :tel, :email, :website, :prodservice, :legal, :iva, :nit, :provtype, :branch, :id, NULL, NULL, '0', 1, 4)", $data_provider, false);

        if ($provider)
        {
            $res = $this->pst("SELECT idprovider FROM tbl_providers WHERE iduser = :id", ['id' => $data_provider['id']]);

            if (!empty($res))
            {
                $idprovider = $res[0]->idprovider;

                $data_executive['id'] = $idprovider;

                $executive = $this->pst("INSERT INTO tbl_executives VALUES (NULL, :sellername, :sellertel, :sellercell, :sellermail, :id)", $data_executive, false);

                if ($executive)
                {
                    $update = $this->pst("UPDATE tbl_users SET infoprovider = 1 WHERE iduser = :id", ['id' => $data_provider['id']], false);

                    $_SESSION['session_providers']['register'] = ($update) ? 1 : 0;

                    return $update;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function update_provider($data_provider, $data_executive)
    {
        $provider = $this->pst("UPDATE tbl_providers SET name = :name, reason = :reason, address = :dir, activity = :activity, tel = :tel, email = :email, website = :website, prodservice = :prodservice, legalrepresentative = :legal, iva = :iva, nit = :nit, type = :provtype, idbranch = :branch WHERE iduser = :id", $data_provider, false);

        if ($provider)
        {
            $res = $this->pst("SELECT idprovider FROM tbl_providers WHERE iduser = :id", ['id' => $data_provider['id']]);

            if (!empty($res))
            {
                $idprovider = $res[0]->idprovider;

                $data_executive['id'] = $idprovider;

                $executive = $this->pst("UPDATE tbl_executives SET name = :sellername, officephone = :sellertel, tel = :sellercell, email = :sellermail WHERE idprovider = :id", $data_executive, false);

                return $executive;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function edit_provider($name, $type, $contact, $tel, $id)
    {
        $arr_data = [
            'name' => $name,
            'type' => $type,
            'contact' => $contact,
            'tel' => $tel,
            'id' => $id
        ];

        $query = "UPDATE tbl_providers SET name = :name, contact = :contact, tel = :tel, idtype = :type WHERE idprovider = :id";

        $res = $this->pst($query, $arr_data, false);

        return $res;
    }

    public function remove_provider($iduser)
    {
        $result = false;

        $res1 = $this->pst("UPDATE `tbl_providers` SET idstatus = 2 WHERE iduser = :id", ['id' => $iduser], false);

        $res2 = $this->pst("UPDATE `tbl_users` SET idstatus = 2 WHERE iduser = :id", ['id' => $iduser], false);

        $result = ($res1 && $res2) ? true : false;

        // $res1 = $this->pst("DELETE FROM `tbl_executives` WHERE idprovider = :id", ['id' => $id], false);

        // if ($res1)
        // {
        //     $res2 = $this->pst("DELETE FROM `tbl_providers_capacity` WHERE idprovider = :id", ['id' => $id], false);

        //     if ($res2)
        //     {
        //         $res3 = $this->pst("DELETE FROM `tbl_providers_files` WHERE idprovider = :id", ['id' => $id], false);

        //         if ($res3)
        //         {
        //             $res4 = $this->pst("DELETE FROM `tbl_various` WHERE idprovider = :id", ['id' => $id], false);

        //             if ($res4)
        //             {
        //                 $res5 = $this->pst("DELETE FROM `tbl_providers` WHERE iduser = :iduser", ['iduser' => $iduser], false);

        //                 if ($res5)
        //                 {
        //                     $res6 = $this->pst("DELETE FROM `tbl_carta_compromiso` WHERE iduser = :iduser", ['iduser' => $iduser], false);

        //                     if ($res6)
        //                     {
        //                         $res7 = $this->pst("DELETE FROM `tbl_users` WHERE iduser = :iduser", ['iduser' => $iduser], false);

        //                         if ($res7)
        //                         {
        //                             $result = true;
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

        return $result;
    }

    public function update_user($data_user)
    {
        $id = (isset($_SESSION['val'])) ? $_SESSION['val'] : $_SESSION['session_providers']['id'];
        $name = $data_user[0];
        $position = $data_user[1];
        $level = $data_user[2];
        $status = $data_user[3];
        $lang = $data_user[4];
        $region = $data_user[5];

        $data = [
            'name' => $name,
            'position' => $position,
            'lang' => $lang,
            'region' => $region,
            'level' => $level,
            'status' => $status,
            'id' => $id
        ];

        $res = $this->pst("CALL sp_updtuser(:name, :position, :level, :region, :lang, :status, :id)", $data, false);

        if (!isset($_SESSION['val']))
            $_SESSION['session_providers'] = $this->user_info($id);

        return ($res) ? true : false;
    }

    public function update_user_users($data_user)
    {
        $iduser = $_SESSION['session_providers']['id'];

        $data = [
            'name' => $data_user[0],
            'position' => $data_user[1],
            'lang' => $data_user[2],
            'id' => $iduser
        ];

        $res = $this->pst("CALL sp_updtuserusers(:name, :position, :lang, :id)", $data, false);

        $_SESSION['session_providers'] = $this->user_info($iduser);

        unset($_SESSION['updateInfoUser']);

        return ($res) ? true : false;
    }

	public function set_cookie_token($email, $token)
	{
        $arr_data = [
            'email' => $email,
            'token' => $token
        ];

		$res = $this->pst("INSERT INTO tbl_cookies VALUES (:email, :token)", $arr_data, false);

		if($res)
			return true;
		else
			return false;
	}

	public function get_cookie_token($token)
    {
        $res = $this->pst("SELECT email FROM tbl_cookies WHERE sessiontoken = :token", ['token' => $token]);

        return (!empty($res)) ? $res[0]->email : false;
    }

	public function set_reset_token($email, $token)
	{
        $now = date('Y-m-d');

        $arr_data = [
            'token' => $token,
            'now' => date('Y-m-d'),
            'email' => $email,
            'id' => 1
        ];

		$res = $this->pst("UPDATE tbl_users SET token = :token, tokendate = :now WHERE email = :email AND idstatus = :id", $arr_data, false);

        return ($res) ? true : false;
	}

	public function token_validator($token)
	{
		if (strlen($token) == 50)
		{
			$res = $this->pst("SELECT * FROM tbl_users WHERE token = :token", ['token' => $token]);

			if (!empty($res))
				return true;
			else
				return false;
		}
	}

	public function recover_password($pass, $token)
	{
        $data = $this->pst("SELECT iduser FROM tbl_users WHERE token = :token", ['token' => $token]);

        if (!empty($data))
        {
            unset($_SESSION['token']);

            $id = $data[0]->iduser;

            $this->pst("INSERT INTO tbl_inputs(iduser) VALUES (:id)", ['id' => $id], false);

            $arr_data = [
                'pass' => $pass,
                'token' => NULL,
                'td' => NULL,
                'fp' => 0,
                'idstatus' => 1,
                'iduser' => $id
            ];

            $query = "UPDATE tbl_users SET pass = :pass, token = :token, tokendate = :td, forgetpass = :fp, idstatus = :idstatus WHERE iduser = :iduser";

            $res = $this->pst($query, $arr_data, false);

    		return ($res) ? true : false;
        }
        else
        {
            return false;
        }
	}

	public function pass_validator($currentpwd, $iduser)
	{
		$res = $this->pst("SELECT * FROM tbl_users WHERE iduser = :iduser", ['iduser' => $iduser]);

        return (password_verify($currentpwd, $res[0]->pass)) ? true : false;
	}

	public function update_password($pass, $id)
	{
        $arr_data = [
            'pass' => $pass,
            'iduser' => $id
        ];

		$res = $this->pst("UPDATE tbl_users SET pass = :pass WHERE iduser = :iduser", $arr_data, false);

		return ($res) ? true : false;
	}

    public function thumbnail_profile()
    {
        $res = $this->pst("SELECT * FROM tbl_profilepics");

        if (!empty($res))
        {
            $fotos = [];

            foreach ($res as $val)
            {
                $fotos['id'][] = $val->idpic;
                $fotos['name'][] = $val->name;
                $fotos['format'][] = $val->format;
                $fotos['pic'][] = base64_encode($val->picture);
            }

            return $fotos;
        }
        else
        {
            return false;
        }
    }

    public function update_pic($idpic)
    {
        $arr_data = [
            'idpic' => $idpic,
            'iduser' => $_SESSION['session_providers']['id']
        ];

        $res = $this->pst("UPDATE tbl_users SET idpic = :idpic WHERE iduser = :iduser", $arr_data, false);

        $profile = $this->user_info($_SESSION['session_providers']['id']);

        $_SESSION['session_providers']['pic'] = $profile['pic'];

        return ($res) ? true : false;
    }

    public function status_list()
    {
        $res = $this->pst("SELECT * FROM tbl_status");

        if (!empty($res))
        {
            $stts = [];

            foreach ($res as $val)
            {
                $stts['id'][] = $val->idstatus;
                $stts['status'][] = $val->status;
            }

            return $stts;
        }
        else
        {
            return false;
        }
    }

    public function user_list()
    {
        $res = $this->pst("CALL sp_userlist()");

        if (!empty($res))
        {
            $userdata = [];

            foreach ($res as $val)
            {
                $userdata['id'][] = $val->iduser;
                $userdata['name'][] = $val->name;
                $userdata['email'][] = $val->email;
                $userdata['position'][] = $val->position;
                $userdata['region'][] = $val->region;
                $userdata['language'][] = $val->language;
                $userdata['idlvl'][] = $val->idlvl;
                $userdata['level'][] = $val->level;
                $userdata['registertype'][] = $val->registertype;
                $userdata['status'][] = $val->status;
                $userdata['idstatus'][] = $val->idstatus;
            }

            return $userdata;
        }
        else
        {
            return false;
        }
    }

    public function product_list()
    {
        $res = $this->pst("SELECT * FROM tbl_products");

        if (!empty($res))
        {
            $info = [];

            $n = 1;

            foreach ($res as $val)
            {
                $info[] = [
                    'no' => $n,
                    'codproduct' => $val->codproduct,
                    'description' => $val->description,
                    'price' => $val->price,
                    'status' => $val->status
                ];

                $n++;
            }

            return $info;
        }
        else
        {
            return false;
        }
    }

    public function level_list()
    {
        $res = $this->pst("SELECT * FROM tbl_levels");

        if (!empty($res))
        {
            $data = [];

            foreach ($res as $val)
            {
                $data['id'][] = $val->idlvl;
                $data['level'][] = $val->level;
            }

            return $data;
        }
        else
        {
            return false;
        }
    }

    public function support_list()
    {
        $res = $this->pst("CALL sp_supportlist()");

        if (!empty($res))
        {
            $supports = [];

            foreach ($res as $val)
            {
                $supports['idsupport'][] = $val->idsupport;
                $supports['name'][] = $val->name;
                $supports['email'][] = $val->email;
                $supports['position'][] = $val->position;
                $supports['level'][] = $val->level;
                $supports['subject'][] = $val->subject;
                $supports['mssg'][] = $val->mssg;
                $supports['response'][] = $val->response;
                $supports['idstatus'][] = $val->idstatus;
                $supports['status'][] = $val->status;
            }

            return $supports;
        }
        else
        {
            return false;
        }
    }

    public function insert_comment($comment, $iduser)
    {
        if (!empty($comment))
        {
            $arr_data = [
                'idc' => null,
                'idu' => $iduser,
                'comment' => $comment
            ];

            $query = "INSERT INTO tbl_comments VALUES (:idc, :idu, :comment, CURDATE(), TIME_FORMAT(NOW(), '%H:%i'))";

            return $this->pst($query, $arr_data, false);
        }
        else
        {
            return false;
        }
    }

    public function del_comment($idcomment, $iduser)
    {
        $arr_data = [
            'idc' => $idcomment,
            'idu' => $iduser
        ];

        $res = $this->pst("SELECT * FROM tbl_comments WHERE idcomment = :idc AND iduser = :idu", $arr_data);

        if (!empty($res))
        {
            $this->pst("DELETE FROM tbl_comments WHERE idcomment = :idc", ['idc' => $idcomment], false);
        }
    }

    public function get_comments()
    {
        $res = $this->pst("SELECT * FROM tbl_comments ORDER BY idcomment DESC");

        if (!empty($res))
        {
            $comments = [];

            foreach ($res as $val)
            {
                $comments['id'][] = $val->idcomment;
                $comments['idUser'][] = $val->iduser;
                $comments['comment'][] = $val->comment;
                $comments['date'][] = $val->dcomment;
                $comments['time'][] = $val->tcomment;
            }

            return $comments;
        }
        else
        {
            return false;
        }
    }

    public function is_correct_mail($email)
    {
        $res = $this->pst("SELECT * FROM tbl_users WHERE email = :email", ['email' => $email]);

        if (!empty($res))
        {
            $data = [];

            $data['iduser'] = $res[0]->iduser;
            $data['name'] = $res[0]->name;
            $data['email'] = $res[0]->email;

            return $data;
        }
        else
        {
            return false;
        }
    }

    public function recovery_req_on($iduser)
    {
        return $this->pst("UPDATE tbl_users SET forgetpass = 1 WHERE iduser = :id", ['id' => $iduser], false);
    }

    public function available_mail($email)
    {
        $res = $this->pst("SELECT * FROM tbl_users WHERE email = :email", ['email' => $email]);
        return (empty($res)) ? true : false;
    }

    public function register_user($name, $email, $position, $region, $lang, $level, $pwd, $accesstype)
    {
        $arr_data = [
            'name' => $name,
            'email' => $email,
            'pwd' => $pwd,
            'position' => $position,
            'region' => $region,
            'lang' => $lang,
            'level' => $level
        ];

        if (is_null($accesstype))
            return $this->pst("CALL sp_useregister(:name, :email, :pwd, :position, :region, :lang, :level, 0, 1, 'local')", $arr_data, false);
        else
            return $this->pst("CALL sp_useregister(:name, :email, :pwd, :position, :region, :lang, :level, 1, 1, 'social')", $arr_data, false);
    }

    protected function del_register($token)
    {
        $this->pst("DELETE FROM tbl_users WHERE token = :token", ['token' => $token], false);
    }

    protected function del_restore($token)
    {
        $this->pst("UPDATE tbl_users SET token = NULL, tokendate = NULL WHERE token = :token", ['token' => $token], false);
    }

    public function new_support_request($subject, $mssg, $id)
    {
        $arr_data = [
            'id' => $id,
            'subject' => $subject,
            'mssg' => $mssg
        ];

        return $this->pst("CALL sp_supportrequest(:id, :subject, :mssg)", $arr_data, false);
    }

    public function history_request($iduser)
    {
        $query = "SELECT s.subject, s.mssg, s.response, s.idstatus, e.status FROM tbl_supports s INNER JOIN tbl_status e ON s.idstatus = e.idstatus WHERE iduser = :iduser";

        $res = $this->pst($query, ['iduser' => $iduser]);

        if (!empty($res))
        {
            $list = [];

            foreach ($res as $val)
            {
                $list['subject'][] = $val->subject;
                $list['mssg'][] = $val->mssg;
                $list['response'][] = $val->response;
                $list['idstatus'][] = $val->idstatus;
                $list['status'][] = $val->status;
            }

            return $list;
        }
        else
        {
            return false;
        }
    }

    public function log_history($iduser)
    {
        $res = $this->pst('CALL sp_loghistory(:iduser)', ['iduser' => $iduser]);

        if (!empty($res))
        {
            $history = [];

            foreach ($res as $val)
            {
                $history['idbinnacle'][] = $val->idbinnacle;
                $history['plate'][] = $val->plate;
                $history['brand'][] = $val->brand;
                $history['color'][] = $val->color;
                $history['region'][] = $val->region;
                $history['outdate'][] = $val->outdate;
                $history['outtime'][] = $val->outtime;
                $history['initkm'][] = $val->initkm;
                $history['entrydate'][] = $val->entrydate;
                $history['entrytime'][] = $val->entrytime;
                $history['endkm'][] = $val->endkm;
                $history['destination'][] = $val->destination;
                $history['status'][] = ($val->idstatus = 6) ? '<span class="badge badge-success">Finalizado</span>' : '<span class="badge badge-danger">Pendiente</span>';
            }

            return $history;
        }
        else
        {
            return false;
        }
    }

    public function charts($iduser, $year)
    {
        $res = $this->pst("SELECT MONTH(b.entrydate) AS 'mes', COUNT(*) AS 'total' FROM tbl_binnacles b WHERE YEAR(b.entrydate) = :year AND iduser = :iduser GROUP BY mes ASC", ['year' => $year, 'iduser' => $iduser]);

        if (!empty($res))
        {
            $data = [];

            $chart = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            foreach ($res as $val)
            {
                $data['mes'][] = $val->mes;
                $data['total'][] = $val->total;
            }

            foreach ($data['mes'] as $i => $val)
            {
                $chart[$i] = $data['total'][$i];
            }

            return $chart;
        }
        else
        {
            return false;
        }
    }

    protected function set_token_register($email, $token)
    {
        $arr_data = [
            'token' => $token,
            'now' => date('Y-m-d'),
            'email' => $email,
            'id' => 1
        ];

        return $this->pst("UPDATE tbl_users SET token = :token, tokendate = :now WHERE email = :email AND idstatus = :id", $arr_data, false);
    }

    protected function mails_sent($id, $token)
    {
        $arr_data = [
            'token' => $token,
            'now' => date('Y-m-d'),
            'register' => 1,
            'id' => $id,
            'status' => 1
        ];

        $query = "UPDATE tbl_users SET token = :token, tokendate = :now, registermail = :register, idstatus = :status WHERE iduser = :id";

        $res = $this->pst($query, $arr_data, false);

        return ($res) ? true : false;
    }

    protected function savelog($id, $mensaje)
    {
        $arr_data = [
            'idlog' => null,
            'idstatus' => $id,
            'mnsj' => $mensaje
        ];

        $this->pst("INSERT INTO tbl_logscron VALUES (:idlog, :idstatus, :mnsj)", $arr_data, false);
    }

    public function info_carta($iduser)
    {
        $res = $this->pst("SELECT * FROM tbl_carta_compromiso WHERE iduser = :id", ['id' => $iduser]);

        if (!empty($res))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function add_carta_noti($id, $detalle)
    {
        return $this->pst("INSERT INTO `tbl_carta_compromiso` (`iduser`, `detalle`) VALUES (:id, :detalle)", ['id' => $id, 'detalle' => $detalle], false);
    }

    public function aprobar_proveedor($id)
    {
        return $this->pst("UPDATE tbl_providers SET approved = 1 WHERE iduser = :id  ", ['id' => $id], false);
    }

    public function desaprobar_proveedor($id)
    {
        return $this->pst("UPDATE tbl_providers SET approved = 0 WHERE iduser = :id  ", ['id' => $id], false);
    }
}