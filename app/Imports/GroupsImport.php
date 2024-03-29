<?php

namespace App\Imports;
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
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

HeadingRowFormatter::default('none');
class GroupsImport implements OnEachRow,SkipsEmptyRows,SkipsOnError,WithHeadingRow ,SkipsOnFailure,WithValidation,WithMultipleSheets 
{
    use Importable,SkipsErrors,SkipsFailures;
    private $error=[];

    public function onRow(Row $row)
    {
        $rowIndex=$row->getIndex();
        $row=$row->toArray();
        $department=Department::where('name',$row['Название'])->first();
        if($department){
            array_push($this->error,[$rowIndex,'структурное подразделение '.$row['Название'].' уже есть!']);
            return;
        }
        Department::create([
           'name'=> $row['Название'],
        ]);
    }
    public function sheets(): array{
        return [
            0 => $this,
        ];
    }
    public function onFailure(Failure ...$failures){
        $arr=array();
        foreach($failures as $item){
            array_push($this->error,[$item->row(),
            ...$item->errors(),]);
        }
    }
    public function errors(){
        
        return $this->error;
    }


    public function rules():array{
        return [
            'Название'=>[
                'required',
            ],
        ];
    }
}
