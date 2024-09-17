<?php


namespace App\RepositoryInterface\Employee;


interface AuthEmployeeRepositoryInterface
{
    public function login($attributes);

    public function logout();
}
