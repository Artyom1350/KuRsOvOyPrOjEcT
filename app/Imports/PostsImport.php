<?php

namespace App\Imports;

use App\Models\DepartmentPart;
use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PostsImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        $department=Department::find($row[1]);
        return new DepartmentPart([
           'name'=> $row[0],
           'department_id'=>$department->id,
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
