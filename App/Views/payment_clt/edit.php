<section class="content-header">
    <span class="content-title"><i class="fa fa-edit"></i> إضافة أو تعديل عملية الدفع</span>
</section>
<section class="content">
    <form method="post" name="form-payment-add" id="form-payment-add" enctype="multipart/form-data">
        <div class="row form-add-top">
            <div class="col-xs-12 col-sm-6">
                <div class="box-infos-search">
                    <section class="content-header box-infos-header">
                        <span class="content-title"><i class="fa fa-home"></i> العميل</span>
                        <a href="#" class="btn btn-default btn-search btn-infos-search" onclick="LoadClients(event);">
                            <i class="fa fa-search"></i>
                        </a>
                    </section>
                    <div class="box-infos">
                        <?php if(isset($payment)){ ?>
                        <input type="hidden" value="<?= $payment->client_id ?>" name="box-infos-id" class="box-infos-id">
                        <h3 class="box-infos-name"><?= $payment->client_name ?></h3>
                        <p class="box-infos-city"><?= $payment->city ?></p>
                        <p class="box-infos-address"><?= $payment->address ?></p>
                        <?php } else { ?>
                            <input type="hidden" name="box-infos-id" class="box-infos-id">
                            <h3 class="box-infos-name"></h3>
                            <p class="box-infos-city"></p>
                            <p class="box-infos-address"></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="box-infos-search">
                    <section class="content-header box-infos-header">
                        <span class="content-title"><i class="fa fa-home"></i> مجموع المعاملات</span>
                    </section>
                    <div class="box-infos">
                        <div class="form-group">
                            <label>مجموع الفواتير: </label>
                            <input type="text" id="total_invoices" class="form-control currency" readonly>
                        </div>
                        <div class="form-group">
                            <label>مجموع المؤدى: </label>
                            <input type="text" id="total_paied" class="form-control currency" readonly>
                        </div>
                        <div class="form-group">
                            <label>مجموع الباقي: </label>
                            <input type="text" id="total_rest" class="form-control currency" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>الفواتير المتبقية</h3>
            </div>
            <div class="panel-body">
                <div class="payment_table table-responsive">
            <table class="table main-table rtl_table data-table table-striped table-hover">
                <thead>
                <tr>
                    <th>رقم الفاتورة</th>
                    <th>التاريخ</th>
                    <th>الموضوع</th>
                    <th>مبلغ الفاتورة</th>
                    <th>المبلغ المؤدى</th>
                    <th>المبلغ الباقي</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>المبلغ الواجب أداؤه: </label>
                    <input type="text" id="total_rest_to_pay" class="form-control currency" readonly>
                </div>
                <?=  $form->input('amount', 'المبلغ المراد دفعه: ', [
                    'type' => 'text',
                    'id' => 'amount',
                    'onkeyup' => 'calcTotalRest();',
                    'placeholder' => 'المبلغ المراد دفعه: ',
                    'data-validation' => 'number',
                    'data-validation-allowing' => 'range[0.5;1000000],float',
                    'data-validation-error-msg' => 'المبلغ يجب أن تكون عبارة عن رقم.'
                ]); ?>
                <div class="form-group">
                    <label>المبلغ المتبقي</label>
                    <input type="text" id="amount_rest" class="form-control currency" readonly>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
            <?=  $form->input('p_ref', 'رمز المرفق', [
                    'type' => 'text',
                    'placeholder' => 'رمز المرفق',
                    'data-validation' => 'length',
                    'data-validation-length' => 'max255',
                    'data-validation-optional' => 'true',
                    'data-validation-error-msg' => 'رمز المرفق يجب ألا يتجاوز 255 حرف.'
                ]); ?>
                <?=  $form->select('p_method_id', 'طريقة الأداء', $payment_methods); ?>

                <?=  $form->input('attachment', 'صورة المرفق: ', [
                    'type' => 'file',
                    'id' => 'attachment',
                    'data-validation-optional' => 'true',
                    'data-validation' => 'mime size',
                    'data-validation-allowing' => 'jpg',
                    'data-validation-error-msg' => 'الصورة ضرورية وبحجم لا يزيد عن 1M من نوع jpg'
                ]); ?>
            </div>
            <div class="col-lg-12 form-group text-center">
                <hr>
                <button type="submit" id="btn-save-payment" class="btn btn-primary">حفظ</button>
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
                <h4 class="modal-title" id="myModalLabel">العملاء</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table rtl_table data-table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>الإسم</th>
                            <th>المدينة</th>
                            <th>العنوان</th>
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
