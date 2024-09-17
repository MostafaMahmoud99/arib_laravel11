@extends("manager.layouts.app")

@section("content")
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
    <form method="post" action="{{route("manager.employee.update",$employee->id)}}" enctype="multipart/form-data">
        @csrf
        <select class="form-select" aria-label="Default select example" name="department_id">
            <option>Select Department</option>
            @foreach($Departments as $department)
                @if($department->id == $employee->department_id)
                    <option value="{{$department->id}}" selected>{{$department->title}}</option>
                @else
                    <option value="{{$department->id}}">{{$department->title}}</option>
                @endif

            @endforeach
        </select>

        <div class="mb-3">
            <label for="first-name" class="form-label">First Name</label>
            <input value="{{$employee->first_name}}" name="first_name" type="text" class="form-control" id="first-name" placeholder="enter first name" required>
        </div>
        <div class="mb-3">
            <label for="last-name" class="form-label">Last Name</label>
            <input value="{{$employee->last_name}}" name="last_name" type="text" class="form-control" id="last-name" placeholder="enter last name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="{{$employee->email}}" name="email" type="email" class="form-control" id="email" placeholder="enter last name" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input value="{{$employee->phone}}" name="phone" type="text" class="form-control" id="phone" placeholder="enter phone" required>
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input value="{{$employee->salary}}" name="salary" type="number" class="form-control" id="salary" placeholder="enter salary" required>
        </div>

        <div class="mb-3">
            <img src="{{url($employee->media->file_path)}}" width="100px" height="100px">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input name="media" class="form-control" type="file" id="formFile">
        </div>
        <div>
            <button type="submit" class="btn btn-primary" >Save</button>
        </div>
    </form>
@endsection
