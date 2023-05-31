<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TimeLog extends Model
{
    use HasFactory;
    
use SoftDeletes;

protected $fillable = [
        'project_id',
        'start_time',
        'end_time',
        'date',
        
   
    ];
 protected $casts = [
        'project_id' => 'integer',
     
        
    ];
    /**
     * Get all projects.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllTimeLogs()
    {
        return self::orderBy('date')->get();

    }
 public static function CalculateTimeLog($data)
    {
       $fromDate = $data['from-date'];
       $toDate = $data['to-date'];
        $monthYear = $data['month_year'];
        $year = $data['year'];

        $timelogs = self::query();

       if ($fromDate && $toDate) {

$timelogs->whereBetween('date', [$fromDate, $toDate]);
        }

        if ($monthYear) {
            $timelogs->whereMonth('date', date('m', strtotime($monthYear)))
                ->whereYear('date', date('Y', strtotime($monthYear)));
        }

        if ($year) {
            $timelogs->whereYear('date', $year);
        }

        $result = $timelogs->get();
        
return $result;
        
    }

    
    public function Project(){
        return $this->belongsTo(Project::class);
    }
}
