<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lot_model extends CI_Model {

    public function get_all_old()
    {
        $query = $this->db->get('lot_old');
        return $query->result();
    }

    public function find($lot)
    {
        $this->db->where('old_lot_id',$lot->old_lot_id);
        $query = $this->db->get('lot');

        if($query->num_rows() == 1)
        {
            return $query->row();
        }
        return false;
    }

    public function insert_lot($lot_old)
    {
        $data = array(
            'old_lot_id' => $lot_old->LotId,
            'project_id' => $lot_old->EnterpriseId,
            'phase_id' => $lot_old->PhaseId,
            'block_no' => $lot_old->BlockNum,
            'lot_no' => $lot_old->LotNum,
            'lot_description' => $lot_old->LotDesc,
            'lot_area' => $lot_old->LotArea,
            'with_house' => $lot_old->WithHouse,
            'availability' => $lot_old->Active,
            'status_id' => 1
        );
        $this->db->insert('lot', $data);
        $last_id = $this->db->insert_id();

        $data2 = array(
            'lot_id' => $last_id,
            'price_per_sqr_meter' => $lot_old->AreaCost,
            'lot_price' => $lot_old->AreaCost * $lot_old->LotArea + $lot_old->HousePrice,
            'house_price' => $lot_old->HousePrice,
            'lot_vat' => $lot_old->VATPrice
        );
        $this->db->insert('lot_price', $data2);
        $last_id2 = $this->db->insert_id();

        echo " NEW:".$last_id." + ".$last_id2." <br>";

        return $last_id;
    }

}