	<section class="content-header">
		<span class="content-title"><i class="fa fa-home"></i> الفواتير</span>
	</section>
	<div class="row doc-infos">
		<div class="col-sm-6 col-xs-12">
			<div class="box-infos-search">
				<section class="content-header box-infos-header">
					<span class="content-title"> الفواتير</span>
				</section>
				<div class="box-infos">
					<input type="hidden" id="invoice_clt_id" value="<?= $invoice_clt->id ?>">
					<h3>الرقم: <?= $invoice_clt->num ?></h3>
					<p>التاريخ: <?= $invoice_clt->dt ?></p>
					<p>الموضوع: <?= $invoice_clt->subject ?></p>
					<p>ملاحظات: <?= $invoice_clt->discr ?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-xs-12">
			<div class="box-infos-search">
				<section class="content-header box-infos-header">
					<span class="content-title"><i class="fa fa-home"></i> العميل</span>
				</section>
				<div class="box-infos">
					<input type="hidden" id="client_id" value="<?= $invoice_clt->client_id ?>">
					<h3 class="box-infos-name"><?= $invoice_clt->client_name ?></h3>
					<p class="box-infos-city"><?= $invoice_clt->city ?></p>
					<p class="box-infos-address"><?= $invoice_clt->address ?></p>
				</div>
			</div>
		</div>
	</div>
	<section class="content-header">
		<span class="content-title"><i class="fa fa-home"></i>المنتجات</span>
		<ul class="header-btns">
			<?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
			<li>
				<a href="#" class="btn btn-warning" onclick="loadDelivery_formsClt(event);" title=" استيراد طلب منتجاتن">
					<i class="fa fa-list"></i>
					<span class="hidden-xs hidden-sm"> استيراد سند تسليم المنتجات</span>
				</a>
			</li>

			<?php endif; ?>
			<li>
				<a href="#" class="btn btn-primary" onclick="searchToogle('form-search-wrap', event);">
					<i class="fa fa-search"></i>
					<span class="hidden-xs hidden-sm"> بحث</span>
				</a>
			</li>
			<li>
				<a href="<?= App::$path ?>invoice_clt/printdetails/<?= $invoice_clt->id ?>" target="_blank" class="btn btn-default">
					<i class="fa fa-print"></i>
					<span class="hidden-xs hidden-sm"> طباعة</span>
				</a>
			</li>
		</ul>
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
				<th>الكمية</th>
				<th>الثمن</th>
				<th>المجموع</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach($invoice_clt_arts as $invoice_clt_art): ?>
				<tr>
					<td><?= $invoice_clt_art->art_id ?></td>
					<td><?= $invoice_clt_art->ref ?></td>
					<td><?= $invoice_clt_art->desig ?></td>
					<td><?= $invoice_clt_art->unit ?></td>
					<td><?= $invoice_clt_art->qte ?></td>
					<td class="currency"><?= App::nFormat($invoice_clt_art->price) ?></td>
					<td class="currency"><?= App::nFormat($invoice_clt_art->total) ?></td>

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
					<h4 class="modal-title" id="myModalLabel"> سندات تسليم المنتجات</h4>
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
