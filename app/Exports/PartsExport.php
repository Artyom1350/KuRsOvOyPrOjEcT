<?php

namespace App\Exports;

use App\Models\DepartmentPart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
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
        $res=DepartmentPart::all();
        $partsArray=array();
        foreach($res as $part){
            array_push($psrtsArray,[
                'name'=>$part->name,
                'department'=>$part->department()->first()->name
            ]);
        }
        dd($partsArray);
        return DB::table('department_parts')->select('name','department_id')->get();
    }
    public function department($id){

    }


    private $fileName = 'da1';
    
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
        return 'DepartmentParts';
    }
}
