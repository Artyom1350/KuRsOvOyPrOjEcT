<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\DepartmentPart;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PostsImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        return new DepartmentPart([
           'name'=> $row[0],
           'department_id'=>$row[1],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
