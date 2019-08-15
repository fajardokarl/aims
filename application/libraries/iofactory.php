<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH."/third_party/PHPExcel/PHPExcel_IOFactory.php";
 
class iofactory extends PHPExcel_IOFactory {
    public function __construct() {
        parent::__construct();
    }
}