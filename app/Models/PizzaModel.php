<?php
namespace App\Models;
use CodeIgniter\Model;

class PizzaModel extends Model{
    protected $table = "pizza_info";
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = ['name','ingredients','prize'];
    public function createPizza($suerInfo){
        $this->insert([
            'name' => $suerInfo['name'],
            'ingredients' => $suerInfo['ingredients'],
            'prize' => $suerInfo['prize'],
        ]);
    }
}
