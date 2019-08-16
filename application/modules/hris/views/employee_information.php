<style type="text/css">
    .modleft {
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
    }
</style>

<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Information</span>
</div>

<div class="actions"> 
<!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->

</div>

<div class="actions"> 
<!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
<button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_canvass_form"><i class="fa fa-plus"> </i>Get PDF</button>
</div>
</div>
<div class="portlet-body">
<form class="form-horizontal">
<div class="row">
<div class="col-md-12">
<!-- <div class="form-group"> -->
 <div class="row">   
<div class="form-group">
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase">ID:</span></label>
    <div class="col-md-3">
        <p class="form-control-static">
            <?php echo $emp->person_id; ?>
            <input type="hidden" id="person_id" value="<?php echo $emp->person_id; ?>">
        </p>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<!-- <div class="form-group"> -->
<div class="row">   
<div class="form-group">
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Name:</span></label>
    <div class="col-md-3">
        <p class="form-control-static">
            <?php echo $emp->prefix; echo " "; echo $emp->firstname; echo " "; echo $emp->middlename; echo " "; echo $emp->lastname; echo " "; echo $emp->suffix; ?>
        </p>
    </div>

    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Department:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->department_name;?>
        </p>
    </div>
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Position:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->job_position;?>
        </p>
    </div>
</div>
</div>
<div class="row">   
<div class="form-group">
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Sex:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->sex; ?>
        </p>
    </div>

    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Birthdate:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->birthdate;?>
        </p>
    </div>
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Birthplace:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->birthplace;?>
        </p>
    </div>
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Nationality:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->nationality;?>
        </p>
    </div>
</div>
</div>
<div class="row">   
<div class="form-group">
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Status:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->civil_status_name; ?>
        </p>
    </div>

    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Weight:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->weight;?>
        </p>
    </div>
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Height:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->height;?>
        </p>
    </div>
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> TIN:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->tin;?>
        </p>
    </div>
</div>
</div>
<div class="row">   
<div class="form-group">
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> SSS no.:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->sss; ?>
        </p>
    </div>

    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> HDMF no.:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->hdmf;?>
        </p>
    </div>
    <label class="col-md-1 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PHIC no.:</span></label>
    <div class="col-md-2">
        <p class="form-control-static">
            <?php echo $emp->phic;?>
        </p>
    </div>

</div>
</div>


<div class="row">   
<div class="form-group">
<div class="caption col-md-6">
<span class="bold uppercase col-md-6">Address information</span>
</div>
</div>
</div>
<div class="row">
<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="contact_table">
<thead>
<tr>
    <th>ID</th>
    <th>Contact type</th>
    <th>Contact</th>
    <th>action</th>
   <!--  <th>Action</th> -->
</tr>
</thead>
<tbody>
<?php foreach($contact as $contact){ ?>
    <tr>
        <td><?php echo $contact['contact_id']; ?></td>
        <td><?php echo $contact['contact_type_name'] ;?></td>           
        <td><?php echo $contact['contact_value']; ?></td>
        <td><?php echo $contact['contact_value']; ?></td>
    
    </tr>
<?php } ?> 
</tbody>
</table>

<div class="row">   
<div class="form-group">
<div class="caption col-md-6">
<span class="bold uppercase col-md-6">Contact information</span>
</div>
</div>
</div>
<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">


<table class="table table-hover" id="address_table">
<thead>
<tr>
    <th>ID</th>
    <th>Address type</th>
    <th>Address</th>
    <th>Postal code</th>
</tr>
</thead>
<tbody>
<?php foreach($address as $address){ ?>
    <tr>
        <td><?php echo $address['address_id']; ?></td>

        <td><?php echo $address['address_type_id'] ;?></td>
        <td><?php echo $address['line_1'].' '.$address['line_2'].' '.$address['city_id'].' '.$address['province_id'].' '.$address['country_id'] ?></td>       
        <td><?php echo $address['postal_code']; ?></td>
    
    </tr>
<?php } ?>
</tbody>
</table>

<div class="row">   
<div class="form-group">
<div class="caption col-md-6">
<span class="bold uppercase col-md-6">School last attended</span>
</div>
</div>
</div>
<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">


<table class="table table-hover" id="school_table">
<thead>
<tr>
    <th>ID</th>
    <th>Level</th>
    <th>School</th>
    <th>From</th>
    <th>To</th>
    <th>Year Graduated</th>
</tr>
</thead>
<tbody>
<?php foreach($school as $school){ ?>
    <tr>
        <td><?php echo $school['school_attended_id']; ?></td>

        <td><?php echo $school['level'] ;?></td>
        <td><?php echo $school['schoolName'] ;?></td>
        <td><?php echo $school['fromdate'];?></td>       
        <td><?php echo $school['todate']; ?></td>
        <td><?php echo $school['yearGraduate']; ?></td>
    
    </tr>
<?php } ?>
</tbody>
</table>


<div class="row">   
<div class="form-group">
<div class="caption col-md-6">
<span class="bold uppercase col-md-6">Family background</span>
</div>
</div>
</div>
<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">


<table class="table table-hover" id="family_table">
<thead>
<tr>
    <th>ID</th>
    <th>Level</th>
    <th>School</th>
    <th>From</th>
    <th>To</th>
    <th>Year Graduated</th>
</tr>
</thead>
<tbody>
<?php foreach($family as $family){ ?>
    <tr>
        <td><?php echo $family['school_attended_id']; ?></td>

        <td><?php echo $family['level'] ;?></td>
        <td><?php echo $family['level'] ;?></td>
        <td><?php echo $family['fromdate'];?></td>       
        <td><?php echo $family['todate']; ?></td>
        <td><?php echo $family['yearGraduate']; ?></td>
    
    </tr>
<?php } ?>
</tbody>
</table>




</div>
</div>
</div>
</div>
</div>
</div>


</div>
</div>
</form>

</div>
</div>


<div class="modal fade bs-modal-xs" id="add_movement" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-xm">
<div class="modal-content">
<div class="modal-header">
<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
<h4 class="modal-title" id="" style="font-weight: bold;">Option</h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div class="note note-default">
<!-- <div class="portlet-body"> -->
<div class="col-md-12" style="margin-top: 20px;">

</div>
<input type="hidden" id="person_id">
<div class="col-md-4" style="margin-top: 15px;">

</div>
<font color="white" style="">.</font>
<!-- </div> -->
</div>
</div>
</div>

          <button type="button" class="close" id="btn_closestatus" tabindex="-1" data-dismiss="modal"></button>
                </div>
            </div>
            <div class="portlet light">
                <form action="<?=base_url()?>logistics/prf_list_controller/cancelStatus" method="post">
                    <div class="form-group">
                        <input type="hidden" name="mod_person_id" id="mod_person_id">
                        <input type="hidden" name="mod_statusid" id="mod_statusid">
                        <button type="submit" id="status_approve" class="form-control btn btn-circle green" style="margin-bottom: 10px;">Activate</button>
                        <button type="submit" id="status_deny" class="form-control btn btn-circle red">Cancel</button>
                    </div>
                    <div align="right">
<!-- <button id="confirm_print" class="btn blue">Print Sticker</button> -->
<button id="" class="btn red" data-dismiss="modal">close</button>

</div>
                </form>
            </div>


</div>
<div class="modal-footer">

</div>
</div>
</div>
</div>