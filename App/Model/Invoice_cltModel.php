<?php
namespace App\Model;

use Core\Model\Model;

class Invoice_cltModel extends Model
{
	protected $table = 'invoices_clt';
	public function load($filter = null){
		return $this->query('SELECT
				invoices_clt.*,
				clients.name as client_name

				FROM invoices_clt, clients

				WHERE invoices_clt.client_id = clients.id
				'.$filter.'
				');
	}
	public function find($id){
		return $this->query("SELECT
				invoices_clt.*,
				clients.name as client_name,
				clients.city,
				clients.address

				FROM invoices_clt, clients

				WHERE invoices_clt.client_id = clients.id
				AND invoices_clt.id = ? ", [$id], true);
	}

	public function show($id){

	}

}