@extends("manager.layouts.app")

@section("content")
    <div>
        <br>
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
        @elseif(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div>
            <a type="button" class="btn btn-primary" href="{{route("manager.employee.create")}}">Add New Employee</a>
        </div>
        <hr>
        <di>
            <form action="{{route("manager.employee.index.search",["search" => ""])}}" method="post">
                @csrf
                <input name="search" type="text" placeholder="search ...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </di>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Logo</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Salary</th>
                <th scope="col">Manager Name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($Employees as $employee)
                    <tr>
                        <td><img src="{{url($employee->media->file_path)}}" width="50px" height="50px"></td>
                        <td>{{$employee->first_name." ".$employee->last_name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->salary}}</td>
                        <td>{{$employee->Manager->first_name." ".$employee->Manager->first_name}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route("manager.employee.show",$employee->id)}}"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger" href="{{route("manager.employee.delete",$employee->id)}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
