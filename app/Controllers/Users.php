<?php namespace App\Controllers;
use App\Models\UserModel;
class Users extends BaseController
{
	// set login
	public function index()
	{
		helper(['form']);
		$data = [];
		if($this->request->getMethod() == "post"){
			$rules = [
				'email' => 'required|valid_email',
				'password' => 'required|validateUser[email,password]'
			];
			$error = [
				'password' => [
					'validateUser' => 'email or password not match!'
				]
			];
			if(!$this->validate($rules,$error)){
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();
				$user = $model->where('email',$this->request->getVar('email'))
							  ->first();
				$this->setUserSession($user);
				// direct to rout dashboard
				return redirect()->to('/dashboard');
			}

		}
		return view('auths/login',$data);
	}

	public function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'address' => $user['address'],
			'email' => $user['email'],
			'role' => $user['role'],
			'isLoggedIn' => true
		];

		session()->set($data);
		return true;
	}	

// register before login
	public function register()
	{
		helper(['form']);

		$data = [];

		if($this->request->getMethod() == "post"){
			$rules = [
				'email' => 'required|valid_email',
				'password' => 'required',
				'address' => 'required',
			];
			if(!$this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$newData = [
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'address' => $this->request->getVar('address'),
					'role' => $this->request->getVar('role'),
				];

				$model->createUsers($newData);
				// message tell user
				$session = session();
				$session->setFlashdata('success','successful Register');
				return redirect()->to('/');
			}

		}
		
		return view('auths/register',$data);
	}
	// logout
	public function logout(){
		session()->destroy();
		return redirect()->to('/');
	}

}
