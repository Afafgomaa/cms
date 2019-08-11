<?php
namespace App\Model;

use Core\Model\Model;

class Payment_cltModel extends Model
{
	protected $table = 'payments_clt';
	public function load($filter = null){
		return $this->query('SELECT
				invoices_clt.*,
				clients.name as client_name,

				(SELECT SUM((invoices_clt_arts.qte * invoices_clt_arts.price) + (((invoices_clt_arts.qte * invoices_clt_arts.price)) * (articles.tva / 100)))
				FROM invoices_clt_arts, articles
				WHERE invoices_clt.id = invoices_clt_arts.invoice_clt_id
				AND invoices_clt_arts.art_id = articles.id
				) AS invoice_ttc,

				(SELECT SUM(payments_clt.amount)
					FROM payments_clt
					WHERE invoices_clt.id = payments_clt.invoice_id
				) as total_paied



				FROM invoices_clt, clients

				WHERE invoices_clt.client_id = clients.id
				'.$filter.'
				');
	}
	public function byClient($client_id){
		return $this->query('SELECT
				invoices_clt.*,
				clients.name as client_name,

				(SELECT SUM((invoices_clt_arts.qte * invoices_clt_arts.price) + (((invoices_clt_arts.qte * invoices_clt_arts.price)) * (articles.tva / 100)))
				FROM invoices_clt_arts, articles
				WHERE invoices_clt.id = invoices_clt_arts.invoice_clt_id
				AND invoices_clt_arts.art_id = articles.id
				) AS invoice_ttc,

				COALESCE((SELECT SUM(payments_clt.amount)
					FROM payments_clt
					WHERE invoices_clt.id = payments_clt.invoice_id
				), 0) as total_paied



				FROM invoices_clt, clients

				WHERE invoices_clt.client_id = clients.id
				AND ((SELECT SUM((invoices_clt_arts.qte * invoices_clt_arts.price) + (((invoices_clt_arts.qte * invoices_clt_arts.price)) * (articles.tva / 100)))
				FROM invoices_clt_arts, articles
				WHERE invoices_clt.id = invoices_clt_arts.invoice_clt_id
				AND invoices_clt_arts.art_id = articles.id
				) > COALESCE((SELECT SUM(payments_clt.amount)
					FROM payments_clt
					WHERE invoices_clt.id = payments_clt.invoice_id
				), 0))
				AND clients.id = ?', [$client_id]);
	}

	public function byInvoice($invoice_id){
		return $this->query("SELECT
				payments_clt.*,
				payment_methods.pm_name

				FROM payments_clt, payment_methods
				WHERE payments_clt.p_method_id = payment_methods.id
				AND invoice_id = ? ",[$invoice_id]);
	}

	public function find($invoice_id){
		return $this->query("SELECT
				invoices_clt.*,
				clients.name as client_name,

				(SELECT SUM((invoices_clt_arts.qte * invoices_clt_arts.price) + (((invoices_clt_arts.qte * invoices_clt_arts.price)) * (articles.tva / 100)))
				FROM invoices_clt_arts, articles
				WHERE invoices_clt.id = invoices_clt_arts.invoice_clt_id
				AND invoices_clt_arts.art_id = articles.id
				) AS invoice_ttc,

				(SELECT SUM(payments_clt.amount)
					FROM payments_clt
					WHERE invoices_clt.id = payments_clt.invoice_id
				) as total_paied



				FROM invoices_clt, clients

				WHERE invoices_clt.client_id = clients.id
				AND invoices_clt.id = ? ", [$invoice_id], true);
	}


}