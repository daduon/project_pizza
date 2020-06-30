<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = "users";
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = ['email','password','address','role'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    public function createUsers($suerInfo){
        $this->insert([
            'email' => $suerInfo['email'],
            'password' => $suerInfo['password'],
            'address' => $suerInfo['address'],
            'role' => $suerInfo['role'],
        ]);
    }

    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function passwordHash(array $data){
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'],PASSWORD_DEFAULT);
        }
        return $data;
    }





}
