<?php


namespace App\Repository\Employee;


use App\RepositoryInterface\Employee\AuthEmployeeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DBAuthEmployeeRepository implements AuthEmployeeRepositoryInterface
{
    public function login($attributes)
    {
        if (str_contains($attributes["identifier"],"@")){
            $credentials = [
                "email" => $attributes["identifier"],
                "password" => $attributes["password"]
            ];
        }else{
            $credentials = [
                "phone" => $attributes["identifier"],
                "password" => $attributes["password"]
            ];
        }

        if (Auth::attempt($credentials)){
            return true;
        }else{
            return false;
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("employee.index.login");
    }
}
