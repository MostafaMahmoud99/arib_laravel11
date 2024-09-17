<?php


namespace App\Repository\Manager;


use App\Models\Task;
use App\Models\User;
use App\RepositoryInterface\Manager\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DBTaskRepository implements TaskRepositoryInterface
{
    public function index($attributes)
    {
        $Tasks = Task::with(["User" => function($q){
            $q->select("id","first_name","last_name");
        }])->where("manager_id",Auth::guard("manager")->id())
            ->where("title","like","%".$attributes["search"]."%")->get();

        return view("manager.tasks.index",compact("Tasks"));
    }

    public function create()
    {
        $Users = User::where("manager_id",Auth::guard("manager")->id())->get();
        return view("manager.tasks.create",compact("Users"));
    }

    public function store($attributes)
    {
        $userCheck = User::where("manager_id",Auth::guard("manager")->id())->find($attributes["user_id"]);
        if (!$userCheck){
            return redirect()->back()->with("error","you can't assign this task to this user");
        }

        $attributes["manager_id"] = Auth::guard("manager")->id();
        $Task = Task::create($attributes);

        return redirect()->back()->with("success","task has been assigned success");
    }
}
