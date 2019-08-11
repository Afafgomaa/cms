<?php
namespace App\Model;

use Core\Model\Model;

class Purchase_order_clt_artModel extends Model
{
	protected $table = 'purchase_orders_clt_arts';
	public function load($id){
		return $this->query('SELECT
				purchase_orders_clt_arts.*,
				(purchase_orders_clt_arts.qte * purchase_orders_clt_arts.price) AS total,
				articles.ref,
				articles.desig


				FROM purchase_orders_clt, purchase_orders_clt_arts, articles

				WHERE purchase_orders_clt.id = purchase_orders_clt_arts.purchase_order_clt_id
				AND purchase_orders_clt_arts.art_id = articles.id
				AND purchase_orders_clt.id = ?', [$id]);
	}
	public function totals($id){
		return $this->query('SELECT
				SUM((purchase_orders_clt_arts.qte * purchase_orders_clt_arts.price)) AS total_ht,
				(SUM(articles.tva) / count(purchase_orders_clt_arts.id)) AS total_tva_rate,
				SUM(((purchase_orders_clt_arts.qte * purchase_orders_clt_arts.price)) * (articles.tva / 100)) AS total_tva,
				SUM((purchase_orders_clt_arts.qte * purchase_orders_clt_arts.price) + (((purchase_orders_clt_arts.qte * purchase_orders_clt_arts.price)) * (articles.tva / 100))) AS total_ttc



				FROM purchase_orders_clt, purchase_orders_clt_arts, articles

				WHERE purchase_orders_clt.id = purchase_orders_clt_arts.purchase_order_clt_id
				AND purchase_orders_clt_arts.art_id = articles.id
				AND purchase_orders_clt.id = ?', [$id], true);
	}
	public function find($vars){
		return $this->query("SELECT
				purchase_orders_clt_arts.*,
				(purchase_orders_clt_arts.qte * purchase_orders_clt_arts.price) total,
				articles.ref,
				articles.desig


				FROM purchase_orders_clt, purchase_orders_clt_arts, articles

				WHERE purchase_orders_clt.id = purchase_orders_clt_arts.purchase_order_clt_id
				AND purchase_orders_clt_arts.art_id = articles.id
				AND purchase_orders_clt_arts.id = ?
				AND purchase_orders_clt_arts.purchase_order_clt_id = ?
				", [$vars['art_row_id'], $vars['purchase_order_id']], true);
	}

	public function show($id){

	}

}