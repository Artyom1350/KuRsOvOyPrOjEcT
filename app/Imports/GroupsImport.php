<?php

namespace App\Imports;
use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GroupsImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        $departments=Department::where('name',trim($row[0]))->first();
        foreach($departments as $item){
            if($item->name==trim($row[0])) return;
        }
        return new Department([
           'name'=> $row[0],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
