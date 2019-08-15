<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> List of all Travel Orders</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div id="">
	<table id="all_my_TO" class="table table-hover">
	   <thead>
			<tr>
            <th>TO no.</th>
            <th>Department</th>
            <th>Date from</th>
            <th>Date to</th>
            <th>Destination</th>
            <th>Purpose</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($retrieve as $retrieve){ ?>
            <tr>                            
            <td><?php echo $retrieve['to_id']; ?></td>
            <td><?php echo $retrieve['department_id']; ?></td>
            <td><?php echo $retrieve['date_from'].'/'.$retrieve['EDT']; ?></td>
            <td><?php echo $retrieve['date_to'].'/'.$retrieve['ETA']; ?></td>
            <td><?php echo $retrieve['destination']; ?></td>
            <td><?php echo $retrieve['purpose']; ?></td>
            <td><button type="button" class="btn blue-dark btn-lot-edit btn-xs" data-toggle="modal" data-target="#view-TO" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button></td>                    
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


<div id="view-TO" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Travel Order<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <form id="updateLot">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-body">
                                <div class="form-group">                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                    <div class="caption">
                                            <span class="caption-subject"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                                  <input type="hidden" id="to_id" name="to_id"  placeholder="" maxlength="30" class="form-control"/>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="row">
                                        <div class="col-md-3">
                                        <label class="control-label"><b>Status</b></label>
                                        <select class="form-control select2 select2-hidden-accessible" id="activate_cancel" required>
                                        <option value="0">Activate</option>
                                        <option value="1">Cancel</option>
                                        </select>
                                    </div>  
                                    </div>
                                    <div class="col-md-6">
                                    <div data-date-format="mm/yyyy" >
                                          <label class="control-label"><b>From </b><font color="red"> * </font></label>
                                            <input  type="text" name="datefrom" placeholder="yyyy-mm-dd" class="form-control" id="datefrom" maxlength="10" required onkeypress="return isNumber()"/>                
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div data-date-format="mm/yyyy" >
                                      <label class="control-label"><b>To </b><font color="red"> * </font></label>
                                        <input  type="text" name="dateTo" placeholder="yyyy-mm-dd" class="form-control" id="dateTo" maxlength="10" required onkeypress="return isNumber()"/>                
                                    </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
      <label class="control-label"><b>Estimated time of departure</b><font color="red"> * </font></label>   
        <div class='input-group date' >
            <input type='time' class="form-control" id='etd'/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
        </div>
    </div>
                                    </div>
                                    <div class="col-md-6">
                                  <div class="form-group">
             <label class="control-label"><b>Estimated time of arrival</b><font color="red"> * </font></label>   
               <div class='input-group date' >
            <input type='time' class="form-control" id='eta'/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
        </div>

        </div>
                                    </div>
                                </div>


    <table id="transportation_table" class="table table-hover">                    
       <thead>
            <tr>
                <th>Item</th>    
                <th>Transportation</th>                
            </tr>
        </thead>
    <tbody>
        <tr>
            <td>      
                <select class="form-control select2 select2-hidden-accessible" id="destination" name ="destination" >
                <option value="0" class ="disabled selected">Select</option>

                <?php foreach($all_destination as $all_destination){ ?>
                <option value="<?php echo $all_destination['destination_type'];?>"><?php echo 
                $all_destination['destination'];?></option><?php } ?>
                </select>
            </td> 

            <td>  
                <select class="form-control select2 select2-hidden-accessible" id="through" name="through" required>
                <option selected disabled></option>
            </select>
            </td>  
        </tr>
    </tbody>
                    </table>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label"><b>Purpose</b><font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="purpose" name="purpose"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>
</div>                         
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" id="update_TO" ></span>Save Changes</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>                 
                </div>
            </form> 
        </div>
    </div>
</div>