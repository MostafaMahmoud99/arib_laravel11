<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\RepositoryInterface\Manager\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    protected $TaskRepo;

    public function __construct(TaskRepositoryInterface $repo)
    {
        $this->TaskRepo = $repo;
    }

    public function index(Request $request){
        return $this->TaskRepo->index($request->all());
    }

    public function create(){
        return $this->TaskRepo->create();
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "user_id" => "required|exists:users,id",
            "title" => "required",
            "description" => "required"
        ]);

        if ($validator->fails()){
            return redirect()->back()->with("error",$validator->errors()->first());
        }

        return $this->TaskRepo->store($request->all());
    }
}
