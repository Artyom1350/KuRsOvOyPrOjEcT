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
        $bool=true;
        $department=Department::where('name',trim($row[1]))->first();

        if($department==null) return;
        $departmentPart=$department->departmentsParts()->get();

        foreach($departmentPart as $item){
            if($item->name==trim($row[0])){
                $bool=false;
                return;
            } 
        }

        if($bool){
            return new DepartmentPart([
               'name'=> $row[0],
               'department_id'=>$department->id,
            ]);
        }

        return;
    }
    public function startRow(): int
    {
        return 2;
    }
}
