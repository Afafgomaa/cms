<?php
namespace App\Controller;

use Core\HTML\BootstrapForm;
use Core\Upload;


class Invoice_cltController extends AppController
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('Invoice_clt');
		$this->loadModel('Invoice_clt_art');
		$this->loadModel('Client');
	}

	public function index(){
		$invoices_clt = $this->Invoice_clt->load();
		$form = new bootstrapForm($_POST);

		$this->render('invoice_clt/index', compact('form', 'invoices_clt'));
	}

	public function delete(){
		if(isset($_POST['invoice_id'])){
			$rs = $this->Invoice_clt->delete($_POST['invoice_id']);
			if($rs){
				return 1;
			} else {
				return 0;
			}
		}
	}
	public function deleteArt(){
		if(isset($_POST['invoice_art_id'])){
			$rs = $this->Invoice_clt_art->delete($_POST['invoice_art_id']);
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

			$rs = $this->Invoice_clt->create($params);
			if($rs){
				$this->redirect('invoice_clt/index');
			}
		}
		$form = new bootstrapForm($_POST);
		$this->render('invoice_clt/edit', compact('form'));
	}
	public function addart(){
		$invoice_id = $_GET['id'];

		$invoice_clt = $this->Invoice_clt->find($invoice_id);

		if(!empty($_POST)){
			$params = [
				'invoice_clt_id' => $invoice_id,
				'art_id' => $_POST['art_id'],
				'qte' => $_POST['qte'],
				'price' => $_POST['price'],
				'created_by' => $this->User('id'),
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Invoice_clt_art->create($params);
			if($rs){
				$this->redirect('invoice_clt/articles/'.$invoice_id);
			}
		}
		$form = new bootstrapForm($_POST);
		$this->render('invoice_clt/addart', compact('form', 'invoice_clt'));
	}
	public function editart(){
		$invoice_id = $_GET['id'];
		$art_row_id = $_GET['art_row_id'];

		$invoice_clt = $this->Invoice_clt->find($invoice_id);

		if(!empty($_POST)){
			$params = [
				'qte' => $_POST['qte'],
				'price' => $_POST['price'],
				'updated_by' =>$this->User('id')
			];

			$rs = $this->Invoice_clt_art->update($art_row_id, $params);
			if($rs){
				$this->redirect('invoice_clt/articles/'.$invoice_id);
			}
		}
		$invoice_clt_art = $this->Invoice_clt_art->find(['art_row_id' => $art_row_id, 'invoice_id' => $invoice_id]);
		$form = new bootstrapForm($invoice_clt_art);
		$this->render('invoice_clt/addart', compact('form', 'invoice_clt', 'invoice_clt_art'));
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

			$rs = $this->Invoice_clt->update($id, $params);
			if($rs){
				$this->redirect('invoice_clt/index');
			}
		}
		$invoice = $this->Invoice_clt->find($id);
		$form = new bootstrapForm($invoice);
		$this->render('invoice_clt/edit', compact('form', 'invoice'));
	}
	public function articles(){
		$id = $_GET['id'];
		$invoice_clt = $this->Invoice_clt->find($id);
		$invoice_clt_arts = $this->Invoice_clt_art->load($id);
		$totals = $this->Invoice_clt_art->totals($id);

		$this->render('invoice_clt/articles', compact('invoice_clt', 'invoice_clt_arts', 'totals'));
	}
	public function show(){
		$id = $_GET['id'];
		$article = $this->Article->find($id);
		$this->render('articles/show', compact('article'));
	}
	public function printdetails(){
		$id = $_GET['id'];
		$invoice_clt = $this->Invoice_clt->find($id);
		$invoice_clt_arts = $this->Invoice_clt_art->load($id);
		$totals = $this->Invoice_clt_art->totals($id);
		$this->pdf('invoice_clt/printdetails', compact('invoice_clt', 'invoice_clt_arts', 'totals'));
	}

	public function saveImportedArticles($articles, $invoice_clt_id){
		$sql = "INSERT INTO invoices_clt_arts
				(invoice_clt_id, art_id, qte, price, created_by , updated_by)
				VALUES ";
		foreach($articles as $art){
			$sql .= "({$invoice_clt_id},{$art->art_id},{$art->qte}, {$art->price}, {$this->User('id')}, {$this->User('id')} ),";
		}
		$sql = rtrim($sql, ',');
		$rs = $this->Invoice_clt_art->query($sql, null, 'muti_insert');
		if($rs){
			return 1;
		} else {
			return 0;
		}
	}
}