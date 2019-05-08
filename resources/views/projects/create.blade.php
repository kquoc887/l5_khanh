@extends('master')
@section('content')
<form  action="{{route('projects.store')}}" method="POST" style="width: 30%">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    @include('projects.partials.form')
    <button type="submit" class="btn btn-primary">Create Project</button>
</form>
@endsection