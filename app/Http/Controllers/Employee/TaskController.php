<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\RepositoryInterface\Employee\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $TaskRepo;

    public function __construct(TaskRepositoryInterface $repo)
    {
        $this->TaskRepo = $repo;
    }

    public function index(){
        return $this->TaskRepo->index();
    }

    public function editStatus(Request $request){
        return $this->TaskRepo->editStatus($request->all());
    }
}
