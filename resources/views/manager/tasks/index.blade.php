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
            <a type="button" class="btn btn-primary" href="{{route("manager.task.create")}}">Add New Task</a>
        </div>
        <hr>
        <di>
            <form action="{{route("manager.task.index.search",["search" => ""])}}" method="post">
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
                <th scope="col">Employee Name</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
                @foreach($Tasks as $task)
                    <tr>
                        <td>{{$task->title}}</td>
                        <td>{{$task->description}}</td>
                        <td>{{$task->User->first_name." ".$task->User->last_name}}</td>
                        <td>{{$task->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
