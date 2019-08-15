var Employee = function () {
    App.setAssetsPath(baseurl+'assets/');

    var dtemployee = $('#tblemployeelists').DataTable();

    var handleDepartmentSelect = function () {

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

    }

    return {
        //main function to initiate the module
        init: function () {

            handleDepartmentSelect();
        }
    };

}();

jQuery(document).ready(function() {
    Employee.init();
});