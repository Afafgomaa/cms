<?php
namespace App\Model;

use Core\Model\Model;

class Purchase_order_cltModel extends Model
{
	protected $table = 'purchase_orders_clt';
	public function load($filter = null){
		return $this->query('SELECT
				purchase_orders_clt.*,
				clients.name as client_name

				FROM purchase_orders_clt, clients

				WHERE purchase_orders_clt.client_id = clients.id
				'.$filter.'
				');
	}
	public function byClient($client_id){
		return $this->query("SELECT
				purchase_orders_clt.*,
				clients.name as client_name

				FROM purchase_orders_clt, clients

				WHERE purchase_orders_clt.client_id = clients.id
				AND clients.id = ? ",[$client_id]);
	}

	public function find($id){
		return $this->query("SELECT
				purchase_orders_clt.*,
				clients.name as client_name,
				clients.city,
				clients.address

				FROM purchase_orders_clt, clients

				WHERE purchase_orders_clt.client_id = clients.id
				AND purchase_orders_clt.id = ? ", [$id], true);
	}

	public function show($id){

	}

}