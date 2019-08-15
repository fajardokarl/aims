$(document).ready(function(){

    $('#print1').click(function () {
        var projectname = $('#title').text();
        var year = $('#year_text').text();

        var TableData1 = [];
        var rows = $("#tblcollectionprojection").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData1[i] = {
                "lotid" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "lotdescription" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "tcp" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "customer" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "invoiced" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "booked" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "deffered" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "vattable" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
                , "percent" : $(rows[i]).find('td:eq(8)').text().replace(/,/g, '')
                , "jan" : $(rows[i]).find('td:eq(9)').text().replace(/,/g, '')
                , "feb" : $(rows[i]).find('td:eq(10)').text().replace(/,/g, '')
                , "mar" : $(rows[i]).find('td:eq(11)').text().replace(/,/g, '')
                , "apr" : $(rows[i]).find('td:eq(12)').text().replace(/,/g, '')
                , "may" : $(rows[i]).find('td:eq(13)').text().replace(/,/g, '')
                , "jun" : $(rows[i]).find('td:eq(14)').text().replace(/,/g, '')
                , "jul" : $(rows[i]).find('td:eq(15)').text().replace(/,/g, '')
                , "aug" : $(rows[i]).find('td:eq(16)').text().replace(/,/g, '')
                , "sep" : $(rows[i]).find('td:eq(17)').text().replace(/,/g, '')
                , "oct" : $(rows[i]).find('td:eq(18)').text().replace(/,/g, '')
                , "nov" : $(rows[i]).find('td:eq(19)').text().replace(/,/g, '')
                , "dec" : $(rows[i]).find('td:eq(20)').text().replace(/,/g, '')
            }
        }

        var data = JSON.stringify(TableData1);

        console.log(TableData1);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_collection_projection",
            data: {'data':data,'project':projectname,'year':year},
            success: function(data){
                var url = baseurl + "reports/CollectionProjection.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });

    $('#excel1').click(function () {
        var projectname = $('#title').text();
        var year = $('#year_text').text();

        var TableData1 = [];
        var rows = $("#tblcollectionprojection").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData1[i] = {
                "lotid" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "lotdescription" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "tcp" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "customer" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "invoiced" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "booked" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "deffered" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "vattable" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
                , "percent" : $(rows[i]).find('td:eq(8)').text().replace(/,/g, '')
                , "jan" : $(rows[i]).find('td:eq(9)').text().replace(/,/g, '')
                , "feb" : $(rows[i]).find('td:eq(10)').text().replace(/,/g, '')
                , "mar" : $(rows[i]).find('td:eq(11)').text().replace(/,/g, '')
                , "apr" : $(rows[i]).find('td:eq(12)').text().replace(/,/g, '')
                , "may" : $(rows[i]).find('td:eq(13)').text().replace(/,/g, '')
                , "jun" : $(rows[i]).find('td:eq(14)').text().replace(/,/g, '')
                , "jul" : $(rows[i]).find('td:eq(15)').text().replace(/,/g, '')
                , "aug" : $(rows[i]).find('td:eq(16)').text().replace(/,/g, '')
                , "sep" : $(rows[i]).find('td:eq(17)').text().replace(/,/g, '')
                , "oct" : $(rows[i]).find('td:eq(18)').text().replace(/,/g, '')
                , "nov" : $(rows[i]).find('td:eq(19)').text().replace(/,/g, '')
                , "dec" : $(rows[i]).find('td:eq(20)').text().replace(/,/g, '')
            }
        }

        var data = JSON.stringify(TableData1);

        console.log(TableData1);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_collection_projection_report",
            data: {'data':data,'project':projectname,'year':year},
            success: function(data){
                $("#excel1trigger").trigger("click").attr("target", "_blank");
            },
            error: function(data){

            },
        });
    });

    $('#generate').click(function () {

        var projectid = $('#project').val();
        var projectname = $('#project option:selected').text();
        var year = $('#year').val();
        var content = '';
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_collection_projection2",
            data: {'projectid':projectid,'year':year},
            success: function(result){

            //var table = document.getElementById("tblcollectionprojection");
            var data = jQuery.parseJSON(result);
            console.log('wiw');
            console.log(data);

            var temp_lot_id = {};
            var temp_lot_description = {};
            var temp_tcp = {};
            var temp_customer = {};
            var temp_invoiced = {};
            var temp_booked = {};
            var temp_deferred = {};
            var temp_vattable = {};
            var temp_percent_paid = {};
            var temp_jan = {};
            var temp_feb = {};
            var temp_mar = {};
            var temp_apr = {};
            var temp_may = {};
            var temp_jun = {};
            var temp_jul = {};
            var temp_aug = {};
            var temp_sep = {};
            var temp_oct = {};
            var temp_nov = {};
            var temp_dec = {};

            for(var i=0; i < data.length; i++) {
                var amortizationid = data[i].amortization_id;
                var contractID = data[i].contractID;
                var lot_id = data[i].lot_id;
                var lot_description = data[i].lot_description;
                var customer = data[i].firstname+' '+data[i].middlename+' '+data[i].lastname; 
                var invoice = data[i].is_invoiced;
                var book = data[i].is_booked;
                var deffered = data[i].is_tax_deffered;
                var vat = data[i].is_vattable;
                var amortization = Number(data[i].amortization_amount);
                var tcp = Number(data[i].total_contract_price);
                var parts = data[i].due_date.split('-');
                // var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                // var due_date = moment(data[i].due_date, "YYYY-MM-DD");
                var due_date = new Date(data[i].due_date);
                var month = due_date.getMonth() + 1;
                var date_today = moment();
                var sum_of_payments = getPayments(contractID);
                var percent_paid = (sum_of_payments / tcp) * 100;

                console.log('id = '+contractID);

                if (!temp_lot_id.hasOwnProperty(data[i].contractID)) {
                    temp_lot_id[data[i].contractID] = 0;
                }
                temp_lot_id[data[i].contractID] = lot_id;

                if (!temp_lot_description.hasOwnProperty(data[i].contractID)) {
                    temp_lot_description[data[i].contractID] = 0;
                }
                temp_lot_description[data[i].contractID] = lot_description;

                if (!temp_tcp.hasOwnProperty(data[i].contractID)) {
                    temp_tcp[data[i].contractID] = 0;
                }
                temp_tcp[data[i].contractID] = tcp;

                if (!temp_customer.hasOwnProperty(data[i].contractID)) {
                    temp_customer[data[i].contractID] = 0;
                }
                temp_customer[data[i].contractID] = customer;

                if (!temp_invoiced.hasOwnProperty(data[i].contractID)) {
                    temp_invoiced[data[i].contractID] = 0;
                }
                temp_invoiced[data[i].contractID] = invoice;

                if (!temp_booked.hasOwnProperty(data[i].contractID)) {
                    temp_booked[data[i].contractID] = 0;
                }
                temp_booked[data[i].contractID] = book;

                if (!temp_deferred.hasOwnProperty(data[i].contractID)) {
                    temp_deferred[data[i].contractID] = 0;
                }
                temp_deferred[data[i].contractID] = deferred;

                if (!temp_vattable.hasOwnProperty(data[i].contractID)) {
                    temp_vattable[data[i].contractID] = 0;
                }
                temp_vattable[data[i].contractID] = vat;

                if (!temp_percent_paid.hasOwnProperty(data[i].contractID)) {
                    temp_percent_paid[data[i].contractID] = 0;
                }
                temp_percent_paid[data[i].contractID] = percent_paid; //code here

                if (!temp_jan.hasOwnProperty(data[i].contractID)) {
                    temp_jan[data[i].contractID] = 0;
                }
                if (month == 1){
                    temp_jan[data[i].contractID] = amortization;
                }

                if (!temp_feb.hasOwnProperty(data[i].contractID)) {
                    temp_feb[data[i].contractID] = 0;
                }
                if (month == 2){
                    temp_feb[data[i].contractID] = amortization;
                }

                if (!temp_mar.hasOwnProperty(data[i].contractID)) {
                    temp_mar[data[i].contractID] = 0;
                }
                if (month == 3){
                    temp_mar[data[i].contractID] = amortization;
                }

                if (!temp_apr.hasOwnProperty(data[i].contractID)) {
                    temp_apr[data[i].contractID] = 0;
                }
                if (month == 4){
                    temp_apr[data[i].contractID] = amortization;
                }

                if (!temp_may.hasOwnProperty(data[i].contractID)) {
                    temp_may[data[i].contractID] = 0;
                }
                if (month == 5){
                    temp_may[data[i].contractID] = amortization;
                }

                if (!temp_jun.hasOwnProperty(data[i].contractID)) {
                    temp_jun[data[i].contractID] = 0;
                }
                if (month == 6){
                    temp_jun[data[i].contractID] = amortization;
                }

                if (!temp_jul.hasOwnProperty(data[i].contractID)) {
                    temp_jul[data[i].contractID] = 0;
                }
                if (month == 7){
                    temp_jul[data[i].contractID] = amortization;
                }

                if (!temp_aug.hasOwnProperty(data[i].contractID)) {
                    temp_aug[data[i].contractID] = 0;
                }
                if (month == 8){
                    temp_aug[data[i].contractID] = amortization;
                }

                if (!temp_sep.hasOwnProperty(data[i].contractID)) {
                    temp_sep[data[i].contractID] = 0;
                }
                if (month == 9){
                    temp_sep[data[i].contractID] = amortization;
                }

                if (!temp_oct.hasOwnProperty(data[i].contractID)) {
                    temp_oct[data[i].contractID] = 0;
                }
                if (month == 10){
                    temp_oct[data[i].contractID] = amortization;
                }

                if (!temp_nov.hasOwnProperty(data[i].contractID)) {
                    temp_nov[data[i].contractID] = 0;
                }
                if (month == 11){
                    temp_nov[data[i].contractID] = amortization;
                }

                if (!temp_dec.hasOwnProperty(data[i].contractID)) {
                    temp_dec[data[i].contractID] = 0;
                }
                if (month == 12){
                    temp_dec[data[i].contractID] = amortization;
                }

                
                console.log(due_date);
                console.log(month);
            }

            var lotids = [];
            for (var prop in temp_lot_id){
                lotids.push(temp_lot_id[prop]);
            }

            var lotdescription = [];
            for (var prop in temp_lot_description){
                lotdescription.push(temp_lot_description[prop]);
            }

            var tcps = [];
            for (var prop in temp_tcp){
                tcps.push(temp_tcp[prop]);
            }

            var customers = [];
            for (var prop in temp_customer){
                customers.push(temp_customer[prop]);
            }

            var invoiced = [];
            for (var prop in temp_invoiced){
                invoiced.push(temp_invoiced[prop]);
            }

            var booked = [];
            for (var prop in temp_booked){
                booked.push(temp_booked[prop]);
            }

            var deferred = [];
            for (var prop in temp_deferred){
                deferred.push(temp_deferred[prop]);
            }

            var vattable = [];
            for (var prop in temp_vattable){
                vattable.push(temp_vattable[prop]);
            }

            var percent_paid = [];
            for (var prop in temp_percent_paid){
                percent_paid.push(temp_percent_paid[prop]);
            }

            var jan = [];
            for (var prop in temp_jan){
                jan.push(temp_jan[prop]);
            }

            var feb = [];
            for (var prop in temp_feb){
                feb.push(temp_feb[prop]);
            }

            var mar = [];
            for (var prop in temp_mar){
                mar.push(temp_mar[prop]);
            }

            var apr = [];
            for (var prop in temp_apr){
                apr.push(temp_apr[prop]);
            }

            var may = [];
            for (var prop in temp_may){
                may.push(temp_may[prop]);
            }

            var jun = [];
            for (var prop in temp_jun){
                jun.push(temp_jun[prop]);
            }

            var jul = [];
            for (var prop in temp_jul){
                jul.push(temp_jul[prop]);
            }

            var aug = [];
            for (var prop in temp_aug){
                aug.push(temp_aug[prop]);
            }

            var sep = [];
            for (var prop in temp_sep){
                sep.push(temp_sep[prop]);
            }

            var oct = [];
            for (var prop in temp_oct){
                oct.push(temp_oct[prop]);
            }

            var nov = [];
            for (var prop in temp_nov){
                nov.push(temp_nov[prop]);
            }

            var dec = [];
            for (var prop in temp_dec){
                dec.push(temp_dec[prop]);
            }

            console.log(temp_lot_id);
            console.log(temp_lot_description);
            console.log(temp_tcp);
            console.log(temp_customer);
            console.log(temp_invoiced);
            console.log(temp_booked);
            console.log(temp_deferred);
            console.log(temp_vattable);
            console.log(temp_percent_paid);
            console.log(temp_jan);
            console.log(temp_feb);
            console.log(temp_mar);
            console.log(temp_apr);
            console.log(temp_may);
            console.log(temp_jun);
            console.log(temp_jul);
            console.log(temp_aug);
            console.log(temp_sep);
            console.log(temp_oct);
            console.log(temp_nov);
            console.log(temp_dec);
            console.log('-----------------');
            console.log(lotids);
            console.log(lotdescription);
            console.log(tcps);
            console.log(customers);
            console.log(invoiced);
            console.log(booked);
            console.log(deferred);
            console.log(vattable);
            console.log(percent_paid);
            console.log(jan);
            console.log(feb);
            console.log(mar);
            console.log(apr);
            console.log(may);
            console.log(jun);
            console.log(jul);
            console.log(aug);
            console.log(sep);
            console.log(oct);
            console.log(nov);
            console.log(dec);

            for (var x=0;x<lotids.length;x++){
                content += '<tr>';
                content += '<td>' + lotids[x] + '</td>';
                content += '<td>' + lotdescription[x] + '</td>';
                content += '<td>' + numberWithCommas(tcps[x]) + '</td>';
                content += '<td>' + customers[x] + '</td>';
                if (invoiced[x] == 1) {
                    content += '<td>True</td>';
                } else {
                    content += '<td>False</td>';
                }
                if (booked[x] == 1) {
                    content += '<td>True</td>';
                } else {
                    content += '<td>False</td>';
                }
                if (deferred[x] == 1) {
                    content += '<td>True</td>';
                } else {
                    content += '<td>False</td>';
                }
                if (vattable[x] == 1) {
                    content += '<td>True</td>';
                } else {
                    content += '<td>False</td>';
                }
                content += '<td>' + percent_paid[x] + '</td>';
                content += '<td>' + numberWithCommas(jan[x]) + '</td>';
                content += '<td>' + numberWithCommas(feb[x]) + '</td>';
                content += '<td>' + numberWithCommas(mar[x]) + '</td>';
                content += '<td>' + numberWithCommas(apr[x]) + '</td>';
                content += '<td>' + numberWithCommas(may[x]) + '</td>';
                content += '<td>' + numberWithCommas(jun[x]) + '</td>';
                content += '<td>' + numberWithCommas(jul[x]) + '</td>';
                content += '<td>' + numberWithCommas(aug[x]) + '</td>';
                content += '<td>' + numberWithCommas(sep[x]) + '</td>';
                content += '<td>' + numberWithCommas(oct[x]) + '</td>';
                content += '<td>' + numberWithCommas(nov[x]) + '</td>';
                content += '<td>' + numberWithCommas(dec[x]) + '</td>';
                content += '<tr>';
            }

            $('#tbody_rp').html(content);
            $('#title').text(projectname);
            $('#year').text(year);
            // $('#tblcollectionprojection').dataTable({
            //     "order": [[ 0, "asc" ]], // Sort by first column descending
            //     "scrollY": 200,
            //     "scrollX": true,
            // });

            },
            error: function(result){

            },
        });
    });
});

