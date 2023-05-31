<?php

namespace App\Repositories;

use App\Models\TimeLog;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
class TimeLogRepository
{
    

    
 public function TimeLogUpdate($data)
    {
return TimeLog::where('id', $data['id'])->update([
    'start_time' => $data['start_time'],
    'end_time' => $data['end_time'],
   // 'project_id' => $data['project_id'],
    'date' => $data['date'],
]);

        try {
  
   
 
} catch (Exception $e) {
   
    Log::error($e->getMessage());
    return redirect()->back()->with('error', 'An error occurred.');
}

    }
    

    public function TotalTimePerDay( $timeLogs):array 
{
//     $totalTimePerDay = [];
// $totalTimePerDay ['TotalMonthTime']=0;
//     foreach ($timeLogs as $timeLog) {
//     if ($timeLog->start_time && $timeLog->end_time) {
   
//         $id = $timeLog->id;
//         $startTime = Carbon::createFromFormat('H:i:s', $timeLog->start_time);
//         $endTime = Carbon::createFromFormat('H:i:s', $timeLog->end_time);
// if ($endTime < $startTime) {
//     $endTime->modify('+1 day');
// }
//         $timeDifference = $endTime->diffInMinutes($startTime);

//         $hours = floor($timeDifference / 60);
//         $minutes = $timeDifference % 60;
// $totalTimePerDay ['TotalMonthTime']+=$timeDifference;
//         $totalTimePerDay[$id]['hours'] = $hours;
//         $totalTimePerDay[$id]['minutes'] = $minutes;
        
//     }

//     }
 
//     return $totalTimePerDay;


    $totalTimePerDay = [];
$totalTimePerDay['TotalMonthTime'] = 0;

foreach ($timeLogs as $timeLog) {
    if ($timeLog->start_time && $timeLog->end_time) {
        $date = Carbon::createFromFormat('Y-m-d', $timeLog->date)->format('Y-m-d');
        $totalTimePerDay['date'] = $date;
        $startTime = Carbon::createFromFormat('H:i:s', $timeLog->start_time);
        $endTime = Carbon::createFromFormat('H:i:s', $timeLog->end_time);

        if ($endTime < $startTime) {
            $endTime->modify('+1 day');
        }

        $timeDifference = $endTime->diffInMinutes($startTime);

        $hours = floor($timeDifference / 60);
        $minutes = $timeDifference % 60;
        $totalTimePerDay[$date]['hours'] = isset($totalTimePerDay[$date]['hours']) ? $totalTimePerDay[$date]['hours'] + $hours : $hours;
        $totalTimePerDay[$date]['minutes'] = isset($totalTimePerDay[$date]['minutes']) ? $totalTimePerDay[$date]['minutes'] + $minutes : $minutes;

        $totalTimePerDay['TotalMonthTime'] += $timeDifference;
    }
}


return $totalTimePerDay;

}

public function TotalTime($total_day_time)
{
        $totalTimePerMonth = [];
        $hours = floor($total_day_time['TotalMonthTime'] / 60);
        $minutes =$total_day_time['TotalMonthTime']  % 60;
        $totalTimePerMonth['hours'] = $hours;
         $totalTimePerMonth['minutes'] = $minutes;
    
         return $totalTimePerMonth;

}
}
