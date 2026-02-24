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
        DB::transaction(function () use ($rows) {

            foreach ($rows as $row) {

                DB::table('number_series')
                    ->where('item_code', $row['item_code'])
                    ->where('branch_code', $row['branch_code'])
                    ->where('number', $row['number'])
                    ->where('number_status', 'Unreported')
                    ->update([
                        'number_status' => 'Used'
                    ]);
            }

        });
    }
}