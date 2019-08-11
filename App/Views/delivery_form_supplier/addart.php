	<section class="content-header">
		<span class="content-title"><i class="fa fa-home"></i> إضافة منتج  لتسليم المنتجات</span>
	</section>
	<section class="content">
		<div class="row doc-infos">
			<div class="col-sm-6 col-xs-12">
				<div class="box-infos-search">
					<section class="content-header box-infos-header">
						<span class="content-title"> تسليم المنتجات</span>
					</section>
					<div class="box-infos">
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
						<h3 class="box-infos-name"><?= $delivery_form_supplier->supplier_name ?></h3>
						<p class="box-infos-city"><?= $delivery_form_supplier->city ?></p>
						<p class="box-infos-address"><?= $delivery_form_supplier->address ?></p>
					</div>
				</div>
			</div>
		</div>
		<form method="post" name="form-delivery_form-article-add" id="form-delivery_form-article-add" enctype="multipart/form-data">
			<div class="row">
					<div class="col-xs-12 box-infos-search">
						<section class="content-header box-infos-header">
							<span class="content-title"><i class="fa fa-home"></i> المنتج</span>
							<?php if(!isset($delivery_form_supplier_art)){ ?>
							<a href="#" class="btn btn-default btn-search btn-infos-search" onclick="loadArticles(event);">
								<i class="fa fa-search"></i>
							</a>
							<?php } ?>

						</section>
						<div class="box-infos">
							<?php if(isset($delivery_form_supplier_art)){ ?>
								<input type="hidden" value="<?= $delivery_form_supplier_art->id ?>" name="art_id" class="box-infos-id">
								<h3 class="box-infos-desig"><?= $delivery_form_supplier_art->desig ?></h3>
								<p class="box-infos-ref"><?= $delivery_form_supplier_art->ref ?></p>
							<?php } else { ?>
								<input type="hidden"
									   name="art_id"
									   class="box-infos-id"
									   data-validation="length"
									   data-validation-length="1-255"
									   data-validation-error-msg="المرجو اختيار المنتج.">
								<h3 class="box-infos-desig"></h3>
								<p class="box-infos-ref"></p>
							<?php } ?>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<?=  $form->input('qte', 'الكمية', [
							'type' => 'text',
							'id' => 'qte',
							'onkeyup' => 'calcTotal();',
							'placeholder' => 'الكمية',
							'data-validation' => 'number',
							'data-validation-allowing' => 'range[0.5;1000000],float',
							'data-validation-error-msg' => 'الكمية يجب أن تكون عبارة عن رقم.'
						]); ?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<?=  $form->input('price', 'الثمن', [
							'type' => 'text',
							'id' => 'price',
							'onkeyup' => 'calcTotal();',
							'placeholder' => 'الثمن',
							'data-validation' => 'number',
							'data-validation-allowing' => 'range[0.5;1000000],float',
							'data-validation-error-msg' => 'الثمن يجب أن تكون عبارة عن رقم.'
						]); ?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<?=  $form->input('total', 'المجموع', [
							'type' => 'text',
							'value' => isset($delivery_form_supplier_art->total) ? $delivery_form_supplier_art->total : '0.00',
							'id' => 'total',
							'readonly' => 'readonly',
							'class' => 'form-control currency'
						]); ?>
					</div>
					<div class="col-lg-12 form-group text-center">
						<hr>
						<button type="submit" id="btn-save-delivery_form-article" class="btn btn-primary">حفظ</button>
					</div>
			</div>
		</form>

	</section>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">المنتجات</h4>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table rtl_table data-table table-striped table-hover">
							<thead>
							<tr>
								<th>&nbsp;</th>
								<th>الرقم</th>
								<th>الكود</th>
								<th>الإسم</th>
								<th>الوحدة</th>
								<th>الصنف</th>
								<th>TVA</th>
								<th>المورد</th>
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
