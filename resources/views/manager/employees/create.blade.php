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
    <form method="post" action="{{route("manager.employee.store")}}" enctype="multipart/form-data">
        @csrf
        <select class="form-select" aria-label="Default select example" name="department_id">
            <option selected>Select Department</option>
            @foreach($Departments as $department)
                <option value="{{$department->id}}">{{$department->title}}</option>
            @endforeach
        </select>

        <div class="mb-3">
            <label for="first-name" class="form-label">First Name</label>
            <input name="first_name" type="text" class="form-control" id="first-name" placeholder="enter first name" required>
        </div>
        <div class="mb-3">
            <label for="last-name" class="form-label">Last Name</label>
            <input name="last_name" type="text" class="form-control" id="last-name" placeholder="enter last name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="enter last name" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input name="phone" type="text" class="form-control" id="phone" placeholder="enter phone" required>
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input name="salary" type="number" class="form-control" id="salary" placeholder="enter salary" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="*******" required>
        </div>
        <div class="mb-3">
            <label for="password-confirmation" class="form-label">Password Confirmation</label>
            <input name="password_confirmation" type="password" class="form-control" id="password-confirmation" placeholder="******" required>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input name="media" class="form-control" type="file" id="formFile">
        </div>
        <div>
            <button type="submit" class="btn btn-primary" >Save</button>
        </div>
    </form>
    <br>
@endsection
