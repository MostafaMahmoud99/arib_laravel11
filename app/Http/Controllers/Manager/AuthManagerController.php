<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\RepositoryInterface\Manager\AuthManagerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthManagerController extends Controller
{
    protected $AuthManagerRepo;

    public function __construct(AuthManagerRepositoryInterface $repo)
    {
        $this->AuthManagerRepo = $repo;
    }

    public function indexLogin(){
        return view("manager.login");
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            "identifier" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()){
            return redirect()->back()->with("error",$validator->errors()->first());
        }

        $CheckAuth = $this->AuthManagerRepo->login($request->all());
        if ($CheckAuth){
            return redirect()->route("manager.dashboard");
        }else{
            return redirect()->back()->with("error","unauthorized");
        }
    }

    public function dashboard(){
        return view("manager.dashboard");
    }

    public function logout(){
        return $this->AuthManagerRepo->logout();
    }
}
