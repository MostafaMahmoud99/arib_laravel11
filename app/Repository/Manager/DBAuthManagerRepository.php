<?php


namespace App\Repository\Manager;


use App\RepositoryInterface\Manager\AuthManagerRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DBAuthManagerRepository implements AuthManagerRepositoryInterface
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

        if (Auth::guard("manager")->attempt($credentials)){
            return true;
        }else{
            return false;
        }
    }

    public function logout()
    {
        Auth::guard("manager")->logout();
        return redirect()->route("manager.index.login");
    }
}
