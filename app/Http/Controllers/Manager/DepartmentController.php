<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\RepositoryInterface\Manager\DepartmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    protected $DepartmentRepo;

    public function __construct(DepartmentRepositoryInterface $repo)
    {
        $this->DepartmentRepo = $repo;
    }

    public function index(Request $request){
        return $this->DepartmentRepo->index($request->all());
    }

    public function create(){
        return view("manager.departments.create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "title" => "required",
            "description" => "nullable"
        ]);

        if ($validator->fails()){
            return redirect()->back()->with("error",$validator->errors()->first());
        }

        return $this->DepartmentRepo->store($request->all());
    }

    public function show($id){
        return $this->DepartmentRepo->show($id);
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            "title" => "required",
            "description" => "nullable"
        ]);

        if ($validator->fails()){
            return redirect()->back()->with("error",$validator->errors()->first());
        }

        return $this->DepartmentRepo->update($request->all(),$id);
    }

    public function destroy($id){
        return $this->DepartmentRepo->destroy($id);
    }
}
