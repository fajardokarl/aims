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
                        toastr.error('Data not saved');
                    }
                }
            });
        });
    }

    var handleEmployeeModal = function () {
        tbl_employee_modal.clear().draw();
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
            tbl_employee_modal.clear().draw();
            App.blockUI({target:'#tbl_employee_modal', boxed:true});
            $.ajax({
                type: "POST",
                url : baseurl + "users/ajax_get_employees",
                dataType : "json",
                data: {},
                success : function(data){
                    $.each(data, function(i, value){
                        //console.log(data[i]);
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

        $('#btn_choose_employee').click(function(){
            var row = $tbody.find('.active');
            var id = tbl_employee_modal.cell(row,0).data();
            $('#employee_id').val(tbl_employee_modal.cell(row,0).data());
            $('#inputName').val(tbl_employee_modal.cell(row,1).data());
            $('#inputDepartment').val(tbl_employee_modal.cell(row,2).data());

         });

    }

    return {
        //main function to initiate the module
        init: function () {
            handleInputValidation();
            handleEditSubmit();
            handleEmployeeModal();
            handleEmployeeSelect();
        }
    };

}();

jQuery(document).ready(function() {
    Users.init();
});