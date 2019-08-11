<?php
namespace App\Model;

use Core\Model\Model;

class Delivery_form_supplierModel extends Model
{
	protected $table = 'delivery_forms_supplier';
	public function load($filter = null){
		return $this->query('SELECT
				delivery_forms_supplier.*,
				suppliers.name as supplier_name

				FROM delivery_forms_supplier, suppliers

				WHERE delivery_forms_supplier.supplier_id = suppliers.id
				'.$filter.'
				');
	}
	public function bySupplier($supplier_id){
		return $this->query("SELECT
				delivery_forms_supplier.*,
				suppliers.name as supplier_name

				FROM delivery_forms_supplier, suppliers

				WHERE delivery_forms_supplier.supplier_id = suppliers.id
				AND suppliers.id = ? ",[$supplier_id]);
	}

	public function find($id){
		return $this->query("SELECT
				delivery_forms_supplier.*,
				suppliers.name as supplier_name,
				suppliers.city,
				suppliers.address

				FROM delivery_forms_supplier, suppliers

				WHERE delivery_forms_supplier.supplier_id = suppliers.id
				AND delivery_forms_supplier.id = ? ", [$id], true);
	}

	public function show($id){

	}

}