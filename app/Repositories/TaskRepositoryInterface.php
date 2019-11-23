<?php

namespace App\Repositories;


interface TaskRepositoryInterface
{

	public function all();

	public function show($id);

	public function store($request);

	public function update($request, $id);

}