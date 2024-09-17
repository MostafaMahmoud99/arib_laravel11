<?php


namespace App\Repository\Employee;


use App\Models\Task;
use App\RepositoryInterface\Employee\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DBTaskRepository implements TaskRepositoryInterface
{
    public function index()
    {
        $user = Auth::user();
        $Tasks = $user->Tasks;

        return view("employee.tasks.index",compact("Tasks"));
    }

    public function editStatus($attributes)
    {
        $Task = Task::where("user_id",Auth::id())->find($attributes["id"]);
        if (!$Task){
            return redirect()->back()->with("error","not found task");
        }

        $Task->update([
            "status" => $attributes["status"]
        ]);

        return redirect()->back()->with("success","status has been changed success");
    }
}
