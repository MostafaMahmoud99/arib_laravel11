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
    <form method="post" action="{{route("manager.task.store")}}">
        @csrf
        <select class="form-select" aria-label="Default select example" name="user_id">
            <option selected>Select Employee</option>
            @foreach($Users as $user)
                <option value="{{$user->id}}">{{$user->first_name." ".$user->last_name}}</option>
            @endforeach
        </select>
        <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="enter title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Task Description</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary" >Save</button>
        </div>
    </form>
@endsection
