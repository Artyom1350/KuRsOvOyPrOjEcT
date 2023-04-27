<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

HeadingRowFormatter::default('none');
class UsersImport implements OnEachRow,SkipsEmptyRows,SkipsOnError,WithHeadingRow ,SkipsOnFailure,WithValidation
{
    use Importable,SkipsErrors,SkipsFailures;
    private $error=[];
    public function onRow(Row $row)
    {
        $row_id=$row->getIndex();
        $row=$row->toArray();

        if(User::where('email',$row['Email'])){
            array_push($this->error,[$row_id,'Пользователь с таким Email уже есть!']);
            return;
        }
        $department=Department::where('name',trim($row['Отделение']))->first();
        if(!$department){
            array_push($this->error,[$row_id,'Отделение не найдено!']);
            return;
        }
        $department_part=$department->departmentsParts()->where('name',trim($row['Должность']))->first();    
        if(!$department_part){
            array_push($this->error,[$row_id,'Должность не найдена!']);
            return;
        }
        $role=0;
        if(trim($row['Роль'])=='Администратор') $role=1;

        User::create([
            'name'=>$row['ФИО'],
            'email'=>$row['Email'],
            'password'=>Hash::make($row['Пароль']),
            'department_part_id'=>$department_part->id,
            'role'=>$role,
        ]);
    }
    
    public function errors(){
        return $this->error;
    }

    public function onFailure(Failure ...$failures){
        $arr=array();
        foreach($failures as $item){
            array_push($this->error,[$item->row(),
            ...$item->errors(),]);
        }
    }
    
    public function rules():array{
        return [
            'ФИО'=>[
                'required',
            ],
            'Email'=>[
                'required',
            ],
            'Пароль'=>[
                'required',
            ],
            'Отделение'=>[
                'required',
            ],
            'Должность'=>[
                'required'
            ],
        ];
    }
}
