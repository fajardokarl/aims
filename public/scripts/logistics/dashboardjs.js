var dashboardjs = function () {

    var pdf_po_table = $('#pdf_po_table').DataTable({searching: false, "order": [[ 1, "desc" ]],"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], });
    var prePRFlist = $('#prePRFlist').DataTable({searching: false,"order": [[ 1, "desc" ]],"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]] });

    var dtemployee = $('#tblemployee').DataTable({
        "bSort" : true,
        "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
        "iDisplayLength": 10,
        "fixedHeader": true,
        fixedHeader: {
            header: true,
        }
    });

    var handleUsers = function () {

        $("#txtusername").on('click',function(e){
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: baseurl+"api/employee/employees",
                dataType: 'json',
                data: {'status_id':1},
                success: function(data)
                {
                    toastr.info('Records fetched', 'Operation done');
                    for (var i = 0; i < data.length; i++) {
                        dtemployee.row.add( [
                            data[i].employee_id,
                            data[i].employee_id,
                            data[i].employee_id,
                            data[i].employee_id
                        ] ).draw( false );
                    }
                    console.log(data);
                },
                error: function (errorThrown)
                {
                    //toastr.error('Failed to saved!.', 'Operation done');
                    console.log( errorThrown );
                }
            });
        });

    }
    return {
        //main function to initiate the module
        init: function () {

            handleUsers();
        }
    };

}();

