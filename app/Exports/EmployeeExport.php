<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeeExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Employee::all();
    }

    public function map($employee): array
    {
        return [
            $employee->name,
            $employee->nip,
            $employee->rank,
            $employee->group,
            $employee->position
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIP',
            'Pangakat',
            'Golongan',
            'Jabatan'
        ];
    }


}
