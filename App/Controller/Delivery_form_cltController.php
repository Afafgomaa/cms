<?php
namespace App\Controller;

use Core\HTML\BootstrapForm;
use Core\Upload;


class Delivery_form_cltController extends AppController
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('Delivery_form_clt');
		$this->loadModel('Delivery_form_clt_art');
		$this->loadModel('Client');
	}

	public function index(){
		$delivery_forms_clt = $this->Delivery_form_clt->load();
		$form = new bootstrapForm($_POST);

		$this->render('delivery_form_clt/index', compact('form', 'delivery_forms_clt'));
	}

	public function delete(){
		if(isset($_POST['delivery_form_id'])){
			$rs = $this->Delivery_form_clt->delete($_POST['delivery_form_id']);
			if($rs){
				return 1;
			} else {
				return 0;
			}
		}
	}
	public function deleteArt(){
		if(isset($_POST['delivery_form_art_id'])){
			$rs = $this->Delivery_form_clt_art->delete($_POST['delivery_form_art_id']);
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

			$rs = $this->Delivery_form_clt->create($params);
			if($rs){
				$this->redirect('delivery_form_clt/index');
			}
		}
		$form = new bootstrapForm($_POST);
		$this->render('delivery_form_clt/edit', compact('form'));
	}
	public function addart(){
		$delivery_form_id = $_GET['id'];

		$delivery_form_clt = $this->Delivery_form_clt->find($delivery_form_id);

		if(!empty($_POST)){
			$params = [
				'delivery_form_clt_id' => $delivery_form_id,
				'art_id' => $_POST['art_id'],
				'qte' => $_POST['qte'],
				'price' => $_POST['price'],
				'created_by' => $this->User('id'),
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Delivery_form_clt_art->create($params);
			if($rs){
				$this->redirect('delivery_form_clt/articles/'.$delivery_form_id);
			}
		}
		$form = new bootstrapForm($_POST);
		$this->render('delivery_form_clt/addart', compact('form', 'delivery_form_clt'));
	}
	public function editart(){
		$delivery_form_id = $_GET['id'];
		$art_row_id = $_GET['art_row_id'];

		$delivery_form_clt = $this->Delivery_form_clt->find($delivery_form_id);

		if(!empty($_POST)){
			$params = [
				'qte' => $_POST['qte'],
				'price' => $_POST['price'],
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Delivery_form_clt_art->update($art_row_id, $params);
			if($rs){
				$this->redirect('delivery_form_clt/articles/'.$delivery_form_id);
			}
		}
		$delivery_form_clt_art = $this->Delivery_form_clt_art->find(['art_row_id' => $art_row_id, 'delivery_form_id' => $delivery_form_id]);
		$form = new bootstrapForm($delivery_form_clt_art);
		$this->render('delivery_form_clt/addart', compact('form', 'delivery_form_clt', 'delivery_form_clt_art'));
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

			$rs = $this->Delivery_form_clt->update($id, $params);
			if($rs){
				$this->redirect('delivery_form_clt/index');
			}
		}
		$delivery_form = $this->Delivery_form_clt->find($id);
		$form = new bootstrapForm($delivery_form);
		$this->render('delivery_form_clt/edit', compact('form', 'delivery_form'));
	}
	public function articles(){
		$id = $_GET['id'];
		$delivery_form_clt = $this->Delivery_form_clt->find($id);
		$delivery_form_clt_arts = $this->Delivery_form_clt_art->load($id);
		$totals = $this->Delivery_form_clt_art->totals($id);

		$this->render('delivery_form_clt/articles', compact('delivery_form_clt', 'delivery_form_clt_arts', 'totals'));
	}
	public function articlesByDelivery_formCltId(){
		$delivery_form_clt_id = $_POST['delivery_form_clt_id'];
		$invoice_clt_id = $_POST['invoice_clt_id'];
		$delivery_form_clt_arts = $this->Delivery_form_clt_art->load($delivery_form_clt_id);
		if(!empty($delivery_form_clt_arts)){
			$invoice_clt = new Invoice_cltController();
			return $invoice_clt->saveImportedArticles($delivery_form_clt_arts, $invoice_clt_id);
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
		$delivery_form_clt = $this->Delivery_form_clt->find($id);
		$delivery_form_clt_arts = $this->Delivery_form_clt_art->load($id);
		$totals = $this->Delivery_form_clt_art->totals($id);
		$this->pdf('delivery_form_clt/printdetails', compact('delivery_form_clt', 'delivery_form_clt_arts', 'totals'));
	}
	public function modal(){
		$client_id = $_POST['client_id'];
		$delivery_froms_clt = $this->Delivery_form_clt->byClient($client_id);
		$rs = '';
		foreach($delivery_froms_clt as $delivery_from_clt) {
			$rs .= '<tr>
						<td class="table-actions">
							<a href="#" class="btn btn-success btn-xs btn-select-client" delivery_form_clt_id="' . $delivery_from_clt->id . '" onclick="selectDelivery_formClt(this, event);">اختر</a>
						</td>
						<td class="delivery_from_num">' . $delivery_from_clt->num . '</td>
						<td class="delivery_from_dt">' . $delivery_from_clt->dt . '</td>
						<td class="delivery_from_client_name">' . $delivery_from_clt->client_name . '</td>
					</tr>';
		}
		return $rs;
	}

	public function saveImportedArticles($articles, $delivery_form_clt_id){
		$sql = "INSERT INTO delivery_forms_clt_arts
				(delivery_form_clt_id, art_id, qte, price, created_by , updated_by)
				VALUES ";
		foreach($articles as $art){
			$sql .= "({$delivery_form_clt_id},{$art->art_id},{$art->qte}, {$art->price}, {$this->User('id')}, {$this->User('id')} ),";
		}
		$sql = rtrim($sql, ',');
		$rs = $this->Delivery_form_clt_art->query($sql, null, 'muti_insert');
		if($rs){
			return 1;
		} else {
			return 0;
		}
	}
}