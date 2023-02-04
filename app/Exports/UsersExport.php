<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('name','email','created_at','updated_at');
    }
    public function heading(): array{
        return[
            '#',
            'ФИО',
            'Email',
            'Создан',
            'Последнее обновление'
        ];
    }
}
