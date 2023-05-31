@extends('layouts.app')

@section('content')<br><br>
<h1> Create Time Evaluation</h1>

<h3> Select how you want to evaluate by year or by month or for specific date.
        <form method="get" action="{{route('logs.evaluate.submit')}}">
  
 @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                @endforeach
@endif
     <div class="form-group">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="display_type" id="chart" value="bar_chart">
        <label class="form-check-label" for="chart">Bar Chart</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="display_type" id="table" value="table">
        <label class="form-check-label" for="table">Table</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="display_type" id="csv_excel" value="csv_excel">
        <label class="form-check-label" for="csv_excel">CSV/Excel</label>
      </div>
    </div>
  </div>
    <label for="date">From Date:</label>
    <input type="date"class="form-control" id="date" name="from-date">
    <br><br><br>
    <label for="date">To Date:</label>
    <input type="date"class="form-control" id="date" name="to-date">
<br><br><br>
    <label for="month_year">Select Month and Year:</label>
    <input type="month" class="form-control" id="month_year" name="month_year">
<br><br><br>

    <label for="year">Select Year:</label>
    <input type="number" class="form-control"id="year" Value="2023" name="year">

    
    <br><br><br>






  <button type="submit" class="btn btn-primary">Submit</button>

</form>

@endsection
