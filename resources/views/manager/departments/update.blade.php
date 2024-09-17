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
    <form method="post" action="{{route("manager.department.update",$Department->id)}}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Department Title</label>
            <input name="title" value="{{$Department->title}}" type="text" class="form-control" id="title" placeholder="enter title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{$Department->description}}</textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary" >Update</button>
        </div>
    </form>
@endsection
