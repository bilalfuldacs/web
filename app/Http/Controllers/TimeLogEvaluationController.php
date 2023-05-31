<?php

namespace App\Http\Controllers;

use App\Exports\TotalTimeExport;
use App\Http\requests\TimeLogEvaluationRequest;
use App\Models\TimeLog;
use App\Repositories\TimeLogRepository;
use Excel;
use Illuminate\Http\Request;

class TimeLogEvaluationController extends Controller
{

    protected $TimeLogrepository;
    public function __construct(TimeLogRepository $TimeLogrepository)
    {

        $this->TimeLogrepository = $TimeLogrepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TimeLogEvaluationRequest $req)
    {
        if ($req->display_type == "bar_chart") {
            return $this->ShowBarChart($req->all());
        } else if ($req->display_type == "table") {
            return $this->DisplayInTable($req->all());
        } else if ($req->display_type == "csv_excel") {

            return $this->ExportToCsv($req->all());
        }
    }

    public function ShowBarChart($req)
    {

        $TimeLog = TimeLog::CalculateTimeLog($req);
        $totalDayTime = $this->TimeLogrepository->TotalTimePerDay($TimeLog);
        $totalTime = $this->TimeLogrepository->TotalTime($totalDayTime);

        $data = [];

        foreach ($totalDayTime as $date => $nestedArray) {
            if ($date !== 'TotalMonthTime' && $date !== 'date') {
                $hours = $nestedArray['hours'];
                $minutes = $nestedArray['minutes'];
                $totalMinutes = $hours * 60 + $minutes;

                $data[] = [
                    'label' => $date,
                    'y' => $totalMinutes,
                    'hours' => $hours,
                    'minutes' => $minutes,
                    'totalTime' => $totalTime,
                ];
            }
        }

        return view('Pie_Chart', ['data' => $data, 'totalTime' => $totalTime]);
    }

    public function DisplayInTable($req)
    {
        $TimeLog = TimeLog::CalculateTimeLog($req);
        $totalDayTime = $this->TimeLogrepository->TotalTimePerDay($TimeLog);
        $totalTime = $this->TimeLogrepository->TotalTime($totalDayTime);

        $data = [
            // 'timeLogs' => $TimeLog,
            'totalDayTime' => $totalDayTime,
            'totalTime' => $totalTime,
        ];
        return view('Evaluation_Report', $data);
    }

    public function ExportToCsv($req)
    {
        $TimeLog = TimeLog::CalculateTimeLog($req);
        $totalDayTime = $this->TimeLogrepository->TotalTimePerDay($TimeLog);
        $totalTime = $this->TimeLogrepository->TotalTime($totalDayTime);

        return Excel::download(new TotalTimeExport($totalDayTime, $totalTime), 'total_time_export.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
