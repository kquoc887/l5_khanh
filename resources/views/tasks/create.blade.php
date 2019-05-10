@extends('master')
@section('content')
    <form action="{{route('projects.tasks.store', $project->slug)}}" method="POST" style="width: 30%">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @include('tasks.partials.form')
        <button type="submit" class="btn btn-primary btn-flat">Create Task</button>
    </form>
@endsection