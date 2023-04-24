<?php

namespace App\Exports;

use App\Models\User;
use App\Models\DepartmentPart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $res=User::all();
        $usersArr=array();
        foreach($res as $user){
            array_push($usersArr,[
                'name'=>$user->name,
                'email'=>$user->email,
                'department_part'=>$this->department_part($user->department_part_id),
                'role'=>$this->role($user->role)
            ]);
        }
        return collect($usersArr);
    }
    /** Роль строкой */
    public function role($id){
        if($id==0){
            return 'пользователь';
        }
        else if($id==1){
            return 'администратор';
        }
    }
    /** Должность строкой */
    public function department_part($id){
        $part=DepartmentPart::find($id);

        if($part==null){
            return 'Нет должности';
        }
        else{
            return $part->name;
        }
    }
    /** Хеадер таблицы */
    public function headings(): array{
        return[
            'ФИО',
            'Email',
            'Должность',
            'Роль',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class=> function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'black'],
                        ],
                    ],
                ];

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('A1:D1')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('A1:D1')->applyFromArray($styleArray);
            },

        ];
    }

    /** Название таблицы */
    public function title(): string
    {
        return 'Users';
    }
    
}
