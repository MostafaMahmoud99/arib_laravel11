<?php


namespace App\RepositoryInterface\Employee;


interface TaskRepositoryInterface
{
    public function index();

    public function editStatus($attributes);
}
