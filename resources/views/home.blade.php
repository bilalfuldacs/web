@extends('layouts.app')

@section('content')<br><br>

<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>Project Name</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Edit</th>
            <th>Delete </th>

        </tr>
    </thead>
    @if(isset($TimeLog))
    @foreach($TimeLog as $item)
    <tbody>
        <tr>
            <td>{{$item->date}}</td>
            <td>{{$item->Project->name}}</td>
            <td>{{$item->start_time}}</td>
            <td>{{$item->end_time}}</td>
            <td><a href="{{route('logs.edit.form', ['id' => $item->id])}} "> <input type="button" value="Edit"
                        class="btn-primary"></a></td>

            <td><button class="btn btn-danger" onclick="deleteTimeLog({{ $item->id }})">Delete</button>
                <form id="delete-form-{{ $item->id }}" action="{{ route('logs.delete', ['id' => $item->id]) }}"
                    method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </td>

        </tr>
        @endforeach
        @endif

    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});

function deleteTimeLog(id) {
    if (confirm('Are you sure you want to delete this time log?')) {
        var deleteForm = document.getElementById('delete-form-' + id);
        deleteForm.submit();
    }
}
</script>

@endsection