<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing_model extends CI_Model {
    public function getMssql(){
        $otherdb = $this->load->database('migrate', true);     
        $query = $otherdb->select('*')->get('AbrownNew.dbo.GlSubsidiary');
        return $query->result_array();
    }


}