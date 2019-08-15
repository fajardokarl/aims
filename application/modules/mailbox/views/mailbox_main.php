<div class="row">
	<div class="col-md-3 col-sm-3 " style="margin-bottom: 15px;">
		<div class="widget-thumb widget-bg-color-white" style="height: 80%;">
			<button class="btn blue btn-block" id="compose_mail">COMPOSE</button>
			<!-- <button class="btn blue btn-block">COMPOSE</button> -->
		</div>
	</div>
	<div class="col-md-9 col-sm-9" id="main_inbox">
		<div class="widget-thumb widget-bg-color-white ">
			<h3 class="bold font-green-meadow" style="margin-top: -3px;">INBOX</h3>
			<table class="table table-hover" id="mails">
				<thead style="display: none;">
					<tr>
						<th width="20%"></th>
						<th width="20%"></th>
						<th width="60%"></th>
						<th width="20%"></th>
					</tr>
				</thead>
				<tbody style="cursor: pointer;">
					<?php foreach ($mails as $mails): ?>
						<tr>
							<td width="20%" style="display: none;"><?php echo $mails['inbox_id'] ?></td>
							<td width="30%" class="bold"><?php echo $mails['lastname'] . ', ' . $mails['firstname'] ?></td>
							<td width="50%"><?php echo $mails['subject'] ?></td>
							<td width="20%"><?php echo date_format(date_create($mails['date_sent']), 'M d, Y'); ?></td>
						</tr>	
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-9 col-sm-9" id="message_content" style="display: none;">
		<div class="widget-thumb widget-bg-color-white ">
			<div class="row">
				<div class="col-md-6">
					<!-- <a id="" class=""><i class="m-icon-big-swapleft"></i></a> -->
					<button id="back_mail" type="button" class="btn btn-circle dark btn-outline"><i class="fa fa-arrow-left"></i>back</button>

				</div>
				<div class="col-md-6" align='right'>
					<!-- <a id="reply_mail" class=""> -->
					<button id="reply_mail" type="button" class="btn btn-circle dark btn-outline"><i class="fa fa-mail-reply"></i> reply</button>
				</div>
			</div>
			<h2 id="mail_subject" class="bold"></h2>
			<h4><strong>Sender:</strong> <span class="font font-blue" id="mail_sender"></span></h4>
			<div class="row">
				<div class="col-md-9">
					<div class="widget-thumb widget-bg-color-white border-default" style="height: 200px; min-height: 150px; border: solid; border-width: 1px; border-color: #E1E5EC;">
						<p id="mail_body"></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade bs-modal-md" id="modal_compose" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <div class="caption">
	                <button type="button" class="close" data-dismiss="modal" id="close_modal"></button>
                    <h4 class="bold">COMPOSE</h4>
                </div> 
            </div>
            <div class="modal-body form">
            	<br />
                <div class="row">
                	<div class="col-md-12">
                		<div class="form-group col-md-12 col-sm-12"><!-- form-group form-md-line-input -->
                            <strong>Recipient</strong> <!-- <font color="red"> * </font> -->
                            <!-- <input type="text" id="compose_recipient" name="compose_recipient" placeholder="" maxlength="50" class="form-control input-lg"/> -->
                        	<select class="form-control select2 select2-hidden-accessible" placeholder="Municipality/City" id="broker_city" name ="broker_city" required>
                                <!-- <option value="0" class ="" selected disabled>Municipality/City</option> -->
                                <?php foreach($emp as $emp){ ?>
	                                <option value="<?php echo $emp['user_id'];?>"><?php echo $emp['employee'];?></option>
                                <?php } ?> 
                            </select>   
                        </div>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                		<div class="form-group col-md-12 col-sm-12">
                            <strong>Subject</strong> <!-- <font color="red"> * </font> -->
                            <input type="text" id="compose_subject" name="compose_subject" placeholder="" maxlength="50" class="form-control input-lg"/>
                        </div>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                		<div class="form-group col-md-12 col-sm-12">
                            <strong>Content</strong> <!-- <font color="red"> * </font> -->
                            <!-- <input type="text" id="broker_realtyname" name="broker_realtyname" placeholder="" maxlength="50" class="form-control input-sm"/> -->
                        	<textarea type="text" id="compose_body" name="compose_body" class="form-control input" rows="5" style="resize: none;"></textarea>
                        </div>
                	</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn blue btn-circle" id="send_mail">SEND</button>
                <button type="button" class="btn gray btn-circle" id="delete_mail" name="">DELETE</button>
            </div>
        </div>
    </div>
</div>
