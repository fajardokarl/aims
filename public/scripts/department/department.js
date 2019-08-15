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
    
    var tbl_department_modal = $('#tbl_department_modal').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });

    var tbl_employee_modal = $('#tbl_employee_modal').DataTable({
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
            highlight: function (element) { // hightlight error inputs

                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

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

    var handleEditSubmit = function () {

        $('#inputVerifiedCheckbox').on('change', function(){
            $(this).attr('value', this.checked ? 1 : 0);
            $('#inputVerified').attr('value',$(this).val());
         });

        $( "#form_edit_user" ).submit(function( event ) {
            event.preventDefault();
            $this = $(this);
            var url = $this.attr("action");
            $.ajax({
                type: "POST",
                url: url,
                data: $("#form_edit_user").serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if (data > 0)
                    {
                        toastr.success('Data updated');
                    } else {
                        toastr.success('Data updated');
                    }
                },
                error:function(errorThrown){
                    console.log(errorThrown);
                }

            });
        });
    }

    var handleEditSubmitManager = function () {

        var $tbody = $("#tbl_employee_modal tbody").on('click', 'tr',  function() {
            //App.blockUI({target:'#tbl_employee_modal', boxed:true});
            highlight($(this));
        });

        function highlight($row) {
            if ($row.length) {
                $tbody.children().removeClass("active");
                $row.addClass('active');
                //$("#rownum").val($row[0].rowIndex);
                //console.log($row[0]);
            }
        }

        $('#inputVerifiedCheckbox').on('change', function(){
            $(this).attr('value', this.checked ? 1 : 0);
            $('#inputVerified').attr('value',$(this).val());
         });

        $( "#form_edit_user_manager" ).click(function( event ) {            
            var row = $tbody.find('.active');
            var id = tbl_employee_modal.cell(row,0).data();
            $('#manager_employee_id').val(tbl_employee_modal.cell(row,0).data());
            $('#employee_name').val(tbl_employee_modal.cell(row,1).data());
            $('#department_employee_id').val(tbl_employee_modal.cell(row,3).data());
            console.log($('#manager_employee_id').val());
            console.log($('#employee_name').val());
            console.log($('#department_id').val());
            if($('#manager_employee_id').val() == 0 || $('#manager_employee_id').val() == null) {
                event.preventDefault();
                $('#tbl_employee_modal').modal('hide');
            } else {
                
                event.preventDefault();
                $this = $(this);
                var url = $this.attr("action");
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#form_edit_user_manager").serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        location.reload();
                    },
                    error:function(errorThrown){
                        console.log(errorThrown);
                    }

                });
                // location.reload();
            }
        });
    }

    var handleDepartmentModal = function () {
        tbl_department_modal.clear().draw();
    }

    var handleEmployeeModal = function () {
        tbl_employee_modal.clear().draw();
    }

    var handleDepartmentSelect = function () {

        var $tbody = $("#tbl_department_modal tbody").on('click', 'tr',  function() {
            //App.blockUI({target:'#tbl_employee_modal', boxed:true});
            highlight($(this));
        });

        function highlight($row) {
            if ($row.length) {
                $tbody.children().removeClass("active");
                $row.addClass('active');
                //$("#rownum").val($row[0].rowIndex);
                //console.log($row[0]);
            }
        }

        $('#btnSelectDepartment,#inputName').click(function(){
            tbl_department_modal.clear().draw();
            App.blockUI({target:'#tbl_department_modal', boxed:true});
            $.ajax({
                type: "POST",
                url : baseurl + "department/ajax_get_departments",
                dataType : "json",
                data: {},
                success : function(data){
                    $.each(data, function(i, value){
                        //console.log(data[i]);
                        tbl_department_modal.row.add([
                            data[i].department_id,
                            data[i].department_code,
                            data[i].department_name,
                            data[i].activity_code,
                            data[i].route_id,
                            data[i].status_id
                            ]).draw(false);
                    });
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
            tbl_department_modal.fixedHeader(false);
            App.unblockUI('#tbl_department_modal');
        });

        $('#btn_choose_department').click(function(){
            var row = $tbody.find('.active');
            var id = $('#department_id').val(tbl_department_modal.cell(row,0).data());
            console.log(tbl_department_modal.cell(row,0).data());
            console.log(tbl_department_modal.cell(row,1).data());
            console.log(tbl_department_modal.cell(row,2).data());
            console.log(tbl_department_modal.cell(row,3).data());
            console.log(tbl_department_modal.cell(row,4).data());
            console.log(tbl_department_modal.cell(row,5).data());
            $('#inputDepartmentId').val(tbl_department_modal.cell(row,0).data());
            $('#inputName').val(tbl_department_modal.cell(row,1).data());
            $('#inputDepartment').val(tbl_department_modal.cell(row,2).data());
            $('#inputActivityCode').val(tbl_department_modal.cell(row,3).data());
            $('#inputRoute').val(tbl_department_modal.cell(row,4).data());
            $('#inputDepartmentStatus').val(tbl_department_modal.cell(row,5).data());

         });

    }

    var handleEmployeeSelect = function () {

        var $tbody = $("#tbl_employee_modal tbody").on('click', 'tr',  function() {
            //App.blockUI({target:'#tbl_employee_modal', boxed:true});
            highlight($(this));
        });

        function highlight($row) {
            if ($row.length) {
                $tbody.children().removeClass("active");
                $row.addClass('active');
                //$("#rownum").val($row[0].rowIndex);
                //console.log($row[0]);
            }
        }

        $('#btnSelectEmployee,#inputName').click(function(){
            $('#department_id').val($(this).val());
            $('#department_employee_id').val($(this).val());
            tbl_employee_modal.clear().draw();
            App.blockUI({target:'#tbl_employee_modal', boxed:true});
            $.ajax({
                type: "POST",
                url : baseurl + "users/ajax_get_employees",
                dataType : "json",
                data: {},
                success : function(data){
                    $.each(data, function(i, value){
                        tbl_employee_modal.row.add([
                            data[i].employee_id,
                            data[i].lastname +', '+ data[i].firstname,
                            data[i].department_name,
                            data[i].status_id
                        ]).draw(false);
                    });
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
            tbl_employee_modal.fixedHeader(false);
            App.unblockUI('#tbl_employee_modal');
        });

        /*$('#btn_choose_employee').click(function(){
            var row = $tbody.find('.active');
            var id = tbl_employee_modal.cell(row,0).data();
            $('#manager_employee_id').val(tbl_employee_modal.cell(row,0).data());
            $('#employee_name').val(tbl_employee_modal.cell(row,1).data());
            $('#department_id').val(tbl_employee_modal.cell(row,2).data());
            console.log($('#manager_employee_id').val());
            console.log($('#employee_name').val());
            console.log($('#department_id').val());
         });*/

    }

    return {
        //main function to initiate the module
        init: function () {
            handleInputValidation();
            handleEditSubmit();
            handleEditSubmitManager();
            handleDepartmentModal();
            handleEmployeeModal();
            handleDepartmentSelect();
            handleEmployeeSelect();
        }
    };

}();

var Employee = function () {
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

    var tbl_assign_employee_department = $('#tbl_assign_employee_department').DataTable({
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

        var $tbody = $("#tbl_assign_employee_department tbody").on('click', 'tr',  function() {
            // App.blockUI({target:'#tbl_assign_employee_department', boxed:true});
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
        tbl_assign_employee_department.clear().draw();
    }

    var handleEmployeeSelect = function () {

        var $tbody = $("#tbl_assign_employee_department tbody").on('click', 'tr',  function() {
            // App.blockUI({target:'#tbl_assign_employee_department', boxed:true});
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

        tbl_assign_employee_department.clear().draw();
        // App.blockUI({target:'#tbl_assign_employee_department', boxed:true});
        /*$("table.assign_employee tbody tr").on("click", function() {
            dept_id = $(this).data('deptid');
            $(".portlet-body > table:first-child").html('');
            $("#tbl_assign_employee_department_wrapper").css('display', 'block');
            $("#tbl_assign_employee_department").css('display', 'block');
            $.ajax({
                type: "POST",
                url : baseurl + "department/assign_employee_controller/get_department_name",
                dataType : "json",
                data: {dept_id: dept_id},
                success : function(data){
                    console.log(dept_id);
                    console.log(data);
                    $("span.caption-subject.bold.uppercase").html("DEPARTMENT: " + data[0]['department_name']);
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
            $.ajax({
                type: "POST",
                url : baseurl + "department/assign_employee_controller/get_department_head",
                dataType : "json",
                data: {dept_id: dept_id},
                success : function(data){
                    console.log(data);
                    if(data != "") {
                        $(".portlet-body h4").html("Department Head: " + data[0]['lastname'] + ", " + data[0]['firstname'] + "\n");
                    } else {
                        $(".portlet-body h4").html("Department Head: \n");
                    }
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
            $.ajax({
                type: "POST",
                url : baseurl + "department/assign_employee_controller/get_all_employee_in_department",
                dataType : "json",
                data: {dept_id: dept_id},
                success : function(data){
                    console.log(dept_id);
                    console.log(data);
                    $.each(data, function(i, value){
                        tbl_assign_employee_department.row.add([
                            data[i].lastname +', '+ data[i].firstname
                        ]).draw(false);
                    });
                    $(".sorting_asc").trigger("click");
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
            // tbl_assign_employee_department.fixedHeader(false);
        });*/
        // App.unblockUI('#tbl_assign_employee_department');
        $("table.assign_employee tbody tr").on("click", function() {
            var dept_id = $(this).data('deptid');
            console.log(dept_id);
            $.ajax({
                type: "POST",
                url : baseurl + "Department/assign_employee_controller/pass_department_id",
                dataType : "json",
                data: {dept_id: dept_id}
            });
            window.location = $(this).data("url");
        });

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

jQuery(document).ready(function() {
    Users.init();
    Employee.init();
});