<?php


namespace App\RepositoryInterface\Manager;


interface EmployeeRepositoryInterface
{
    public function index($attributes);

    public function create();

    public function store($attributes);

    public function show($id);

    public function update($attributes,$id);

    public function destroy($id);
}
