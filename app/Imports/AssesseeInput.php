<?php

namespace App\Imports;

use App\Assessee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssesseeInput implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Assessee([
            'name'     => $row['assessee'],
            'tin_number'    => $row['tin_number'],
            'tin_date'    => $row['tin_date'],
        ]);
    }
}
