	<section class="content-header">
		<span class="content-title"><i class="fa fa-home"></i> تسليم المنتجات</span>
		<ul class="header-btns">
			<?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
			<li>
				<a href="<?= App::$path ?>delivery_form_supplier/add" class="btn btn-success">
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
				<a href="<?= App::$path ?>delivery_form_supplier/printlist" target="_blank" class="btn btn-default">
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
				<th>الرقم</th>
				<th>التاريخ</th>
				<th>الموضوع</th>
				<th>العميل</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach($delivery_forms_supplier as $delivery_form_supplier): ?>
				<tr>
					<td class="table-actions">
						<a href="<?= App::$path ?>delivery_form_supplier/printdetails/<?= $delivery_form_supplier->id ?>" target="_blank" class="btn btn-default btn-xs">طباعة</a>
				<?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_articles): ?>
					<a href="<?= App::$path ?>delivery_form_supplier/edit/<?= $delivery_form_supplier->id ?>" class="btn btn-warning btn-xs">تعديل</a>
						<a href="#" class="btn btn-danger btn-xs" delivery_form_id="<?= $delivery_form_supplier->id ?>" onclick="deleteElement(this, event);">حذف</a>
					<a href="<?= App::$path ?>delivery_form_supplier/articles/<?= $delivery_form_supplier->id ?>" class="btn btn-primary btn-xs">المنتجات</a>

				<?php endif; ?>
					</td>
					<td><a href="<?= App::$path ?>delivery_form_supplier/articles/<?= $delivery_form_supplier->id ?>"><?= $delivery_form_supplier->num ?></a></td>
					<td><?= $delivery_form_supplier->dt ?></td>
					<td><?= $delivery_form_supplier->subject ?></td>
					<td><a href="<?= App::$path ?>supplier/show/<?= $delivery_form_supplier->supplier_id ?>"><?= $delivery_form_supplier->supplier_name ?></a></td>

				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>

	</section>
