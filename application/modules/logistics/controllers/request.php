<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class request extends CI_Controller {
        function __construct()
    {
        // Construct the parent class
        parent::__construct();  
        $this->load->model('Request_model','request');
        $this->load->helper(array('form', 'url'));
        //$this->data['customjs'] = 'marketing/customjs';
        $this->data['customjs'] = 'logistics/formCustomJs';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
       
    }

    public function index()
    {        
        $this->data['content'] = 'form1';
        $this->data['page_title'] = 'Purchase Request Form';        
        $this->load->helper('url');
        $this->load->helper('date');        
        $this->data['all_items'] = $this->request->retrieve_all_items();
        $this->data['item_replacements'] = $this->request->retrieve_all_items_replacements();
        $this->data['item'] = $this->request->retrieve_all(); 
        $this->data['classifications'] = $this->request->retrieve_all_classification();
        $this->data['all_employees'] = $this->request->retrieve_all_employee();
        $this->data['all_uom'] = $this->request->retrieve_all_uom();
        $this->data['all_project'] = $this->request->retrieve_all_project(); 
        $this->data['all_warehouse'] = $this->request->retrieve_all_warehouse();
        $this->data['all_warehouse1'] = $this->request->retrieve_all_warehouse();
        $this->data['all_budgeted'] = $this->request->retrieve_all_budgeted($this->session->userdata('department_id'));
        $this->data['all_justifications'] = $this->request->retrieve_all_justification();
        $this->data['all_justification_repair'] = $this->request->retrieve_all_justification_repairs();  
        $this->data['custodian'] = $this->request->retrieve_custodian($this->session->userdata('department_id'));  
        $this->load->view('default/index', $this->data);        
    }



    public function save_items()
    {
        $this->load->helper('date'); 
        $this->load->model('Request_model');
        $data = array(        
                'requested_by_id' =>$this->input->post('requested_by_id'),
                'department_id' =>$this->input->post('department_id'),
                'project_id' =>$this->input->post('project_id'),
                'lot_id' =>$this->input->post('lot_id'),
                'date_requested' =>date('Y-m-d'),
                'date_needed' =>$this->input->post('birthdate'),
                'deliverTo' =>$this->input->post('deliverTo'),                
                'request_type' =>$this->input->post('request_type'),                
                'remarks' =>$this->input->post('prf_remarks'),
                // 'prf_status_id' =>$this->input->post('prf_status_id'),
                'purpose' =>$this->input->post('purpose_prf'),
                'total_amount' =>$this->input->post('total_amount'),
                'justification' =>$this->input->post('justification')
            );
        $id = $this->Request_model->insert_request($data);

        foreach ($this->input->post('sub_total') as $i => $value)
        {
            $items = array(
                'prf_id' => $id,
                'item_id' => $this->input->post('item')[$i],
                'amount' => $this->input->post('cust_cont_value')[$i],
                'qty' => $this->input->post('qty')[$i],
                'prf_uom_id' => $this->input->post('uom')[$i], 
                'budgeted' => $this->input->post('budgeted')[$i],
                'remarks' => $this->input->post('item_remarks')[$i],
                'budget_id' => $this->input->post('budget_id')[$i],             
                'sub_total' => $this->input->post('sub_total')[$i]
                // 'custodian' => $this->input->post('custodian')[$i],             
                // 'asset_item' => $this->input->post('asset_item')[$i]
                                     
            );
       $this->request->insert_prf_details($items);         
   }
        // if ($this->input->post('capex_description') != null) {
        //    foreach ($this->input->post('remarks') as $i => $value)
        //         {
        //             $capexs = array(
        //                 'prf_id' =>  $id,
        //                 'capex_date' => date('Y-m-d'),
        //                 'department_id' => $this->input->post('department_id')[$i],
        //                 // 'capex_description' => $this->input->post('capex_description')[$i],
        //                 'purpose' => $this->input->post('purpose')[$i], 
        //                 'is_budgeted' => $this->input->post('classification_name')[$i],
        //                 'capex_type' => $this->input->post('capex_type')[$i],    
        //                 'capex_justification_id' => $this->input->post('capex_justification_id')[$i],
        //                 'equipment_cost' => $this->input->post('equipment_cost')[$i],
        //                 'labor_cost' => $this->input->post('labor_cost')[$i],
        //                 'freight_cost' =>$this->input->post('freight_cost')[$i],
        //                 'incidental_expenses' =>$this->input->post('incidental_expenses')[$i],
        //                 'estimated_cost' =>$this->input->post('estimated_cost')[$i],
        //                 'less_trade_in' =>$this->input->post('less_trade_in')[$i],
        //                 'net_estimated_cost' =>$this->input->post('net_estimated_cost')[$i],
        //                 'remarks' => $this->input->post('remarks')[$i]
        //             );
        //             $lastCapex = $this->request->insert_capex($capexs);   
        //         }

        //         if ($this->input->post('new_location') != null) {
        //            foreach ($this->input->post('new_replacement') as $i => $value)
        //             {
        //                 $replacements = array(
                            
        //                     'capex_id' => $lastCapex,
        //                     'item_id' => $this->input->post('new_replacement')[$i],            
        //                     'custodian_id' => $this->input->post('requested_by_id')[$i],
        //                     'location' => $this->input->post('new_location')[$i],                 
        //                     'estimate_useful_life' => $this->input->post('new_estimate_useful_life')[$i],
        //                     'capacity_of_unit' => $this->input->post('new_capacity_of_unit')[$i],
        //                     'limitations_of_unit' => $this->input->post('new_limitations_of_unit')[$i],
        //                     'advantage_over_repair' => $this->input->post('new_advantage_over_repair')[$i]
        //                 );
        //                 $this->request->insert_acquisition($replacements); 
        //             } 
        //         }

        //         if ($this->input->post('repair_location')!= null) {
        //             foreach ($this->input->post('repair_replacement') as $i => $value)
        //             {
        //                 $repairs = array(
                            
        //                     'capex_id' => $lastCapex,
        //                     'item_id' => $this->input->post('repair_replacement')[$i],            
        //                     'custodian_id' => $this->input->post('requested_by_id')[$i],
        //                     'location' => $this->input->post('repair_location')[$i],                 
        //                     'date_acquired' => $this->input->post('date_acquired')[$i],
        //                     'net_book_value' => $this->input->post('repair_net_book_value')[$i],
        //                     'reason_for_replacement' => $this->input->post('repair_reason_for_replacement')[$i],
        //                     'advantage_over_new' => $this->input->post('repair_advantage_over_new')[$i]
        //                 );
        //                 $this->request->insert_replacement($repairs); 
        //             }
        //         }
        // }
   if ($this->input->post('equipment_cost') != null) {
        
                    $capexs = array(
                        'prf_id' =>  $id,
                        'capex_date' => date('Y-m-d'),
                        'department_id' => $this->input->post('department_id'),
                        // 'capex_description' => $this->input->post('item'),
                        // 'purpose' => $this->input->post('purpose_prf'), 
                        // 'is_budgeted' => $this->input->post('budgeted'),
                        'capex_type' => $this->input->post('capex_type'),    
                        'capex_justification_id' => $this->input->post('capex_justification_id'),
                        'equipment_cost' => $this->input->post('equipment_cost'),
                        'labor_cost' => $this->input->post('labor_cost'),
                        'freight_cost' =>$this->input->post('freight_cost'),
                        'incidental_expenses' =>$this->input->post('incidental_expenses'),
                        'estimated_cost' =>$this->input->post('estimated_cost'),
                        'less_trade_in' =>$this->input->post('less_trade_in'),
                        'net_estimated_cost' =>$this->input->post('net_estimated_cost')
                        // 'remarks' => $this->input->post('remarks')
                    );
                    $lastCapex = $this->request->insert_capex($capexs);   
              
                if ($this->input->post('new_location') != null) {
                   
                        $replacements = array(                            
                            'capex_id' => $lastCapex,
                            // 'item_id' => $this->input->post('new_replacement'),            
                            'custodian_id' => $this->input->post('requested_by_id'),
                            'location' => $this->input->post('new_location'),                 
                            'estimate_useful_life' => $this->input->post('new_estimate_useful_life'),
                            'capacity_of_unit' => $this->input->post('new_capacity_of_unit'),
                            'limitations_of_unit' => $this->input->post('new_limitations_of_unit'),
                            'advantage_over_repair' => $this->input->post('new_advantage_over_repair')
                        );
                        $this->request->insert_acquisition($replacements); 
                    
                }

                if ($this->input->post('repair_location')!= null) {                   
                        $repairs = array(                            
                            'capex_id' => $lastCapex,
                            // 'item_id' => $this->input->post('repair_replacement'),            
                            'custodian_id' => $this->input->post('requested_by_id'),
                            'location' => $this->input->post('repair_location'),                 
                            'date_acquired' => $this->input->post('date_acquired'),
                            'net_book_value' => $this->input->post('repair_net_book_value'),
                            'reason_for_replacement' => $this->input->post('repair_reason_for_replacement'),
                            'advantage_over_new' => $this->input->post('repair_advantage_over_new')
                        );
                        $this->request->insert_replacement($repairs);                    
                }
        }
        if ($this->input->post('asset_item') != null) {

                $maintenance = array(
                'prf_id' =>  $id,        
                'custodian' =>$this->input->post('custodian'),
                'asset_item' =>$this->input->post('asset_item')
               
            );
        $this->Request_model->insert_reppair_maintenance($maintenance);
        }
            
    }
   
     
    public function list_uom(){
        echo json_encode($this->request->item_by_uom($this->input->post('item_id')));
    }

     public function budget_list(){
        echo json_encode($this->request->budget_by_department($this->input->post('item_id'),$this->input->post('department_id')));
    }
public function retrieve_asset(){
        echo json_encode($this->request->person_asset($this->input->post('employee_id')));
    }
public function retrieve_lots(){
        echo json_encode($this->request->project_lots($this->input->post('project_id')));
    }

}    


            