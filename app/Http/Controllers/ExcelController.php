<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Excel;

class ExcelController extends Controller
{
    public function getUsers(Request $request){
        return Excel::download(new ArrayExport, 'users.xlsx');
    }
}
