	<section class="content-header">
		<span class="content-title"><i class="fa fa-home"></i> تدبير تسليم المنتجات</span>
	</section>
	<div class="row doc-infos">
		<div class="col-sm-6 col-xs-12">
			<div class="box-infos-search">
				<section class="content-header box-infos-header">
					<span class="content-title"> تسليم المنتجات</span>
				</section>
				<div class="box-infos">
					<input type="hidden" id="delivery_form_supplier_id" value="<?= $delivery_form_supplier->id ?>">
					<h3>الرقم: <?= $delivery_form_supplier->num ?></h3>
					<p>التاريخ: <?= $delivery_form_supplier->dt ?></p>
					<p>الموضوع: <?= $delivery_form_supplier->subject ?></p>
					<p>ملاحظات: <?= $delivery_form_supplier->discr ?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-xs-12">
			<div class="box-infos-search">
				<section class="content-header box-infos-header">
					<span class="content-title"><i class="fa fa-home"></i> العميل</span>
				</section>
				<div class="box-infos">
					<input type="hidden" id="supplier_id" value="<?= $delivery_form_supplier->supplier_id ?>">
					<h3 class="box-infos-name"><?= $delivery_form_supplier->supplier_name ?></h3>
					<p class="box-infos-city"><?= $delivery_form_supplier->city ?></p>
					<p class="box-infos-address"><?= $delivery_form_supplier->address ?></p>
				</div>
			</div>
		</div>
	</div>
	<section class="content-header">
		<span class="content-title"><i class="fa fa-home"></i>المنتجات</span>
		<ul class="header-btns">
			<?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
			<li>
				<a href="#" class="btn btn-warning" onclick="loadPurchase_ordersSupplier(event);" title=" استيراد طلب منتجاتن">
					<i class="fa fa-list"></i>
					<span class="hidden-xs hidden-sm"> استيراد طلب منتجات</span>
				</a>
			</li>
			<li>
				<a href="<?= App::$path ?>delivery_form_supplier/addart/<?= $delivery_form_supplier->id ?>" class="btn btn-success">
					<i class="fa fa-plus-circle"></i>
					<span class="hidden-xs hidden-sm"> إضافة</span>
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
				<a href="<?= App::$path ?>delivery_form_supplier/printdetails/<?= $delivery_form_supplier->id ?>" target="_blank" class="btn btn-default">
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
				<th>&nbsp;</th>
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
			foreach($delivery_form_supplier_arts as $delivery_form_supplier_art): ?>
				<tr>
					<td class="table-actions">
				<?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_articles): ?>
					<a href="<?= App::$path ?>delivery_form_supplier/editart/<?= $delivery_form_supplier_art->delivery_form_supplier_id ?>/<?= $delivery_form_supplier_art->id ?>" class="btn btn-warning btn-xs">تعديل</a>
						<a href="#" class="btn btn-danger btn-xs" delivery_form_art_id="<?= $delivery_form_supplier_art->id ?>" onclick="deleteElementArt(this, event);">حذف</a>

				<?php endif; ?>
					</td>
					<td><?= $delivery_form_supplier_art->art_id ?></td>
					<td><?= $delivery_form_supplier_art->ref ?></td>
					<td><?= $delivery_form_supplier_art->desig ?></td>
					<td><?= $delivery_form_supplier_art->unit ?></td>
					<td><?= $delivery_form_supplier_art->qte ?></td>
					<td class="currency"><?= App::nFormat($delivery_form_supplier_art->price) ?></td>
					<td class="currency"><?= App::nFormat($delivery_form_supplier_art->total) ?></td>

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
