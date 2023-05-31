<?php

namespace App\Http\Controllers;

use App\Exports\TimeLogExport;
use App\Http\requests\TimeLogRequest;
use App\Models\Project;
use App\Models\TimeLog;
use App\Repositories\TimeLogRepository;
use Excel;
use Illuminate\Http\Request;

class TimeLogController extends Controller
{
    protected $TimeLogrepository;

    /**
     * __construct
     *
     * @param  mixed $TimeLogrepository
     * @return void
     */

    public function __construct(TimeLogRepository $TimeLogrepository)
    {

        $this->TimeLogrepository = $TimeLogrepository;
    }

    /**
     * ExportToCsv
     *
     * @param  mixed $req
     * @return void
     */
    public function ExportToCsv(Request $req)
    {

        return Excel::download(new TimeLogExport($req->all()), 'total_time_export.xlsx');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $TimeLog = TimeLog::getAllTimeLogs();

        return view('home', ['TimeLog' => $TimeLog]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $AllProjects = Project::getAllProjects();
        return view('Create_TimeLog', ['AllProjects' => $AllProjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeLogRequest $request)
    {
        $TimeLog = TimeLog::create($request->all());
        return $this->index();
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
        $TimeLogData = TimeLog::where('id', $id)->get();
        return view('Edit_TimeLog', ['TimeLogData' => $TimeLogData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeLogRequest $request)
    {

        $result = $this->TimeLogrepository->TimeLogUpdate($request->all());
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TimeLog::where('id', $id)->delete();
        return $this->index();
    }
}
