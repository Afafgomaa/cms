<?php
namespace App\Controller;

use Core\HTML\BootstrapForm;
use Core\Upload;


class Purchase_order_cltController extends AppController
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('Purchase_order_clt');
		$this->loadModel('Purchase_order_clt_art');
		$this->loadModel('Client');
	}

	public function index(){
		$purchase_orders_clt = $this->Purchase_order_clt->load();
		$form = new bootstrapForm($_POST);

		$this->render('purchase_order_clt/index', compact('form', 'purchase_orders_clt'));
	}

	public function delete(){
		if(isset($_POST['purchase_order_id'])){
			$rs = $this->Purchase_order_clt->delete($_POST['purchase_order_id']);
			if($rs){
				return 1;
			} else {
				return 0;
			}
		}
	}
	public function deleteArt(){
		if(isset($_POST['purchase_order_art_id'])){
			$rs = $this->Purchase_order_clt_art->delete($_POST['purchase_order_art_id']);
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
				'client_id' => $_POST['box-infos-id'],
				'created_by' => $this->User('id'),
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Purchase_order_clt->create($params);
			if($rs){
				$this->redirect('purchase_order_clt/index');
			}
		}
		$form = new bootstrapForm($_POST);
		$this->render('purchase_order_clt/edit', compact('form'));
	}
	public function addart(){
		$purchase_order_id = $_GET['id'];

		$purchase_order_clt = $this->Purchase_order_clt->find($purchase_order_id);

		if(!empty($_POST)){
			$params = [
				'purchase_order_clt_id' => $purchase_order_id,
				'art_id' => $_POST['art_id'],
				'qte' => $_POST['qte'],
				'price' => $_POST['price'],
				'created_by' => $this->User('id'),
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Purchase_order_clt_art->create($params);
			if($rs){
				$this->redirect('purchase_order_clt/articles/'.$purchase_order_id);
			}
		}
		$form = new bootstrapForm($_POST);
		$this->render('purchase_order_clt/addart', compact('form', 'purchase_order_clt'));
	}
	public function editart(){
		$purchase_order_id = $_GET['id'];
		$art_row_id = $_GET['art_row_id'];

		$purchase_order_clt = $this->Purchase_order_clt->find($purchase_order_id);

		if(!empty($_POST)){
			$params = [
				'qte' => $_POST['qte'],
				'price' => $_POST['price'],
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Purchase_order_clt_art->update($art_row_id, $params);
			if($rs){
				$this->redirect('purchase_order_clt/articles/'.$purchase_order_id);
			}
		}
		$purchase_order_clt_art = $this->Purchase_order_clt_art->find(['art_row_id' => $art_row_id, 'purchase_order_id' => $purchase_order_id]);
		$form = new bootstrapForm($purchase_order_clt_art);
		$this->render('purchase_order_clt/addart', compact('form', 'purchase_order_clt', 'purchase_order_clt_art'));
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

			$rs = $this->Purchase_order_clt->update($id, $params);
			if($rs){
				$this->redirect('purchase_order_clt/index');
			}
		}
		$purchase_order = $this->Purchase_order_clt->find($id);
		$form = new bootstrapForm($purchase_order);
		$this->render('purchase_order_clt/edit', compact('form', 'purchase_order'));
	}
	public function articles(){
		$id = $_GET['id'];
		$purchase_order_clt = $this->Purchase_order_clt->find($id);
		$purchase_order_clt_arts = $this->Purchase_order_clt_art->load($id);
		$totals = $this->Purchase_order_clt_art->totals($id);

		$this->render('purchase_order_clt/articles', compact('purchase_order_clt', 'purchase_order_clt_arts', 'totals'));
	}
	public function articlesByPurchase_orderCltId(){
		$purchase_order_clt_id = $_POST['purchase_order_clt_id'];
		$delivery_form_clt_id = $_POST['delivery_form_clt_id'];
		$purchase_order_clt_arts = $this->Purchase_order_clt_art->load($purchase_order_clt_id);
		if(!empty($purchase_order_clt_arts)){
			$delivery_form_clt = new Delivery_form_cltController();
			return $delivery_form_clt->saveImportedArticles($purchase_order_clt_arts, $delivery_form_clt_id);
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
		$purchase_order_clt = $this->Purchase_order_clt->find($id);
		$purchase_order_clt_arts = $this->Purchase_order_clt_art->load($id);
		$totals = $this->Purchase_order_clt_art->totals($id);
		$this->pdf('purchase_order_clt/printdetails', compact('purchase_order_clt', 'purchase_order_clt_arts', 'totals'));
	}
	public function modal(){
		$client_id = $_POST['client_id'];
		$purchase_orders_clt = $this->Purchase_order_clt->byClient($client_id);
		$rs = '';
		foreach($purchase_orders_clt as $purchase_order_clt) {
			$rs .= '<tr>
						<td class="table-actions">
							<a href="#" class="btn btn-success btn-xs btn-select-client" purchase_order_clt_id="' . $purchase_order_clt->id . '" onclick="selectPurchase_orderClt(this, event);">اختر</a>
						</td>
						<td class="purchase_order_num">' . $purchase_order_clt->num . '</td>
						<td class="purchase_order_dt">' . $purchase_order_clt->dt . '</td>
						<td class="purchase_order_client_name">' . $purchase_order_clt->client_name . '</td>
					</tr>';
		}
		return $rs;
	}

	public function saveImportedArticles($articles, $purchase_order_clt_id){
		$sql = "INSERT INTO purchase_orders_clt_arts
				(purchase_order_clt_id, art_id, qte, price, created_by , updated_by)
				VALUES ";
		foreach($articles as $art){
			$sql .= "({$purchase_order_clt_id},{$art->art_id},{$art->qte}, {$art->price}, {$this->User('id')}, {$this->User('id')} ),";
		}
		$sql = rtrim($sql, ',');
		$rs = $this->Purchase_order_clt_art->query($sql, null, 'muti_insert');
		if($rs){
			return 1;
		} else {
			return 0;
		}
	}
}