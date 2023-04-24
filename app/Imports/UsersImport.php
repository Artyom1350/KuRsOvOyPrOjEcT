<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class UsersImport implements ToModel, WithStartRow,SkipsOnError
{
    use Importable,SkipsErrors;

    public function model(array $row)
    {
        
        $department=Department::where('name',trim($row[4]))->first();
        $department_part=$department->departmentsParts()->where('name',trim($row[3]))->first();    
        
        $role=0;
        if(trim($row[5])=='Администратор') $role=1;
        if(!$department_part){
            $this->errors()->add('Должность не найдена!');
            return;
        }
        return new User([
            'name'=>$row[0],
            'email'=>$row[2],
            'password'=>Hash::make($row[1]),
            'department_part_id'=>$department_part->id,
            'role'=>$role,
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }

    public function onFailure(Failure ...$failures){

    }
}
