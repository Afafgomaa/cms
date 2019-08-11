	<section class="content-header">
		<span class="content-title"><i class="fa fa-home"></i>  الدفع</span>
		<ul class="header-btns">
			<?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
			<li>
				<a href="<?= App::$path ?>payment_clt/add" class="btn btn-success">
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
				<a href="<?= App::$path ?>payment_clt/printlist" target="_blank" class="btn btn-default">
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
				<th>رقم الفاتورة</th>
				<th>التاريخ</th>
				<th>الموضوع</th>
				<th>العميل</th>
				<th>مبلغ الفاتورة</th>
				<th>المبلغ المؤدى</th>
				<th>المبلغ الباقي</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach($payments_clt as $payment_clt):
				$payment_rest = $payment_clt->invoice_ttc - $payment_clt->total_paied;
				if($payment_rest > 0){
					$class = 'partial';
					if ($payment_rest == $payment_clt->invoice_ttc){
						$class = 'not-paied';
					}
				} else{
					$class = 'paied';

				}
				?>
				<tr class="<?= $class ?>">
					<td class="table-actions">
						<a href="#" class="btn btn-success btn-xs" invoice_id="<?= $payment_clt->id ?>" onclick="showPayments(this, event);"><i class="fa fa-list"></i> عمليات الدفع</a>
					</td>
					<td><a href="<?= App::$path ?>invoice_clt/articles/<?= $payment_clt->id ?>"><?= $payment_clt->num ?></a></td>
					<td><?= $payment_clt->dt ?></td>
					<td><?= $payment_clt->subject ?></td>
					<td><a href="<?= App::$path ?>client/show/<?= $payment_clt->client_id ?>"><?= $payment_clt->client_name ?></a></td>
					<td><?= $payment_clt->invoice_ttc ?></td>
					<td><?= $payment_clt->total_paied * 1 ?></td>
					<td><?= number_format($payment_rest, 2, '.', ' ') ?></td>

				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>
	</section>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">عمليات الدفع</h4>
				</div>
				<div class="modal-body">




				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
				</div>
			</div>
		</div>
	</div>
