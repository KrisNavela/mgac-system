<?php

namespace App\Imports;

use App\Models\NumberSeries;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class SeriesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $lineCode = $row[0];
            $branchCode = $row[1];
            $seriesNumber = $row[2];

            NumberSeries::where('item_code', $lineCode)
                ->where('branch_code', $branchCode)
                ->where('number', $seriesNumber)
                ->update(['number_status' => 'Used']);
        }
    }
}