<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model
{

    function getEmployeesNotSelected()
    {
        $query = $this->db->query("SELECT e.employee_id, p.lastname, p.firstname FROM employee AS e LEFT JOIN person AS p ON e.person_id = p.person_id LEFT JOIN employee_department AS ed ON e.employee_id = ed.employee_id LEFT JOIN department_manager AS dm ON e.employee_id = dm.employee_id WHERE ed.employee_id IS NULL AND dm.employee_id IS NULL");
        /*$this->db->trans_start();
        $this->db->select("employee.employee_id");
        $this->db->select("person.lastname,person.firstname")->from("person");
        $this->db->join("employee", "employee.person_id = person.person_id", "left");
        $this->db->join("employee_department", "employee_department.employee_id = employee.employee_id", "left");
        $this->db->join("department_manager", "department_manager.employee_id = employee.employee_id", "LEFT");
        $this->db->where('employee_department.employee_id IS NULL AND department_manager.employee_id IS NULL');
        // $this->db->order_by('person.lastname');
        $query = $this->db->get();
        $this->db->trans_complete();*/
        return $query->result_array();
    }

    function getEmployees()
    {
        $this->db->trans_start();
        $this->db->select("employee.employee_id");
        $this->db->select("person.lastname,person.firstname")->from("person");
        $this->db->join("employee", "employee.person_id = person.person_id");
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->result_array();
    }

    /*function getEmployeesLiteral()
    {
        $this->db->trans_start();
        $this->db->select("employee_id,person_id");
        $this->db->from("employee");
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->result_array();
    }*/

    function getDepartment()
    {
        $this->db->trans_start();
        $this->db->select("department_id,department_name");
        $this->db->from("department");
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->result_array();
    }

    function getAllEmployeeDepartment()
    {
        $query = $this->db->query("SELECT ed.employee_department_id, ed.datetime, p.lastname, p.firstname, d.department_name, ed.contract_start, ed.contract_expiry, ed.employee_id, ed.department_id FROM employee_department AS ed INNER JOIN employee ON ed.employee_id = employee.employee_id INNER JOIN person AS p ON employee.person_id = p.person_id INNER JOIN department AS d ON ed.department_id = d.department_id");
        $this->db->order_by("ed.datetime", "desc");
        return $query->result_array();
    }

    function getAllEmployeeInDepartment($dept_id)
    {
        $query = $this->db->query("SELECT ed.employee_department_id, ed.datetime, p.lastname, p.firstname, d.department_name, ed.contract_start, ed.contract_expiry, ed.employee_id, ed.department_id FROM employee_department AS ed INNER JOIN employee ON ed.employee_id = employee.employee_id INNER JOIN person AS p ON employee.person_id = p.person_id INNER JOIN department AS d ON ed.department_id = d.department_id WHERE ed.department_id =". $dept_id);
        $this->db->order_by("ed.datetime", "desc");
        return $query->result_array();
    }

    function departmentName($dept_id)
    {
        $query = $this->db->query("SELECT department_name FROM department WHERE department_id =". $dept_id);
        return $query->result_array();
    }

    function departmentHead($dept_id)
    {
        $query = $this->db->query("SELECT p.lastname,p.firstname FROM person as p INNER JOIN employee as e ON p.person_id = e.person_id INNER JOIN department_manager as dm ON e.employee_id = dm.employee_id INNER JOIN department as d ON d.department_id = dm.department_id WHERE dm.department_id =". $dept_id);
        return $query->result_array();
    }

    function getEmployeeDepartment()
    {
        $this->db->trans_start();
        $this->db->select("employee_department_id,employee_id,department_id,contract_start,contract_expiry");
        $this->db->from("employee_department");
        $this->db->order_by("datetime", "DESC");
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->result_array();
    }

    /*function get_edit_all_employee_department()
    {
        $this->db->trans_start();
        $this->db->select("employee.employee_id");
        $this->db->select("person.lastname,person.firstname")->from("person");
        $this->db->join("employee", "employee.person_id = person.person_id");
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->result_array();
    }*/

    function getSupplier(){
        $query = $this->db->query("select supplier.supplier_id, concat(person.lastname,', ', person.firstname,' ', person.middlename) as supplier_name, client_type.client_type_name as supplier_type, status.status_name from supplier 
            inner join person on supplier.client_type_id= '1' and supplier.reference_id = person.person_id
            inner join client_type on supplier.client_type_id = client_type.client_type_id 
            inner join status on status.status_id = supplier.status_id
            UNION
            select supplier.supplier_id, organization.organization_name as supplier_name, client_type.client_type_name as supplier_type, status.status_name from supplier 
            inner join organization on supplier.client_type_id = '2' and supplier.reference_id = organization.organization_id
            inner join client_type on supplier.client_type_id = client_type.client_type_id
            inner join status on status.status_id = supplier.status_id
            order by supplier_id");
        return $query->result_array();
    }

    function retrieveAllItems()
    {
        $DB2 = $this->load->database('legacy', TRUE);
        $DB2->select('ItemId, ItemDescription');
        $DB2->from('item_inventorymaster');
        $DB2->order_by('ItemDescription', "ASC");
        $query = $DB2->get();
        return $query->result_array();
    }

    function retrieveAllCategories()
    {
        $this->db->select('category_code, description');
        $this->db->from('category');
        $query = $this->db->get();
        return $query->result_array();
    }

     function insert_quotation($data)
    {
        $this->db->trans_start();
        $this->db->insert('quotation', $data);
        $lastRequest = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastRequest;
    }

    function insert_quotation_details($items)
    {
        $this->db->trans_start();
        $this->db->insert('quotation_detail',$items);
        $lastItems = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastItems;
    }

    function insert_employee_department($emp_dept_specs)
    {
        $this->db->trans_start();
        $this->db->insert('employee_department', $emp_dept_specs);
        $item = $this->db->insert_id();
        $this->db->trans_complete();
        return $item;
    }

    function select_items_category($cat_code)
    {
        $this->db->trans_start();
        $this->db->select("description");
        $this->db->from("category");
        $this->db->where("category_code", $cat_code[0]['CategoryCode']);
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->result_array();
    }

    function edit_employee_department($employee_department)
    {
        $this->db->where('employee_department_id',$employee_department['employee_department_id']); 
        $this->db->update('employee_department',$employee_department); 
        return $this->db->affected_rows();
    }

    function delete_employee_department_record($employee_department_id)
    {
        $this->db->trans_start();
        $this->db->where("employee_department_id", $employee_department_id);
        $this->db->delete("employee_department");
        $this->db->trans_complete();
        return $this->db->affected_rows();
    }

    function getItemSpecs()
    {
        $this->db->trans_start();
        $query = $this->db->query("select * from specs");
        $this->db->trans_complete();
        return $query->result_array();
    }

    function getItemName()
    {
        $this->db->select('legacy.item_inventorymaster.ItemId,legacy.item_inventorymaster.ItemDescription');
        $this->db->select('irmdb.specs.item_id')->from('irmdb.specs');
        $this->db->join('legacy.item_inventorymaster', 'legacy.item_inventorymaster.ItemId = irmdb.specs.item_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCategoryDescription()
    {
        $this->db->select('category.category_code,category.description');
        $this->db->select('specs.category')->from('specs');
        $this->db->join('category', 'category.category_code = specs.category');
        $query = $this->db->get();
        return $query->result_array();
    }

}