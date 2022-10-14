<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceRepository\Services\TodoService;
use GuzzleHttp\Promise\Create;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class TodoController extends Controller
{
 
	public function __construct() {
		$this->TodoService = new TodoService();
	}
    
    public function showTodo(){
        return $this->TodoService->getTodo();
    }
    public function createTodo(Request $request){
        $validatedData = $request->validate([
            'todo' => 'required',
            'time' => 'required'
        ]);
        
        return $this->TodoService->addTodo($validatedData);
        
    }
    public function updateTodo(Request $request){
        $validatedData = $request->validate([
            'todo' => 'required',
            'time' => 'required'
        ]);
        $todoId = $request->id;
        // return $validatedData;
        $this->TodoService->updateTodo($validatedData, $todoId);
        return $this->TodoService->getById($todoId);

    }
    public function deleteTodo(Request $request){
        $id = $request->validate([
            '_id' => 'required'
        ]);

        $this->TodoService->deleteTodo($id);
        return $this->TodoService->getById($id);

    }
}
