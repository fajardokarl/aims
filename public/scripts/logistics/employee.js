var dept_id = $('input#dept_id').val();

var Users = function () {
    App.setAssetsPath(baseurl+'assets/');

    var dtuser = $('#tbluserlists').DataTable({
        "bSort" : true,
        "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
        "iDisplayLength": 10,
        "fixedHeader": true,
        fixedHeader: {
            header: true,
        }
    });

    var tbl_employee_department = $('#tbl_employee_department').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });

    var handleInputValidation = function () {

        var form1 = $('#form_edit_user');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                username: {
                    minlength: 3,
                    maxlength: 10,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                var cont = $(element).parent('.input-group');
                if (cont.size() > 0) {
                    cont.after(error);
                } else {
                    element.after(error);
                }
            },
            /*highlight: function (element) { // hightlight error inputs

                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },*/

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                success1.show();
                error1.hide();
            }
        });
    }

    var handleEditSubmitManager = function () {

        var $tbody = $("#tbl_employee_department tbody").on('click', 'tr',  function() {
            // App.blockUI({target:'#tbl_employee_department', boxed:true});
            // highlight($(this));
        });

        /*function highlight($row) {
            if ($row.length) {
                $tbody.children().removeClass("active");
                $row.addClass('active');
                //$("#rownum").val($row[0].rowIndex);
                //console.log($row[0]);
            }
        }*/

    }

    var handleEmployeeModal = function () {
        tbl_employee_department.clear().draw();
    }

    var handleEmployeeSelect = function () {

        var $tbody = $("#tbl_employee_department tbody").on('click', 'tr',  function() {
            // App.blockUI({target:'#tbl_employee_department', boxed:true});
            // highlight($(this));
        });

        /*function highlight($row) {
            if ($row.length) {
                $tbody.children().removeClass("active");
                $row.addClass('active');
                //$("#rownum").val($row[0].rowIndex);
                //console.log($row[0]);
            }
        }*/

        tbl_employee_department.clear().draw();
        // App.blockUI({target:'#tbl_employee_department', boxed:true});
        $.ajax({
            type: "POST",
            url : baseurl + "employee/get_all_employee_in_department",
            dataType : "json",
            data: {},
            success : function(data){
                $.each(data, function(i, value){
                    tbl_employee_department.row.add([
                        data[i].datetime,
                        data[i].lastname +', '+ data[i].firstname,
                        data[i].department_name,
                        data[i].contract_start,
                        data[i].contract_expiry,
                        "<button type='button' class='edit_emp_dept btn green meadow btn-xs' " +
                        "data-toggle='modal' data-url='http://localhost/abci/employee/employee/get_employee_department' " +
                        "data-target='#edit_emp_dept' data-empdept='" + data[i].employee_department_id + "' " +
                        "data-emp='" + data[i].employee_id + "' " +
                        "data-dept='" + data[i].department_id + "'> " +
                        "EDIT</button><button type='button' class='delete_spec btn btn-xs red-mint' data-toggle='modal' " +
                        "data-target='#delete_emp_dept' value='" + data[i].employee_department_id + "'> " +
                        "DELETE</button>"
                    ]).draw(false);
                });
                $(".sorting_asc").trigger("click");
            },  
            error: function(errorThrown){
                console.log("WALA");
                console.log(errorThrown);
            }
        });
        tbl_employee_department.fixedHeader(false);
        // App.unblockUI('#tbl_employee_department');

    }

    return {
        //main function to initiate the module
        init: function () {
            handleEditSubmitManager();
            handleEmployeeModal();
            handleEmployeeSelect();
        }
    };

}();

jQuery(document).ready( function($) {
    App.setAssetsPath( baseurl + 'assets/' );

    Users.init();

    $( "#emp_dept_form" ).on( "submit", function(e) {
        e.preventDefault();

        // console.log("ID: " + $("#item_id").val());
        // console.log("BRAND: " + $("#item_brand").val());
        // console.log("COLOR: " + $("#item_color").val());
        // console.log("SIZE: " + $("#item_size").val());
        // console.log("QUANTITY: " + $("#item_quantity").val());

        var emp_dept_specs = { employee_department_id: '', employee_id: $("#employee_id").val(), department_id: $("#department_id").val(), 
        contract_start: $("#contract_start").val(), contract_expiry: $("#contract_expiry").val() };

        // console.log(emp_dept_specs);

        console.log($("#employee_id").val());
        console.log($("#department_id").val());
        console.log($("#contract_start").val());

        if( ($("#employee_id").val() != 0) && ($("#department_id").val() != 0) && ($("#contract_start").val() != null) ) {
            $this = $(this);
            var url = $this.attr("action");
            $.ajax({
                type: "POST",
                url: url,
                data: { emp_dept_specs: emp_dept_specs },
                success : function(){
                    location.reload();
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
        } else {
            if ($("#employee_id").val() == 0)
                toastr.error('Please select an employee.', 'Error');
            if ($("#department_id").val() == 0)
                toastr.error('Please select a department.', 'Error');
            if ($("#contract_start").val() == 0)
                toastr.error('Please select the date of contract start.', 'Error');
        }
    });

    $( document ).on( "click", "button.edit_emp_dept", function() {
        console.log($(this).data("empdept"));
        empdept_id = $(this).data("empdept");
        $.ajax({
            type: "POST",
            url : $(".edit_emp_dept").data("url"),
            dataType : "json",
            data: { empdept_id: empdept_id },
            success : function(data){
                $("#edit_employee_department_id").val(empdept_id);
                $("#edit_employee_id").val(data[0]['employee_id']);
                $("#edit_department_id").val(data[0]['department_id']);
                $("#edit_contract_start").val(data[0]['contract_start']);
                $("#edit_contract_expiry").val(data[0]['contract_expiry']);
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });

    $( document ).on( "click", "#confirm_edit", function(e) {
        e.preventDefault();
        if($("#edit_contract_start").val() != "") {
            var edit_employee_department = { employee_department_id: $("#edit_employee_department_id").val(), employee_id: $("#edit_employee_id").val(), department_id: $("#edit_department_id").val(),
            contract_start: $("#edit_contract_start").val(), contract_expiry: $("#edit_contract_expiry").val() };
            $.ajax({
                type: "POST",
                url: $("#form_edit_emp_dept").attr("action"),
                data: { employee_department: edit_employee_department },
                success : function(){
                    location.reload();
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
        }
        else {
            toastr.error('Please select the date of contract start.', 'Error');
        }

    });

    $( document ).on( "click", "button.delete_spec", function() {
    	console.log($(this).val());
        $("#employee_department_id").val($(this).val());
    });

    $( document ).on( "click", "#confirm_delete", function(e) {
        e.preventDefault();
        employee_department_id = $("#employee_department_id").val();
        console.log(employee_department_id);
        $.ajax({
            type: "POST",
            url : $("#form_delete_spec").attr("action"),
            data: { employee_department_id: employee_department_id },
            dataType : "json",
            success : function(data){
                location.reload();
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
});