<?php

namespace App\Imports;
use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GroupsImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        return new Department([
           'name'=> $row[0],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
