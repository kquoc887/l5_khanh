<div class="form-group">
  <label for="name">Name:</label>

<input type="text" name="name" id="name" class="form-control" placeholder="Please Enter Name" aria-describedby="helpId" value="{{old('name', isset($task) ? $task->name : null)}}">
</div>
<div class="form-group">
  <label for="slug">Slug:</label>
  <input type="text" name="slug" id="slug" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('slug', isset($task) ? $task->slug : null)}}">
</div>
<div class="form-check form-check-inline">
    <label class="form-check-label">
    Completed: <input class="form-check-input" type="checkbox" name="completed" id="completed"
    @if (isset($task))
        @if ($task->completed == 1)
            {{"checked"}}  
        @else
            {{""}}
        @endif
    @else
        {{""}}
    @endif> 
    </label>
</div>
<div class="form-group">
  <label for="description">Description</label>
<textarea class="form-control" name="description" id="description" rows="3">{{old('description', isset($task) ? $task->description : null)}}</textarea>
</div>