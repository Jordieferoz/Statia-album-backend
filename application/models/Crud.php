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

    public function getOrderOfSeller($startDate, $endDate, $sellerId)
    {
        return $this->db
            ->select('*')
            ->from('orders')
            ->join('cart', 'orders.ukey = cart.order_id', 'inner')
            ->join('products', 'cart.product_id = products.id', 'inner')
            ->where('products.the_creator', $sellerId)
            ->where('orders.ordered_date >=', $startDate)
            ->where('orders.ordered_date <=', $endDate)
            ->get()
            ->result();
    }

    public function getOrderOfFranchise($startDate, $endDate, $pincodes)
    {
        $this->db
            ->select('*')
            ->from('orders')
            ->where('orders.ordered_date >=', $startDate)
            ->where('orders.ordered_date <=', $endDate);
        foreach (explode(', ', $pincodes) as $key => $value) {
            $this->db->or_where('orders.pincode', $value);
        }
        return $this->db
            ->get()
            ->result();
    }
}
