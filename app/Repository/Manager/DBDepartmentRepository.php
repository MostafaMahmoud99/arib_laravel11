<?php


namespace App\Repository\Manager;


use App\Models\Department;
use App\RepositoryInterface\Manager\DepartmentRepositoryInterface;

class DBDepartmentRepository implements DepartmentRepositoryInterface
{
    public function index($attributes){
        $Departments = Department::withCount("Users")->withSum("Users","salary")
            ->where("title","like","%".$attributes["search"]."%")->get();


        return view("manager.departments.index",compact("Departments"));
    }

    public function store($attributes)
    {
        $Department = Department::create($attributes);
        return redirect()->back()->with("success","department has been created success");
    }

    public function show($id){
        $Department = Department::find($id);
        if (!$Department){
            return redirect()->back()->with("error","not found department");
        }

        return view("manager.departments.update",compact("Department"));
    }

    public function update($attributes, $id)
    {
        $Department = Department::find($id);
        if (!$Department){
            return redirect()->back()->with("error","not found department");
        }

        $Department->update($attributes);
        return redirect()->back()->with("success","department has been updated success");
    }

    public function destroy($id)
    {
        $Department = Department::whereDoesntHave("Users")->find($id);
        if (!$Department){
            return redirect()->back()->with("error","not found department");
        }

        $Department->delete();
        return redirect()->back()->with("success","department has been deleted success");
    }
}
