<?php

namespace App\Imports;

use App\Models\NumberSeries;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SeriesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $grouped = $rows->groupBy(function ($row) {
            return $row['item_code'] . '|' . $row['branch_code'];
        });

        foreach ($grouped as $key => $group) {

            [$itemCode, $branchCode] = explode('|', $key);

            $numbers = $group->pluck('number')->toArray();

            DB::table('number_series')
                ->where('item_code', $itemCode)
                ->where('branch_code', $branchCode)
                ->whereIn('number', $numbers)
                ->where('number_status', 'Unused')
                ->update([
                    'number_status' => 'Used'
                ]);
        }
    }
}