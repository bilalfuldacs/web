@extends('layouts.app')

@section('content')<br><br>
@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
</div>
                @endforeach
@endif
        <form method="Post" action="{{route('logs.form.submit')}}">
          @csrf
  <div class="mb-3">
    <label for="project" class="form-label">Project</label>
    <select class="form-select" id="project" name="project_id">
    @if(isset($AllProjects))
@foreach($AllProjects as $item)
      <!-- Add options dynamically from your data -->
      <option value="{{$item->id}}" >{{$item->name}}</option>
@endforeach
   @endif
    </select>
  </div>

  <div class="mb-3">
    <label for="start-time" class="form-label">Start Time</label>
    <input type="time" class="form-control" id="start-time"  name="start_time">
  </div>

  <div class="mb-3">
    <label for="end-time" class="form-label">End Time</label>
    <input type="time" class="form-control" id="end-time" name="end_time">
  </div>

  <div class="mb-3">
    <label for="date" class="form-label">Date</label>
    <input type="date" class="form-control" id="date" name="date">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
