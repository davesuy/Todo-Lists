<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;

class TaskController extends Controller
{

    private $taskRepository;

     public function __construct(TaskRepositoryInterface $taskRepository) {

        $this->taskRepository = $taskRepository;

    }

    public function index() {

       return $this->taskRepository->all();
    	
    }

    public function show($id) {

        return $this->taskRepository->show($id);
    
    }

    public function store(Request $request) {

         return $this->taskRepository->store($request);
    	
    }

    public function update(Request $request, $id) {

        return $this->taskRepository->update($request, $id);

    }

    public function delete(Request $request, $id) {

    	$task = Task::findOrFail($id);
    	$task->delete();

    	return 204;
    }

    public function status(Request $request, $id) {

        $task = Task::findOrFail($id);
        $task->status = $request->input('status');
        $task->save();

        return $task;
    }
}
