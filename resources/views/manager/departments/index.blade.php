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
            <a type="button" class="btn btn-primary" href="{{route("manager.department.create")}}">Add New Department</a>
        </div>
        <hr>
        <di>
            <form action="{{route("manager.department.index.search",["search" => ""])}}" method="post">
                @csrf
                <input name="search" type="text" placeholder="search ...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </di>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Count Employees</th>
                <th scope="col">Total Salary</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($Departments as $department)
                    <tr>
                        <td>{{$department->title}}</td>
                        <td>{{$department->description}}</td>
                        <td>{{$department->users_count}}</td>
                        <td>{{$department->users_sum_salary ? $department->users_sum_salary : 0}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route("manager.department.show",$department->id)}}"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger" href="{{route("manager.department.delete",$department->id)}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
