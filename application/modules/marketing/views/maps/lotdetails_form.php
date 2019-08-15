<div class="row">
	<div class="col-md-12">
		<div class="portlet dark box">
			<div class="portlet-title">
				<div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject sbold uppercase">Lot Information</span>
                </div>
			</div>
			<div class="portlet-body form">
				<form class="form-horizontal" role="form" enctype="multipart/form-data" id="form">
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-2">
                                <div class="from-group">
                                    <div class="fileinput fileinput-new " data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                        <div align="">
                                            <span class="btn green btn-outline btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" id="userfile" name="file"/> 
                                            </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group" id="old_project">
                                    <label class="col-md-3 control-label">Lot: </label>
                                    <div class="col-md-5">
                                        <select class="form-control select2 select2-hidden-accessible" id="opt_lot" name="opt_lot" required>
                                            <option value="0" selected>None</option>
                                            <?php foreach ($lots as $lots) { ?>
                                                <option value="<?php echo $lots['lot_id'] ?>"><?php echo $lots['lot_description'] ?></option>
                                            <?php } ?>
                                        </select>  
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Floor Area:</label>
                                    <div class="col-md-5">
                                        <input type="number" id="lot_flooraea" class="form-control" placeholder="Sq M">
                                        <!-- <span class="help-block"> A block of help text. </span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Length:</label>
                                    <div class="col-md-5">
                                        <input type="number" id="lot_length" class="form-control" placeholder="">
                                        <!-- <span class="help-block"> A block of help text. </span> -->
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Width:</label>
                                    <div class="col-md-5">
                                        <input type="number" id="lot_width" class="form-control" placeholder="">
                                        <!-- <span class="help-block"> A block of help text. </span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class=" col-md-9" align="right">
                                <button type="button" id="submit_lotinfo" class="btn green">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <button id="test_img" type="Submit">
                        OKOKOKOKOK!
                    </button>
                </form>
			</div>
		</div>
	</div>
</div>



<!-- <div class="row">
    <div class="col-md-3" style="height: 50px; background-color: red;"></div>
    <div class="col-md-3" style="height: 50px; background-color: blue;"></div>
    <div class="col-md-3" style="height: 50px; background-color: yellow;"></div>
    <div class="col-md-3" style="height: 50px; background-color: orange;"></div>
</div>
<div class="row">
    <div class="col-md-3" style="height: 50px; background-color: blue;"></div>
    <div class="col-md-3" style="height: 50px; background-color: red;"></div>
    <div class="col-md-3" style="height: 50px; background-color: orange;"></div>
    <div class="col-md-3" style="height: 50px; background-color: yellow;"></div>
</div>
 -->











<!-- <div class="row">
    <div class="col-md-12">
        <div class="portlet dark box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject sbold uppercase">Lot Information</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form">
                    <div class="form-body">
                        <table>
                            <tr>
                                <td>
                                    <div class="from-group col-md-3">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                            <div>
                                                <span class="btn green btn-outline btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" id="userfile" name="userfile"/> 
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Floor Area</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" placeholder="Sq M">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Length</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Width</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                       


                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn green">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->