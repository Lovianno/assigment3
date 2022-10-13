<?php  
namespace App\ServiceRepository\Repositories;
use App\Models\User;

Class AuthRepository {

    public function __construct()
    {
        $this->User = new User();
    }

        public function createUser($data){
            return User::create($data);
        }
}