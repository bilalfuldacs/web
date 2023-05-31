@extends('layouts.app')

@section('content')<br><br>

<td><a href="{{route('logs.create.form')}} "> <input type="button" value="Create Time Log" class="btn-primary"></a></td>
<td><a href="{{route('time.log.evaluation.form')}}"> <input type="button" value="Create Evaluation"
            class="btn-primary"></a></td>
<td>


    <a href="{{route('project.create')}}"> <input type="button" value="Create Project" class="btn-primary"></a>
</td>

<h3> Total Hours Worked </h3>
@if(isset($totalTime))

{{ $totalTime['hours'] ??'NUll' }} hours: {{ $totalTime['minutes'] }} minutes
@endif
<table id="example" class="table table-striped" style="width:100%">

    <thead>
        <tr>
            <th>Date</th>
            <th>Total Time</th>
        </tr>
    </thead>

    <tbody>

        @foreach($totalDayTime as $date => $nestedArray)
        @if($date !== 'TotalMonthTime' && $date !== 'date')
        <tr>
            <td>{{ $date }}</td>
            <td>{{ $nestedArray['hours'] }} hours and {{ $nestedArray['minutes'] }} minutes</td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
@endsection