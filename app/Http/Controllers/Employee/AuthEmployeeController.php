<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\RepositoryInterface\Employee\AuthEmployeeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthEmployeeController extends Controller
{
    protected $AuthEmployeeRepo;

    public function __construct(AuthEmployeeRepositoryInterface $repo)
    {
        $this->AuthEmployeeRepo = $repo;
    }

    public function indexLogin(){
        return view("employee.login");
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            "identifier" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()){
            return redirect()->back()->with("error",$validator->errors()->first());
        }

        $CheckAuth = $this->AuthEmployeeRepo->login($request->all());
        if ($CheckAuth){
            return redirect()->route("employee.dashboard");
        }else{
            return redirect()->back()->with("error","unauthorized");
        }
    }

    public function dashboard(){
        return view("employee.dashboard");
    }

    public function logout(){
        return $this->AuthEmployeeRepo->logout();
    }

}
