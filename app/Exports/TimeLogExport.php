<?php

namespace App\Exports;

use App\Models\TimeLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class TimeLogExport implements FromCollection,WithHeadings
{
    private $data;


    public function __construct(array $data)
    {
        $this->data = $data;
      
    }
    public function Headings():array
    {
      return [
        'Project Name',
        'date',
        'start time',
        'end time',
        
      ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
   $result = TimeLog::CalculateTimeLog($this->data);
$TimeLog = [];

foreach ($result as $dat) {
    $TimeLog[] = [
        'project name' => $dat->project->name,
        'date' => $dat->date,
        'start time' => $dat->start_time,
        'end time' => $dat->end_time,
        
    ];
}
 
return collect($TimeLog);
    }
}
