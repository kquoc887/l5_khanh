@extends('master')
@section('content')
<h2><a href="{{route('projects.show', $project->slug)}}">{{$project->name}}</a>-{{$task->name}}</h2>
@endsection