window.onload = makeTable;
function makeTable() {

	var content = '';
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/get_collection_projection",
        data: {'projectid':7},
        success: function(result){

        	//var table = document.getElementById("tblcollectionprojection");
            var data = jQuery.parseJSON(result);
            console.log('wiw');
            console.log(data);

            var temp_lot_id = {};
            var temp_lot_description = {};
            var temp_tcp = {};
            var temp_customer = {};
            var temp_invoiced = {};
            var temp_booked = {};
            var temp_deferred = {};
            var temp_vattable = {};
            var temp_percent_paid = {};
            var temp_jan = {};
            var temp_feb = {};
            var temp_mar = {};
            var temp_apr = {};
            var temp_may = {};
            var temp_jun = {};
            var temp_jul = {};
            var temp_aug = {};
            var temp_sep = {};
            var temp_oct = {};
            var temp_nov = {};
            var temp_dec = {};

            for(var i=0; i < data.length; i++) {
                var amortizationid = data[i].amortization_id;
                var contractID = data[i].contractID;
                var lot_id = data[i].lot_id;
                var lot_description = data[i].lot_description;
                var customer = data[i].firstname+' '+data[i].middlename+' '+data[i].lastname; 
                var invoice = data[i].is_invoiced;
                var book = data[i].is_booked;
                var deffered = data[i].is_tax_deffered;
                var vat = data[i].is_vattable;
                var amortization = Number(data[i].amortization_amount);
                var tcp = Number(data[i].total_contract_price);
                var parts = data[i].due_date.split('-');
                // var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                // var due_date = moment(data[i].due_date, "YYYY-MM-DD");
                var due_date = new Date(data[i].due_date);
                var month = due_date.getMonth() + 1;
                var date_today = moment();
                var sum_of_payments = getPayments(contractID);
                var percent_paid = (sum_of_payments / tcp) * 100;

                console.log('id = '+contractID);

                if (!temp_lot_id.hasOwnProperty(data[i].contractID)) {
                    temp_lot_id[data[i].contractID] = 0;
                }
                temp_lot_id[data[i].contractID] = lot_id;

                if (!temp_lot_description.hasOwnProperty(data[i].contractID)) {
                    temp_lot_description[data[i].contractID] = 0;
                }
                temp_lot_description[data[i].contractID] = lot_description;

                if (!temp_tcp.hasOwnProperty(data[i].contractID)) {
                    temp_tcp[data[i].contractID] = 0;
                }
                temp_tcp[data[i].contractID] = tcp;

                if (!temp_customer.hasOwnProperty(data[i].contractID)) {
                    temp_customer[data[i].contractID] = 0;
                }
                temp_customer[data[i].contractID] = customer;

                if (!temp_invoiced.hasOwnProperty(data[i].contractID)) {
                    temp_invoiced[data[i].contractID] = 0;
                }
                temp_invoiced[data[i].contractID] = invoice;

                if (!temp_booked.hasOwnProperty(data[i].contractID)) {
                    temp_booked[data[i].contractID] = 0;
                }
                temp_booked[data[i].contractID] = book;

                if (!temp_deferred.hasOwnProperty(data[i].contractID)) {
                    temp_deferred[data[i].contractID] = 0;
                }
                temp_deferred[data[i].contractID] = deferred;

                if (!temp_vattable.hasOwnProperty(data[i].contractID)) {
                    temp_vattable[data[i].contractID] = 0;
                }
                temp_vattable[data[i].contractID] = vat;

                if (!temp_percent_paid.hasOwnProperty(data[i].contractID)) {
                    temp_percent_paid[data[i].contractID] = 0;
                }
                temp_percent_paid[data[i].contractID] = percent_paid; //code here

                if (!temp_jan.hasOwnProperty(data[i].contractID)) {
                    temp_jan[data[i].contractID] = 0;
                }
                if (month == 1){
                    temp_jan[data[i].contractID] = amortization;
                }

                if (!temp_feb.hasOwnProperty(data[i].contractID)) {
                    temp_feb[data[i].contractID] = 0;
                }
                if (month == 2){
                    temp_feb[data[i].contractID] = amortization;
                }

                if (!temp_mar.hasOwnProperty(data[i].contractID)) {
                    temp_mar[data[i].contractID] = 0;
                }
                if (month == 3){
                    temp_mar[data[i].contractID] = amortization;
                }

                if (!temp_apr.hasOwnProperty(data[i].contractID)) {
                    temp_apr[data[i].contractID] = 0;
                }
                if (month == 4){
                    temp_apr[data[i].contractID] = amortization;
                }

                if (!temp_may.hasOwnProperty(data[i].contractID)) {
                    temp_may[data[i].contractID] = 0;
                }
                if (month == 5){
                    temp_may[data[i].contractID] = amortization;
                }

                if (!temp_jun.hasOwnProperty(data[i].contractID)) {
                    temp_jun[data[i].contractID] = 0;
                }
                if (month == 6){
                    temp_jun[data[i].contractID] = amortization;
                }

                if (!temp_jul.hasOwnProperty(data[i].contractID)) {
                    temp_jul[data[i].contractID] = 0;
                }
                if (month == 7){
                    temp_jul[data[i].contractID] = amortization;
                }

                if (!temp_aug.hasOwnProperty(data[i].contractID)) {
                    temp_aug[data[i].contractID] = 0;
                }
                if (month == 8){
                    temp_aug[data[i].contractID] = amortization;
                }

                if (!temp_sep.hasOwnProperty(data[i].contractID)) {
                    temp_sep[data[i].contractID] = 0;
                }
                if (month == 9){
                    temp_sep[data[i].contractID] = amortization;
                }

                if (!temp_oct.hasOwnProperty(data[i].contractID)) {
                    temp_oct[data[i].contractID] = 0;
                }
                if (month == 10){
                    temp_oct[data[i].contractID] = amortization;
                }

                if (!temp_nov.hasOwnProperty(data[i].contractID)) {
                    temp_nov[data[i].contractID] = 0;
                }
                if (month == 11){
                    temp_nov[data[i].contractID] = amortization;
                }

                if (!temp_dec.hasOwnProperty(data[i].contractID)) {
                    temp_dec[data[i].contractID] = 0;
                }
                if (month == 12){
                    temp_dec[data[i].contractID] = amortization;
                }

                
                console.log(due_date);
                console.log(month);
            }

            var lotids = [];
            for (var prop in temp_lot_id){
                lotids.push(temp_lot_id[prop]);
            }

            var lotdescription = [];
            for (var prop in temp_lot_description){
                lotdescription.push(temp_lot_description[prop]);
            }

            var tcps = [];
            for (var prop in temp_tcp){
                tcps.push(temp_tcp[prop]);
            }

            var customers = [];
            for (var prop in temp_customer){
                customers.push(temp_customer[prop]);
            }

            var invoiced = [];
            for (var prop in temp_invoiced){
                invoiced.push(temp_invoiced[prop]);
            }

            var booked = [];
            for (var prop in temp_booked){
                booked.push(temp_booked[prop]);
            }

            var deferred = [];
            for (var prop in temp_deferred){
                deferred.push(temp_deferred[prop]);
            }

            var vattable = [];
            for (var prop in temp_vattable){
                vattable.push(temp_vattable[prop]);
            }

            var percent_paid = [];
            for (var prop in temp_percent_paid){
                percent_paid.push(temp_percent_paid[prop]);
            }

            var jan = [];
            for (var prop in temp_jan){
                jan.push(temp_jan[prop]);
            }

            var feb = [];
            for (var prop in temp_feb){
                feb.push(temp_feb[prop]);
            }

            var mar = [];
            for (var prop in temp_mar){
                mar.push(temp_mar[prop]);
            }

            var apr = [];
            for (var prop in temp_apr){
                apr.push(temp_apr[prop]);
            }

            var may = [];
            for (var prop in temp_may){
                may.push(temp_may[prop]);
            }

            var jun = [];
            for (var prop in temp_jun){
                jun.push(temp_jun[prop]);
            }

            var jul = [];
            for (var prop in temp_jul){
                jul.push(temp_jul[prop]);
            }

            var aug = [];
            for (var prop in temp_aug){
                aug.push(temp_aug[prop]);
            }

            var sep = [];
            for (var prop in temp_sep){
                sep.push(temp_sep[prop]);
            }

            var oct = [];
            for (var prop in temp_oct){
                oct.push(temp_oct[prop]);
            }

            var nov = [];
            for (var prop in temp_nov){
                nov.push(temp_nov[prop]);
            }

            var dec = [];
            for (var prop in temp_dec){
                dec.push(temp_dec[prop]);
            }

            console.log(temp_lot_id);
            console.log(temp_lot_description);
            console.log(temp_tcp);
            console.log(temp_customer);
            console.log(temp_invoiced);
            console.log(temp_booked);
            console.log(temp_deferred);
            console.log(temp_vattable);
            console.log(temp_percent_paid);
            console.log(temp_jan);
            console.log(temp_feb);
            console.log(temp_mar);
            console.log(temp_apr);
            console.log(temp_may);
            console.log(temp_jun);
            console.log(temp_jul);
            console.log(temp_aug);
            console.log(temp_sep);
            console.log(temp_oct);
            console.log(temp_nov);
            console.log(temp_dec);
            console.log('-----------------');
            console.log(lotids);
            console.log(lotdescription);
            console.log(tcps);
            console.log(customers);
            console.log(invoiced);
            console.log(booked);
            console.log(deferred);
            console.log(vattable);
            console.log(percent_paid);
            console.log(jan);
            console.log(feb);
            console.log(mar);
            console.log(apr);
            console.log(may);
            console.log(jun);
            console.log(jul);
            console.log(aug);
            console.log(sep);
            console.log(oct);
            console.log(nov);
            console.log(dec);

            for (var x=0;x<lotids.length;x++){
                content += '<tr>';
                content += '<td>' + lotids[x] + '</td>';
                content += '<td>' + lotdescription[x] + '</td>';
                content += '<td>' + numberWithCommas(tcps[x]) + '</td>';
                content += '<td>' + customers[x] + '</td>';
                if (invoiced[x] == 1) {
                    content += '<td>True</td>';
                } else {
                    content += '<td>False</td>';
                }
                if (booked[x] == 1) {
                    content += '<td>True</td>';
                } else {
                    content += '<td>False</td>';
                }
                if (deferred[x] == 1) {
                    content += '<td>True</td>';
                } else {
                    content += '<td>False</td>';
                }
                if (vattable[x] == 1) {
                    content += '<td>True</td>';
                } else {
                    content += '<td>False</td>';
                }
                content += '<td>' + percent_paid[x] + '</td>';
                content += '<td>' + numberWithCommas(jan[x]) + '</td>';
                content += '<td>' + numberWithCommas(feb[x]) + '</td>';
                content += '<td>' + numberWithCommas(mar[x]) + '</td>';
                content += '<td>' + numberWithCommas(apr[x]) + '</td>';
                content += '<td>' + numberWithCommas(may[x]) + '</td>';
                content += '<td>' + numberWithCommas(jun[x]) + '</td>';
                content += '<td>' + numberWithCommas(jul[x]) + '</td>';
                content += '<td>' + numberWithCommas(aug[x]) + '</td>';
                content += '<td>' + numberWithCommas(sep[x]) + '</td>';
                content += '<td>' + numberWithCommas(oct[x]) + '</td>';
                content += '<td>' + numberWithCommas(nov[x]) + '</td>';
                content += '<td>' + numberWithCommas(dec[x]) + '</td>';
                content += '<tr>';
            }

            $('#tbody_rp').html(content);
            $('#title').text(data[0].project_name);

            // $('#tblcollectionprojection').dataTable({
            //     "order": [[ 0, "asc" ]], // Sort by first column descending
            //     "scrollX": true,
            // });

        },
        error: function(result){

        },
    });
}

function getPayments(contractID) {

    var data = new FormData();
    data.append('contractid',contractID);
    var sum_of_payments = 0;
    $.ajax({
        async: false,
        type: "POST",
        url:  baseurl + "collection/getPayments",
        data: data,
        cache: false,
        processData:false,
        contentType:false,
        success: function(result){

            var data = jQuery.parseJSON(result);
            
            for(x=0; x < data.length; x++){
                sum_of_payments = +sum_of_payments + +Number(data[x].amount);

            }
        },
        error: function (errorThrown){
            toastr.error('Error!', 'Operation Done');
            console.log(errorThrown);
        }
    });
    return sum_of_payments;

}

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}