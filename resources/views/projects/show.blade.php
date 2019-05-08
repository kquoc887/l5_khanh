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
                <th>Action</th>
            </tr>
           <?php $count = 1; ?>
            @foreach ($project->task as $task)
                <tr>
                    <th>{{$count}}</th>
                    <th><a href="{{route('projects.tasks.show', [$project->slug, $task->slug])}}">{{$task->name}}</a></th>
                    <?php $count++; ?>
                    <th>
                        <form action="{{route('projects.tasks.destroy', [$project->slug, $task->slug])}}" method="POST">
                            <div class="btn-group">
                                <a href="{{route('projects.tasks.edit', [$project->slug, $task->slug])}}" class="btn btn-primary">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </th>
                </tr>
            @endforeach
        </table>
    @endif
    <div class="btn-group float-right">
        <a href="{{route('projects.index')}}" class="btn btn-info ">Back To Project</a>
        <a href="{{route('projects.tasks.create', $project->slug)}}" class="btn btn-warning">Create Task</a>
    </div>
</div>
@endsection