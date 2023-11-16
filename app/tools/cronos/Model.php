<?php

require_once "Dbcon.php";

class Model extends Dbcon
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

	protected function setResetToken($email, $token)
	{
        $arr_data = [
            'token' => $token,
            'now' => date('Y-m-d'),
            'email' => $email,
            'id' => 1
        ];

		$res = $this->pst("UPDATE tbl_users SET token = :token, tokendate = :now WHERE email = :email AND idstatus = :id", $arr_data, false);

        return ($res) ? true : false;
	}

	protected function pendingRegisterMails()
    {
        $res = $this->pst("SELECT * FROM tbl_users WHERE registermail = :register AND idstatus = :id", ['register' => 0, 'id' => 3]);

        if (!empty($res))
        {
            $userdata = [];
            foreach ($res as $val)
            {
                $userdata['id'][] = $val->iduser;
                $userdata['name'][] = $val->name;
                $userdata['email'][] = $val->email;
            }
            return $userdata;
        }
        else
        {
            return false;
        }
    }

    protected function pendingSupportMails()
    {
        $query = "SELECT s.*, u.name, u.email FROM tbl_supports s INNER JOIN tbl_users u ON s.iduser = u.iduser WHERE s.sendmail = :send AND s.idstatus = :id";
        $res = $this->pst($query, ['send' => 0, 'id' => 5]);

        if (!empty($res))
        {
            $info = [];
            foreach ($res as $val)
            {
                $info['idsupport'][] = $val->idsupport;
                $info['subject'][] = $val->subject;
                $info['mssg'][] = $val->mssg;
                $info['name'][] = $val->name;
                $info['email'][] = $val->email;
            }
            return $info;
        }
        else
        {
            return false;
        }
    }

    protected function pendingForgetMails()
    {
        $res = $this->pst("SELECT * FROM tbl_users WHERE forgetpass = :val AND idstatus = :id", ['val' => 1, 'id' => 1]);

        if (!empty($res))
        {
            $userdata = [];
            foreach ($res as $val)
            {
                $userdata['id'][] = $val->iduser;
                $userdata['name'][] = $val->name;
                $userdata['email'][] = $val->email;
            }
            return $userdata;
        }
        else
        {
            return false;
        }
    }

    protected function updatesupportreq($id)
    {
        return $this->pst("UPDATE tbl_supports SET sendmail = :send WHERE idsupport = :id", ['send' => 1, 'id' => $id], false);
    }

    protected function mails_sent($id, $token)
    {
        $arr_data = [
            'token' => $token,
            'now' => date('Y-m-d'),
            'register' => 1,
            'id' => $id
        ];

        $query = "UPDATE tbl_users SET token = :token, tokendate = :now, registermail = :register WHERE iduser = :id";

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
}