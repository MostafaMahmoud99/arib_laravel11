<?php


namespace App\RepositoryInterface\Manager;


interface AuthManagerRepositoryInterface
{
    public function login($attributes);

    public function logout();
}
