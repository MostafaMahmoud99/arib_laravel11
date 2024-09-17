@extends("employee.layouts.app")

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
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($Tasks as $task)
                    <tr>
                        <td>{{$task->title}}</td>
                        <td>{{$task->description}}</td>
                        <td>{{$task->status}}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Status
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{route("employee.task.edit-status",["id" => $task->id,"status" =>"pending"])}}">Pending</a></li>
                                    <li><a class="dropdown-item" href="{{route("employee.task.edit-status",["id" => $task->id,"status" => "in_progress"])}}">In Progress</a></li>
                                    <li><a class="dropdown-item" href="{{route("employee.task.edit-status",["id" => $task->id,"status" => "completed"])}}">Completed</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
