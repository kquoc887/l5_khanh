@extends('master')
@section('content')
<div class="table-responsive">
    @if (!$project->task->count())
        <h2>You have no task</h2>
    @else
         <table class="table table-bordered text-center">
            <tr>
                
                <th>STT</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
           <?php $count = 1; ?>
            @foreach ($project->task as $task)
                <tr>
                    <th>{{$count}}</th>
                    <th><a href="{{route('projects.tasks.show', [$project->slug, $task->slug])}}">{{$task->name}}</a></th>
                    <th>{{$task->slug}}</th>
                    <?php $count++; ?>
                    <th>
                        <form action="{{route('projects.tasks.destroy', [$project->slug, $task->slug])}}" method="POST">
                            <div class="btn-group">
                                <a href="{{route('projects.tasks.edit', [$project->slug, $task->slug])}}" class="btn btn-primary btn-flat">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-flat">Delete</button>
                            </div>
                        </form>
                    </th>
                </tr>
            @endforeach
        </table>
    @endif
    <div class="btn-group float-right">
        <a href="{{route('projects.index')}}" class="btn  btn-info btn-flat btn-lg ">Back To Project</a>
        <a href="{{route('projects.tasks.create', $project->slug)}}" class="btn  btn-warning btn-flat btn-lg">Create Task</a>
    </div>
</div>
@endsection