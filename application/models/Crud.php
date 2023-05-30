<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Model
{

    public function Read($TableName, $Condition)
    {

        if ($Condition == '')

            $Condition = ' 1';

        $this->db->where($Condition);

        $data = $this->db->get($TableName);

        return $data->result();
    }

    public function Create($data, $TableName)
    {

        if ($this->db->insert($data, $TableName))

            return $this->db->insert_id();

        else

            return false;
    }

    public function Update($TableName, $Fields, $Condition)
    {

        if ($Condition == '')

            $Condition = ' 1';

        $this->db->where($Condition);

        if ($this->db->update($TableName, $Fields))

            return true;

        else

            return false;
    }

    public function Delete($TableName, $Condition)
    {

        if ($Condition == '')

            $Condition = ' 1';

        $this->db->where($Condition);

        if ($this->db->delete($TableName))

            return true;

        else

            return false;
    }

    public function Count($TableName, $Condition)
    {

        if ($Condition == '')

            $Condition = ' 1';

        $this->db->where($Condition);

        $result = $this->db->get($TableName);

        if ($result)

            return $result->num_rows();

        else

            return false;
    }
}
