<?php


namespace App\RepositoryInterface\Manager;


interface TaskRepositoryInterface
{
    public function index($attributes);

    public function create();

    public function store($attributes);
}
