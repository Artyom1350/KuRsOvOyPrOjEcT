<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
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
        return DB::table('users')->select('name','email','department_part_id','role')->get();
    }
    
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
                $event->sheet->getDelegate()->getStyle('A1:E1')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('A1:E1')->applyFromArray($styleArray);
            },

        ];
    }
    public function title(): string
    {
        return 'Users';
    }
    
}
