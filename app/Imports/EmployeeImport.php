<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'name' => $row[1],
            'nip' => $row[2],
            'rank' => $row[3],
            'group' =>$row[4],
            'position' => $row[5]
        ]);
    }
}

