<?php

namespace App\Exports;

use App\Models\DepartmentPart;
use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class PartsExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $partsArray=array();
        $res=Department::orderBy('name')->get();
        foreach($res as $item){
            $res1=$item->departmentsParts()->get();
            foreach($res1 as $part){
                array_push($partsArray,[
                    'name'=>$part->name,
                    'department'=>$item->name
                ]);
            }
        }
        return collect($partsArray);
    }
    public function department($id){

    }


    private $fileName = 'department_parts';
    
    public function headings(): array{
        return[
            'Название',
            'Отделение',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:B1'; // All headers

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'black'],
                        ],
                    ],
                ];

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('A1:B1')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('A1:B1')->applyFromArray($styleArray);
            },

        ];
    }
    public function title(): string
    {
        return 'Должности';
    }
}
