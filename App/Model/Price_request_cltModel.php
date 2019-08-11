<?php
namespace App\Model;

use Core\Model\Model;

class Price_request_cltModel extends Model
{
	protected $table = 'prs_clt';
	public function load($filter = null){
		return $this->query('SELECT
				prs_clt.*,
				clients.name as client_name

				FROM prs_clt, clients

				WHERE prs_clt.client_id = clients.id
				'.$filter.'
				');
	}
	public function byClient($client_id){
		return $this->query("SELECT
				prs_clt.*,
				clients.name as client_name

				FROM prs_clt, clients

				WHERE prs_clt.client_id = clients.id
				AND clients.id = ? ",[$client_id]);
	}
	public function find($id){
		return $this->query("SELECT
				prs_clt.*,
				clients.name as client_name,
				clients.city,
				clients.address

				FROM prs_clt, clients

				WHERE prs_clt.client_id = clients.id
				AND prs_clt.id = ? ", [$id], true);
	}

	public function show($id){

	}

}