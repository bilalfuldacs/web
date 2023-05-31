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
<h1> Edit Time Log </h1>
<form method="Post" action="{{route('logs.form.update')}}">
    @method('PATCH')
    @csrf
    <div class="mb-3">
        <label for="project" class="form-label">Project</label>


        @foreach($TimeLogData as $item)



        <input type="text" class="form-control" id="project-name-display" value="{{ $item->project->name }}" readonly>
        <input type="hidden" id="project-id" name="project_id" value="{{ $item->project_id }}">
        <input type="hidden" id="time-log-id" name="id" value="{{ $item->id }}">

    </div>

    <div class="mb-3">
        <label for="start-time" class="form-label">Start Time</label>
        <input type="time" value="{{$item->start_time}}" class="form-control" id="start-time" name="start_time">
    </div>

    <div class="mb-3">
        <label for="end-time" class="form-label">End Time</label>
        <input type="time" value="{{$item->end_time}}" class="form-control" id="end-time" name="end_time">
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" value="{{$item->date}}" id="date" name="date">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endforeach
@endsection