<?php
namespace App\Model;

use Core\Model\Model;

class Delivery_form_cltModel extends Model
{
	protected $table = 'delivery_forms_clt';
	public function load($filter = null){
		return $this->query('SELECT
				delivery_forms_clt.*,
				clients.name as client_name

				FROM delivery_forms_clt, clients

				WHERE delivery_forms_clt.client_id = clients.id
				'.$filter.'
				');
	}
	public function byClient($client_id){
		return $this->query("SELECT
				delivery_forms_clt.*,
				clients.name as client_name

				FROM delivery_forms_clt, clients

				WHERE delivery_forms_clt.client_id = clients.id
				AND clients.id = ? ",[$client_id]);
	}

	public function find($id){
		return $this->query("SELECT
				delivery_forms_clt.*,
				clients.name as client_name,
				clients.city,
				clients.address

				FROM delivery_forms_clt, clients

				WHERE delivery_forms_clt.client_id = clients.id
				AND delivery_forms_clt.id = ? ", [$id], true);
	}

	public function show($id){

	}

}