<div class="row">
	<div class="col-md-12">
		<table id="tbl_migrate">
			<thead>
				<tr>
					<th>vendor_name</th>
					<th>account</th>
					<th>done</th>
					<th>type</th>
					<th>supplier_id</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($records as $record) { ?>
					<tr>
						<td><?= $record['vendor_name']; ?></td>
						<td><?= $record['expense_account']; ?></td>
						<td><?= $record['done']; ?></td>
						<td><?= $record['type']; ?></td>
						<td><?= $record['supplier_id']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>


