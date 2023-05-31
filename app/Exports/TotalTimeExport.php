<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TotalTimeExport implements FromCollection
{
    private $totaldaytime;
    private $totalTime;

    public function __construct(array $totaldaytime, array $totalTime)
    {
        $this->totaldaytime = $totaldaytime;
        $this->totalTime = $totalTime;
    }
public function collection()
{
    if (!is_array($this->totaldaytime) || empty($this->totaldaytime)) {
        return collect([]);
    }

    $data = array_map(function ($date) {
        if (is_array($this->totaldaytime[$date]) && isset($this->totaldaytime[$date]['hours']) && isset($this->totaldaytime[$date]['minutes'])) {
            return [$date, $this->totaldaytime[$date]['hours'] . ' hours and ' . $this->totaldaytime[$date]['minutes'] . ' minutes'];
        }
        return [$date];
    }, array_keys($this->totaldaytime));

    return collect($data);
}



}
