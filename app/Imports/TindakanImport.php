<?php

namespace App\Imports;

use App\Models\Tindakan;
use Maatwebsite\Excel\Concerns\ToModel;

class TindakanImport implements ToModel
{
    public function model(array $row)
    {
        return new Tindakan([
            'tindakan' => $row[0], // Kolom pertama pada Excel
            'biaya' => $row[1],    // Kolom kedua pada Excel
        ]);
    }
}

