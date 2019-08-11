<?php
namespace App\Model;

use Core\Model\Model;

class StockModel extends Model
{
	protected $table = 'delivery_forms_supplier_arts';
	public function load(){
		return $this->query('SELECT
				delivery_forms_supplier_arts.*,
				(
				 (delivery_forms_supplier_arts.qte - COALESCE ((SELECT
					SUM(delivery_forms_clt_arts.qte)
					FROM delivery_forms_clt_arts
					WHERE delivery_forms_clt_arts.art_id = articles.id), 0)
				  )
				 * delivery_forms_supplier_arts.price) AS total,
				articles.ref,
				articles.desig,
				units.unit,
				delivery_forms_supplier_arts.qte as qte_in,
				COALESCE ((SELECT
					SUM(delivery_forms_clt_arts.qte)
					FROM delivery_forms_clt_arts
					WHERE delivery_forms_clt_arts.art_id = articles.id), 0)
				AS qte_out,
				(delivery_forms_supplier_arts.qte - COALESCE ((SELECT
					SUM(delivery_forms_clt_arts.qte)
					FROM delivery_forms_clt_arts
					WHERE delivery_forms_clt_arts.art_id = articles.id), 0) ) AS qte_stock


				FROM delivery_forms_supplier, delivery_forms_supplier_arts, articles, units

				WHERE delivery_forms_supplier.id = delivery_forms_supplier_arts.delivery_form_supplier_id
				AND delivery_forms_supplier_arts.art_id = articles.id
				AND articles.unit_id = units.id');
	}

	public function totals(){
		return $this->query('SELECT
				SUM((
				 (delivery_forms_supplier_arts.qte - COALESCE ((SELECT
					SUM(delivery_forms_clt_arts.qte)
					FROM delivery_forms_clt_arts
					WHERE delivery_forms_clt_arts.art_id = articles.id), 0)
				  )
				 * delivery_forms_supplier_arts.price)) AS total_ht,
				(SUM(articles.tva) / count(delivery_forms_supplier_arts.id)) AS total_tva_rate,
				SUM(((
				 (delivery_forms_supplier_arts.qte - COALESCE ((SELECT
					SUM(delivery_forms_clt_arts.qte)
					FROM delivery_forms_clt_arts
					WHERE delivery_forms_clt_arts.art_id = articles.id), 0)
				  )
				 * delivery_forms_supplier_arts.price)) * (articles.tva / 100)) AS total_tva,
				SUM((
				 (delivery_forms_supplier_arts.qte - COALESCE ((SELECT
					SUM(delivery_forms_clt_arts.qte)
					FROM delivery_forms_clt_arts
					WHERE delivery_forms_clt_arts.art_id = articles.id), 0)
				  )
				 * delivery_forms_supplier_arts.price) + (((
				  (delivery_forms_supplier_arts.qte - COALESCE ((SELECT
					SUM(delivery_forms_clt_arts.qte)
					FROM delivery_forms_clt_arts
					WHERE delivery_forms_clt_arts.art_id = articles.id), 0)
				  )
				  * delivery_forms_supplier_arts.price)) * (articles.tva / 100))) AS total_ttc



				FROM delivery_forms_supplier, delivery_forms_supplier_arts, articles

				WHERE delivery_forms_supplier.id = delivery_forms_supplier_arts.delivery_form_supplier_id
				AND delivery_forms_supplier_arts.art_id = articles.id ', null, true);
	}

}