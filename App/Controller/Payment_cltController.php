<?php
namespace App\Controller;

use App\Model\Payment_method;
use Core\HTML\BootstrapForm;
use Core\Upload;


class Payment_cltController extends AppController
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('Payment_clt');
		$this->loadModel('Payment_method');
		$this->loadModel('Client');
	}

	public function index(){
		$payments_clt = $this->Payment_clt->load();
		$form = new bootstrapForm($_POST);

		$this->render('payment_clt/index', compact('form', 'payments_clt'));
	}
	public function modal(){
		$invoice_id = $_POST['invoice_id'];

		$invoice_clt = $this->Payment_clt->find($invoice_id);
		$payments_clt = $this->Payment_clt->byInvoice($invoice_id);
		$rs = '<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>معلومات الفاتورة</h3>
		</div>
		<div class="panel-body">
			<div class="col-sm-12 col-md-6">
				<h4><span>رقم الفاتورة</span> '.$invoice_clt->num.'</h4>
				<p><span>تاريخ الفاتورة: </span> '.$invoice_clt->dt.'</p>
				<p><span>الموضوع</span> '.$invoice_clt->subject .'</p>
				<h4><span>العميل</span> '.$invoice_clt->client_name .'</p>
			</div>
			<div class="col-sm-12 col-md-6">
				<h4><span>مبلغ الفاتورة</span> '.$invoice_clt->invoice_ttc.'</h4>
				<h4><span>مجمةع المؤدى</span> '.$invoice_clt->total_paied.'</h4>
				<h4><span>الباقي</span> '.number_format($invoice_clt->invoice_ttc  - $invoice_clt->total_paied, 2, '.', ' ') .'</h4>
			</div>

		</div>
	</div>';
		$rs .= '<div class="table-responsive">
						<table class="table rtl_table data-table table-striped table-hover">
							<thead>
							<tr>
								<th>المبلغ المدفوع</th>
								<th>طريقة الدفع</th>
								<th> رمز المرفق</th>
								<th>المرفقات</th>
								<th>تاريخ الدفع</th>
							</tr>
							</thead>
							<tbody>';
		foreach($payments_clt as $payment_clt) {
			$rs .= '<tr>
						<td>' . $payment_clt->amount . '</td>
						<td>' . $payment_clt->pm_name . '</td>
						<td>' . $payment_clt->p_ref . '</td>
						<td>' . $payment_clt->attachment . '</td>
						<td>' . $payment_clt->created_at . '</td>
					</tr>';
		}
		$rs .= '</tbody>
						</table>
					</div>';
		return $rs;
	}
	public function byClient(){
		$client_id = $_POST['client_id'];
		$payments_clt = $this->Payment_clt->byClient($client_id);
		$rs = '';
		$total_invoices = 0;
		$total_paied = 0;
		$total_rest = 0;
		foreach($payments_clt as $payment_clt) {
			$total_invoices += $payment_clt->invoice_ttc;
			$total_paied += $payment_clt->total_paied;
			$total_rest += ($payment_clt->invoice_ttc - $payment_clt->total_paied);

			$payment_rest = $payment_clt->invoice_ttc - $payment_clt->total_paied;
			if($payment_rest > 0){
				$class = 'partial';
				if ($payment_rest == $payment_clt->invoice_ttc){
					$class = 'not-paied';
				}
			} else{
				$class = 'paied';

			}

			$rs .= '<tr class="'.$class.'">
						<td>' . $payment_clt->num . '</td>
						<td>' . $payment_clt->dt . '</td>
						<td>' . $payment_clt->subject . '</td>
						<td>' . $payment_clt->invoice_ttc . '</td>
						<td>' . $payment_clt->total_paied * 1 . '</td>
						<td class="currency">' . number_format($payment_rest, 2, '.', ' ') . '</td>
					</tr>';
		}
		$array = [
			'total_invoices' => number_format($total_invoices, 2, '.', ' '),
			'total_paied' => number_format($total_paied, 2, '.', ' '),
			'total_rest' => number_format($total_rest, 2, '.', ' '),
			'invoices' => $rs
		];

		return json_encode($array);
	}

	public function delete(){
		if(isset($_POST['payment_id'])){
			$rs = $this->Payment_clt->delete($_POST['payment_id']);
			if($rs){
				return 1;
			} else {
				return 0;
			}
		}
	}

	public function add(){
		if(!empty($_POST)){
			$client_id = $_POST['box-infos-id'];
			$p_method_id = $_POST['p_method_id'];
			$p_ref = $_POST['p_ref'];
			$amount = $_POST['amount'];
			$payments = $this->Payment_clt->byClient($client_id);

			var_dump($payments);

			
			$sql = "INSERT INTO payments_clt (client_id, invoice_id, amount, p_method_id, p_ref) VALUES ";

			foreach ($payments as $payment) {
				$invoice_rest = $payment->invoice_ttc - $payment->total_paied;
				var_dump("amount = ".$amount);
				var_dump("invoice rest = ".$invoice_rest);
				if($invoice_rest > 0){
					if($invoice_rest >= $amount){
						var_dump("invoice rest >= ".$amount);
						$amountByInvoice = $amount;
						$amount = 0;
						$sql .= "({$client_id}, {$payment->id}, {$amountByInvoice}, {$p_method_id}, '{$p_ref}'),";
						break;
					} else {
						var_dump("invoice rest < ".$amount);

						$amountByInvoice = $invoice_rest;
						$amount -= $invoice_rest;
						$sql .= "({$client_id}, {$payment->id}, {$amountByInvoice}, {$p_method_id}, '{$p_ref}'),";
					}
					var_dump("amount = ".$amount);
				}
			}

			$sql = rtrim($sql, ',');

			$rs = $this->Payment_clt->query($sql, null, 'muti_insert');
			if($rs){
				$this->redirect('payment_clt/index');
			}
		}
		$payment_methods = $this->Payment_method->extract('id', 'pm_name');
		$form = new bootstrapForm($_POST);
		$this->render('payment_clt/edit', compact('form', 'payment_methods'));
	}
	public function edit(){
		$id = $_GET['id'];
		if(!empty($_POST)){
			$params = [
				'num' => $_POST['num'],
				'dt' => $_POST['dt'],
				'subject' => $_POST['subject'],
				'discr' => $_POST['discr'],
				'client_id' => $_POST['box-infos-id'],
				'created_by' => $this->User('id'),
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Payment_clt->update($id, $params);
			if($rs){
				$this->redirect('payment_clt/index');
			}
		}
		$payment = $this->Payment_clt->find($id);
		$form = new bootstrapForm($payment);
		$this->render('payment_clt/edit', compact('form', 'payment'));
	}

}