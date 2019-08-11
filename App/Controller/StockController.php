<?php
namespace App\Controller;

use Core\HTML\BootstrapForm;
use Core\Upload;


class StockController extends AppController
{
	public function __construct()
	{
		parent::__construct();
		$this->loadModel('Stock');

	}

	public function index(){
		$stocks = $this->Stock->load();
		$totals = $this->Stock->totals();
		$this->render('stock/index', compact('stocks', 'totals'));
	}


}