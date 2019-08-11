<?php
namespace App\Model;

use Core\Model\Model;

class Delivery_form_supplier_artModel extends Model
{
	protected $table = 'delivery_forms_supplier_arts';
	public function load($id){
		return $this->query('SELECT
				delivery_forms_supplier_arts.*,
				(delivery_forms_supplier_arts.qte * delivery_forms_supplier_arts.price) AS total,
				articles.ref,
				articles.desig,
				units.unit


				FROM delivery_forms_supplier, delivery_forms_supplier_arts, articles, units

				WHERE delivery_forms_supplier.id = delivery_forms_supplier_arts.delivery_form_supplier_id
				AND delivery_forms_supplier_arts.art_id = articles.id
				AND articles.unit_id = units.id
				AND delivery_forms_supplier.id = ?', [$id]);
	}
	public function totals($id){
		return $this->query('SELECT
				SUM((delivery_forms_supplier_arts.qte * delivery_forms_supplier_arts.price)) AS total_ht,
				(SUM(articles.tva) / count(delivery_forms_supplier_arts.id)) AS total_tva_rate,
				SUM(((delivery_forms_supplier_arts.qte * delivery_forms_supplier_arts.price)) * (articles.tva / 100)) AS total_tva,
				SUM((delivery_forms_supplier_arts.qte * delivery_forms_supplier_arts.price) + (((delivery_forms_supplier_arts.qte * delivery_forms_supplier_arts.price)) * (articles.tva / 100))) AS total_ttc



				FROM delivery_forms_supplier, delivery_forms_supplier_arts, articles

				WHERE delivery_forms_supplier.id = delivery_forms_supplier_arts.delivery_form_supplier_id
				AND delivery_forms_supplier_arts.art_id = articles.id
				AND delivery_forms_supplier.id = ?', [$id], true);
	}
	public function find($vars){
		return $this->query("SELECT
				delivery_forms_supplier_arts.*,
				(delivery_forms_supplier_arts.qte * delivery_forms_supplier_arts.price) total,
				articles.ref,
				articles.desig


				FROM delivery_forms_supplier, delivery_forms_supplier_arts, articles

				WHERE delivery_forms_supplier.id = delivery_forms_supplier_arts.delivery_form_supplier_id
				AND delivery_forms_supplier_arts.art_id = articles.id
				AND delivery_forms_supplier_arts.id = ?
				AND delivery_forms_supplier_arts.delivery_form_supplier_id = ?
				", [$vars['art_row_id'], $vars['delivery_form_id']], true);
	}

	public function show($id){

	}

}