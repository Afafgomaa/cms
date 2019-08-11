<?php
namespace App\Controller;

use Core\HTML\BootstrapForm;
use Core\Upload;


class Delivery_form_supplierController extends AppController
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('Delivery_form_supplier');
		$this->loadModel('Delivery_form_supplier_art');
		$this->loadModel('Supplier');
	}

	public function index(){
		$delivery_forms_supplier = $this->Delivery_form_supplier->load();
		$form = new bootstrapForm($_POST);

		$this->render('delivery_form_supplier/index', compact('form', 'delivery_forms_supplier'));
	}

	public function delete(){
		if(isset($_POST['delivery_form_id'])){
			$rs = $this->Delivery_form_supplier->delete($_POST['delivery_form_id']);
			if($rs){
				return 1;
			} else {
				return 0;
			}
		}
	}
	public function deleteArt(){
		if(isset($_POST['delivery_form_art_id'])){
			$rs = $this->Delivery_form_supplier_art->delete($_POST['delivery_form_art_id']);
			if($rs){
				return 1;
			} else {
				return 0;
			}
		}
	}

	public function add(){
		if(!empty($_POST)){
			$params = [
				'num' => $_POST['num'],
				'dt' => $_POST['dt'],
				'subject' => $_POST['subject'],
				'discr' => $_POST['discr'],
				'supplier_id' => $_POST['box-infos-id'],
				'created_by' => $this->User('id'),
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Delivery_form_supplier->create($params);
			if($rs){
				$this->redirect('delivery_form_supplier/index');
			}
		}
		$form = new bootstrapForm($_POST);
		$this->render('delivery_form_supplier/edit', compact('form'));
	}
	public function addart(){
		$delivery_form_id = $_GET['id'];

		$delivery_form_supplier = $this->Delivery_form_supplier->find($delivery_form_id);

		if(!empty($_POST)){
			$params = [
				'delivery_form_supplier_id' => $delivery_form_id,
				'art_id' => $_POST['art_id'],
				'qte' => $_POST['qte'],
				'price' => $_POST['price'],
				'created_by' => $this->User('id'),
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Delivery_form_supplier_art->create($params);
			if($rs){
				$this->redirect('delivery_form_supplier/articles/'.$delivery_form_id);
			}
		}
		$form = new bootstrapForm($_POST);
		$this->render('delivery_form_supplier/addart', compact('form', 'delivery_form_supplier'));
	}
	public function editart(){
		$delivery_form_id = $_GET['id'];
		$art_row_id = $_GET['art_row_id'];

		$delivery_form_supplier = $this->Delivery_form_supplier->find($delivery_form_id);

		if(!empty($_POST)){
			$params = [
				'qte' => $_POST['qte'],
				'price' => $_POST['price'],
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Delivery_form_supplier_art->update($art_row_id, $params);
			if($rs){
				$this->redirect('delivery_form_supplier/articles/'.$delivery_form_id);
			}
		}
		$delivery_form_supplier_art = $this->Delivery_form_supplier_art->find(['art_row_id' => $art_row_id, 'delivery_form_id' => $delivery_form_id]);
		$form = new bootstrapForm($delivery_form_supplier_art);
		$this->render('delivery_form_supplier/addart', compact('form', 'delivery_form_supplier', 'delivery_form_supplier_art'));
	}
	public function edit(){
		$id = $_GET['id'];
		if(!empty($_POST)){
			$params = [
				'num' => $_POST['num'],
				'dt' => $_POST['dt'],
				'subject' => $_POST['subject'],
				'discr' => $_POST['discr'],
				'supplier_id' => $_POST['box-infos-id'],
				'created_by' => $this->User('id'),
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Delivery_form_supplier->update($id, $params);
			if($rs){
				$this->redirect('delivery_form_supplier/index');
			}
		}
		$delivery_form = $this->Delivery_form_supplier->find($id);
		$form = new bootstrapForm($delivery_form);
		$this->render('delivery_form_supplier/edit', compact('form', 'delivery_form'));
	}
	public function articles(){
		$id = $_GET['id'];
		$delivery_form_supplier = $this->Delivery_form_supplier->find($id);
		$delivery_form_supplier_arts = $this->Delivery_form_supplier_art->load($id);
		$totals = $this->Delivery_form_supplier_art->totals($id);

		$this->render('delivery_form_supplier/articles', compact('delivery_form_supplier', 'delivery_form_supplier_arts', 'totals'));
	}
	public function articlesByDelivery_formSupplierId(){
		$delivery_form_supplier_id = $_POST['delivery_form_supplier_id'];
		$invoice_supplier_id = $_POST['invoice_supplier_id'];
		$delivery_form_supplier_arts = $this->Delivery_form_supplier_art->load($delivery_form_supplier_id);
		if(!empty($delivery_form_supplier_arts)){
			$invoice_supplier = new Invoice_supplierController();
			return $invoice_supplier->saveImportedArticles($delivery_form_supplier_arts, $invoice_supplier_id);
		}
		else{
			return "لا توجد منتجات.";
		}

	}

	public function show(){
		$id = $_GET['id'];
		$article = $this->Article->find($id);
		$this->render('articles/show', compact('article'));
	}
	public function printdetails(){
		$id = $_GET['id'];
		$delivery_form_supplier = $this->Delivery_form_supplier->find($id);
		$delivery_form_supplier_arts = $this->Delivery_form_supplier_art->load($id);
		$totals = $this->Delivery_form_supplier_art->totals($id);
		$this->pdf('delivery_form_supplier/printdetails', compact('delivery_form_supplier', 'delivery_form_supplier_arts', 'totals'));
	}
	public function modal(){
		$supplier_id = $_POST['supplier_id'];
		$delivery_froms_supplier = $this->Delivery_form_supplier->bySupplier($supplier_id);
		$rs = '';
		foreach($delivery_froms_supplier as $delivery_from_supplier) {
			$rs .= '<tr>
						<td class="table-actions">
							<a href="#" class="btn btn-success btn-xs btn-select-supplier" delivery_form_supplier_id="' . $delivery_from_supplier->id . '" onclick="selectDelivery_formSupplier(this, event);">اختر</a>
						</td>
						<td class="delivery_from_num">' . $delivery_from_supplier->num . '</td>
						<td class="delivery_from_dt">' . $delivery_from_supplier->dt . '</td>
						<td class="delivery_from_supplier_name">' . $delivery_from_supplier->supplier_name . '</td>
					</tr>';
		}
		return $rs;
	}

	public function saveImportedArticles($articles, $delivery_form_supplier_id){
		$sql = "INSERT INTO delivery_forms_supplier_arts
				(delivery_form_supplier_id, art_id, qte, price, created_by , updated_by)
				VALUES ";
		foreach($articles as $art){
			$sql .= "({$delivery_form_supplier_id},{$art->art_id},{$art->qte}, {$art->price}, {$this->User('id')}, {$this->User('id')} ),";
		}
		$sql = rtrim($sql, ',');
		$rs = $this->Delivery_form_supplier_art->query($sql, null, 'muti_insert');
		if($rs){
			return 1;
		} else {
			return 0;
		}
	}
}