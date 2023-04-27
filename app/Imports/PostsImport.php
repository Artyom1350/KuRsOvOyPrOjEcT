<?php

namespace App\Imports;

use App\Models\DepartmentPart;
use App\Models\Department;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

HeadingRowFormatter::default('none');
class PostsImport implements OnEachRow,SkipsEmptyRows,SkipsOnError,WithHeadingRow ,SkipsOnFailure,WithValidation,WithMultipleSheets 
{
    use Importable,SkipsErrors,SkipsFailures;
    private $error=[];

    public function onRow(Row $row)
    {
        $rowIndex=$row->getIndex();
        $row=$row->toArray();
        $bool=true;
        $department=Department::where('name',trim($row['Отделение']))->first();
        if(!$department){
            array_push($this->error,[$rowIndex,'Cтруктурное отделение '.$row['Отделение'].' не найдено!']);
            return;
        } 
        $departmentPart=$department->departmentsParts()->get();

        foreach($departmentPart as $item){
            if($item->name==trim($row['Название'])){
                $bool=false;
                return;
            } 
        }

        if($bool){
            //return new DepartmentPart([
            //   'name'=> $row[0],
            //   'department_id'=>$department->id,
            //]);
        }

        return;
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
    public function sheets(): array{
        return [
            1 => $this,
        ];
    }
    public function rules():array{
        return [
            'Название'=>[
                'required',
            ],
            'Отделение'=>[
                'required',
            ],
        ];
    }
}
