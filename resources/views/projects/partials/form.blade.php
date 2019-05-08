<div class="form-group">
  <label for="name">Name:</label>
<input type="text" name="name" id="name" class="form-control" placeholder="Please Enter Name" aria-describedby="helpId" value="{!!old('name', isset($project) ? $project->name : null)!!}">
</div>
<div class="form-group">
        <label for="slug">Slug:</label>
        <input type="text" name="slug" id="slug" class="form-control" placeholder="Please Enter Slug" aria-describedby="helpId" value="{!!old('slug', isset($project) ? $project->slug : null)!!}">
</div>
<a href="{{route('projects.index')}}" class="btn btn-info">Back To Project</a>
