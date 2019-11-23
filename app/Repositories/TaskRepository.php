<?php

namespace App\Repositories;

use App\Task;

class TaskRepository implements TaskRepositoryInterface
{

	public function all() {

		return Task::all();
	}

	public function show($id) {

		return Task::find($id);

	}

	public function store($request) {

		return Task::create($request->all());
	}

	public function update($request, $id) {
		
		   	$task = Task::findOrFail($id);
    	$task->update($request->all());

    	return $task;
	}
}