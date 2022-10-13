<?php  
namespace App\ServiceRepository\Services;

use App\ServiceRepository\Repositories\AuthRepository; 

Class AuthService {

    public function __construct()
    {
        $this->AuthRepository = new AuthRepository();
    }
    public function addUser($data){
        $data['password'] = bcrypt($data['password']);
        return $this->AuthRepository->createUser($data);
    }
}