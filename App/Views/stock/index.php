	<section class="content-header">
		<span class="content-title"><i class="fa fa-home"></i> المخازن</span>
	</section>
	<section class="content">
		<div class="table-responsive">
			<table class="table main-table rtl_table data-table table-striped table-hover">
			<thead>
			<tr>
				<th>رقم المنتج</th>
				<th>الكود</th>
				<th>الإسم</th>
				<th>الوحدة</th>
				<th>الكمية الوادة</th>
				<th>الكمية الصادرة</th>
				<th>الكمية المتوفرة</th>
				<th>الثمن</th>
				<th>المجموع</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach($stocks as $stock): ?>
				<tr>
					<td><?= $stock->art_id ?></td>
					<td><?= $stock->ref ?></td>
					<td><?= $stock->desig ?></td>
					<td><?= $stock->unit ?></td>
					<td><?= $stock->qte_in ?></td>
					<td><?= $stock->qte_out ?></td>
					<td><?= $stock->qte_stock ?></td>
					<td class="currency"><?= App::nFormat($stock->price) ?></td>
					<td class="currency"><?= App::nFormat($stock->total) ?></td>

				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>
		<div>
			<div class="col-sm-6 col-md-4">
				<label>مجموع الأثمنة</label>
				<input type="text" value="<?= App::nFormat($totals->total_ht) ?>" class="form-control currency" readonly>
			</div>
			<div class="col-sm-6 col-md-4">
				<label  style="direction: ltr">TVA (<span><?= number_format($totals->total_tva_rate,0,'','') ?></span> %)</label>
				<input type="text" value="<?= App::nFormat($totals->total_tva) ?>" class="form-control currency" readonly>
			</div>
			<div class="col-sm-6 col-md-4">
				<label> المجموع TTC</label>
				<input type="text" value="<?= App::nFormat($totals->total_ttc) ?>" class="form-control currency" readonly>
			</div>

		</div>
	</section>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"> طلبات المنتجات</h4>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table rtl_table data-table table-striped table-hover">
							<thead>
							<tr>
								<th>&nbsp;</th>
								<th>الرقم</th>
								<th>التاريخ</th>
								<th>العميل</th>
							</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
				</div>
			</div>
		</div>
	</div>
