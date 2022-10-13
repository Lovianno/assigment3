<?php  
namespace App\ServiceRepository\Services;

use App\ServiceRepository\Repositories\TodoRepository;

Class TodoService {

    public function __construct()
    {
        $this->TodoRepository = new TodoRepository();
    }
    // public function getById($id){
    //     return $this->TodoRepository->getById($id);
    // }
    public function getById($id){
		$task = $this->TodoRepository->getById($id);
        return $task;
    }
    public function getTodo(){
        return $this->TodoRepository->getAll();
    }

    public function addTodo($data){
        return $this->TodoRepository->create($data);
    }
    public function updateTodo($data,$id){
        $todoId = $this->TodoRepository->getById($id);
        // return [$data, $todoId];
        $id = $todoId->_id;
        $this->TodoRepository->update($data, $id);
        return $todoId;
    }
    public function deleteTodo($id){
        $idTodo = $this->TodoRepository->getById($id);
        // $id = $todoId->_id;
        return $this->TodoRepository->delete($idTodo);
        // return $todoId;
    }
}