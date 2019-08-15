var Users = function () {

    var dtlog = $('#tbluserlogs').DataTable({
        "bSort" : true,
        "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
        "iDisplayLength": 10,
        "fixedHeader": true,
        fixedHeader: {
            header: true,
        }
    });

    return {
        //main function to initiate the module
        init: function () {
            //handleInputValidation();
            //handleEditSubmit();
        }
    };

}();

jQuery(document).ready(function() {
    Users.init();
});