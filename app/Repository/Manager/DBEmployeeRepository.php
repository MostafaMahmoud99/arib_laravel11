<?php


namespace App\Repository\Manager;


use App\Models\Department;
use App\Models\Media;
use App\Models\User;
use App\RepositoryInterface\Manager\EmployeeRepositoryInterface;
use App\Traits\GeneralFileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class DBEmployeeRepository implements EmployeeRepositoryInterface
{
    use GeneralFileService;

    public function index($attributes)
    {
        $Employees = User::with(["media","Manager" => function($q){
            $q->select("id","first_name","last_name");
        }])->where(function ($q) use ($attributes){
            $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$attributes["search"]}%"])
                ->orWhere("email","like","%{$attributes["search"]}%");
        })->where("manager_id",Auth::guard("manager")->id())->get();



        return view("manager.employees.index",compact("Employees"));
    }

    public function create(){
        $Departments = Department::select("id","title")->get();
        return view("manager.employees.create",compact("Departments"));
    }

    public function store($attributes)
    {
        $attributes["manager_id"] = Auth::guard("manager")->id();
        $attributes["password"] = Hash::make($attributes["password"]);
        $employee = User::create($attributes);

        if ($attributes["media"] && $attributes["media"] != null){
            $path = "ProfilePicture/";
            $file_name = $this->SaveFile($attributes["media"],$path);
            $type = $this->getFileType($attributes["media"]);

            Media::create([
                'mediable_type' => $employee->getMorphClass(),
                'mediable_id' => $employee->id,
                'title' => "Profile Picture",
                'type' => $type,
                'directory' => $path,
                'filename' => $file_name
            ]);
        }

        return redirect()->back()->with("success","employee has been created success");
    }

    public function show($id)
    {
        $employee = User::with(["media"])
            ->where("manager_id",Auth::guard("manager")->id())
            ->find($id);

        if (!$employee){
            return redirect()->back()->with("error","not found employee");
        }

        $Departments = Department::select("id","title")->get();

        return view("manager.employees.update",compact("employee","Departments"));
    }

    public function update($attributes, $id)
    {
        $employee = User::with("media")->where("manager_id",Auth::guard("manager")->id())
            ->find($id);
        if (!$employee){
            return redirect()->back()->with("error","not found employee");
        }

        $employee->update($attributes);

        if ($attributes["media"] && $attributes["media"] != null){
            $employeeMedia = $employee->media;
            if ($employeeMedia){
                $this->removeFile($employeeMedia->file_path);
            }

            $path = "ProfilePicture/";
            $file_name = $this->SaveFile($attributes["media"],$path);
            $type = $this->getFileType($attributes["media"]);

            $employeeMedia->update([
                'type' => $type,
                'directory' => $path,
                'filename' => $file_name
            ]);
        }

        return redirect()->back()->with("success","employee has been updated success");
    }

    public function destroy($id)
    {
        $employee = User::where("manager_id",Auth::guard("manager")->id())->find($id);
        if (!$employee){
            return redirect()->back()->with("error","not found employee");
        }

        $media = $employee->media;

        if ($media){
            $this->removeFile($media->file_path);
            $media->delete();
        }

        $employee->delete();

        return redirect()->back()->with("success","employee has been deleted success");
    }
}
