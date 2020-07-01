<?php
namespace App\Models;
use CodeIgniter\Model;

class PizzaModel extends Model{
    protected $table = "tb_pizza";
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = ['name','ingredients','prize'];
    public function createPizza($pizzaInfo){
        $this->insert([
            'name' => $pizzaInfo['name'],
            'ingredients' => $pizzaInfo['ingredients'],
            'prize' => $pizzaInfo['prize'],
        ]);
    }
}
