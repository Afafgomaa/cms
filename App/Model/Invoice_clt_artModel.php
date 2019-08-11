<?php
namespace App\Model;

use Core\Model\Model;

class Invoice_clt_artModel extends Model
{
	protected $table = 'invoices_clt_arts';
	public function load($id){
		return $this->query('SELECT
				invoices_clt_arts.*,
				(invoices_clt_arts.qte * invoices_clt_arts.price) AS total,
				articles.ref,
				articles.desig,
				units.unit


				FROM invoices_clt, invoices_clt_arts, articles, units

				WHERE invoices_clt.id = invoices_clt_arts.invoice_clt_id
				AND invoices_clt_arts.art_id = articles.id
				AND articles.unit_id = units.id
				AND invoices_clt.id = ?', [$id]);
	}
	public function totals($id){
		return $this->query('SELECT
				SUM((invoices_clt_arts.qte * invoices_clt_arts.price)) AS total_ht,
				(SUM(articles.tva) / count(invoices_clt_arts.id)) AS total_tva_rate,
				SUM(((invoices_clt_arts.qte * invoices_clt_arts.price)) * (articles.tva / 100)) AS total_tva,
				SUM((invoices_clt_arts.qte * invoices_clt_arts.price) + (((invoices_clt_arts.qte * invoices_clt_arts.price)) * (articles.tva / 100))) AS total_ttc



				FROM invoices_clt, invoices_clt_arts, articles

				WHERE invoices_clt.id = invoices_clt_arts.invoice_clt_id
				AND invoices_clt_arts.art_id = articles.id
				AND invoices_clt.id = ?', [$id], true);
	}
	public function find($vars){
		return $this->query("SELECT
				invoices_clt_arts.*,
				(invoices_clt_arts.qte * invoices_clt_arts.price) total,
				articles.ref,
				articles.desig


				FROM invoices_clt, invoices_clt_arts, articles

				WHERE invoices_clt.id = invoices_clt_arts.invoice_clt_id
				AND invoices_clt_arts.art_id = articles.id
				AND invoices_clt_arts.id = ?
				AND invoices_clt_arts.invoice_clt_id = ?
				", [$vars['art_row_id'], $vars['invoice_id']], true);
	}

	public function show($id){

	}

}