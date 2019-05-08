@extends('master')
@section('content')
    <form action="{{route('projects.tasks.update', [$project->slug, $task->slug])}}" method="POST" style="width: 30%">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @include('tasks.partials.form')
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-primary">Edit Project</button>
    </form>
@endsection