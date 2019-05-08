@extends('master')
@section('content')
<form  action="{{route('projects.update', $project->slug)}}" method="POST" style="width: 30%">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    @include('projects.partials.form')
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-primary">Edit Project</button>
</form>
@endsection