<?php

namespace App\Http\Controllers;

use App\Imports\UnstablesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DataUploadController extends Controller
{
    public function uploadUnstables() 
    {
        Excel::import(new UnstablesImport, 'unstables.xlsx');
        
        return redirect('/')->with('success', 'All good!');
    }
}
