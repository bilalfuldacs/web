@extends('layouts.app')

@section('content')<br><br>

<form method="Post" action="{{route('project.form.submit')}}">
    @csrf

    <div class="mb-3">
        <label for="start-time" class="form-label">project Name</label>
        <input type="Text" class="form-control" name="name">
    </div>
    <div class="mb-3">
        <label for="start-time" class="form-label">Time Alotted</label>
        <input type="number" class="form-control" name="total_time">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection