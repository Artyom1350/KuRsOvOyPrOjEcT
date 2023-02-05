<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        return new User([
           'name'     => $row[0],
           'email'    => $row[1],
           'password' => Hash::make($row[2]),
           'department_part_id'=>$row[3],
           'role'=>$row[4],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
