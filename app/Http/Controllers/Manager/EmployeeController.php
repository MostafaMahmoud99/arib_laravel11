<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\RepositoryInterface\Manager\EmployeeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    protected $EmployeeRepo;

    public function __construct(EmployeeRepositoryInterface $repo)
    {
        $this->EmployeeRepo = $repo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->EmployeeRepo->index($request->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->EmployeeRepo->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'department_id' => "required|exists:departments,id",
            'first_name' => "required",
            'last_name' => "required",
            'email' => "required|unique:users,email",
            'phone' => "required|unique:users,phone",
            'salary' => "required|numeric|gt:0",
            "media" => "required|mimes:jpg,png,jpeg,svg",
            'password' => "required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|confirmed",
        ]);

        if ($validator->fails()){
            return redirect()->back()->with("error",$validator->errors()->first());
        }

        return $this->EmployeeRepo->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->EmployeeRepo->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'department_id' => "required|exists:departments,id",
            'first_name' => "required",
            'last_name' => "required",
            'email' => "required|unique:users,email,".$id,
            'phone' => "required|unique:users,phone,".$id,
            'salary' => "required|numeric|gt:0",
            "media" => "nullable|mimes:jpg,png,jpeg,svg",
        ]);

        if ($validator->fails()){
            return redirect()->back()->with("error",$validator->errors()->first());
        }

        return $this->EmployeeRepo->update($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->EmployeeRepo->destroy($id);
    }
}
