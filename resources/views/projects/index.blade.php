@extends('master')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <?php $count=1; ?>
            @foreach ($projects as $project)
                <tr>
                    <td>{{$count}}</td>
                    <td><a href="{{route('projects.show', $project->slug)}}">{{$project->name}}</a></td>
                    <?php $count++; ?>
                    <td>
                        <form action="{{route('projects.destroy', $project->slug)}}" method="POST">
                            <a href="{{route('projects.edit', $project->slug)}}" class="btn btn-primary">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="float-right">
            <a href="{{route('projects.create')}}" class="btn btn-warning">Create Project</a>
        </div>
    </div>
@endsection