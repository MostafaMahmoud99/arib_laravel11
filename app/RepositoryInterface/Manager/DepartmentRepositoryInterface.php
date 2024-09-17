<?php


namespace App\RepositoryInterface\Manager;


interface DepartmentRepositoryInterface
{
    public function index($attributes);

    public function store($attributes);

    public function show($id);

    public function update($attributes,$id);

    public function destroy($id);
}
