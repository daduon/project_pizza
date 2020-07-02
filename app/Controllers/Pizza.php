<?php namespace App\Controllers;
use App\Models\PizzaModel;
class Pizza extends BaseController
{
	// show list pizza
	public function index()
	{
		$model = new PizzaModel();
		$data['dataPizza'] = $model->findAll();
		return view('index',$data);
	}

	// add new pizza
	public function addPizza()
	{	
		helper(['form']);
		if($this->request->getMethod() == "post"){

			$model = new PizzaModel();
			$name = $this->request->getVar('name');
			$ingredients = $this->request->getVar('ingredients');
			$prize = $this->request->getVar('prize');
			$newData = [
				'name' => $name,
				'ingredients' => $ingredients,
				'prize' => $prize
			];
			$model->createPizza($newData);
			return redirect()->to('/dashboard');

		}
	}

	// delete pizza
	public function deletePizza($id)
	{
		$model = new PizzaModel();
		$model->find($id);
		$delete = $model->delete($id);
		return redirect()->to('/dashboard');
	}

	// edit pizza

	public function editPizza($id)
	{
		$model = new PizzaModel();
		$data['edit'] = $model->find($id);
		return view('index',$data);
	}

	public function updatePizza()
    {
		helper(['form']);
		if($this->request->getMethod() == "post"){

			$model = new PizzaModel();
			$id = $this->request->getVar('id');
			$name = $this->request->getVar('name');
			$ingredients = $this->request->getVar('ingredients');
			$prize = $this->request->getVar('prize');
		
			$newData = array(
				'name'=>$name,
				'ingredients'=>$ingredients,
				'prize'=>$prize
			);
				
			$model->update($id,$newData);
			return redirect()->to('/dashboard');
		}

	}
}
