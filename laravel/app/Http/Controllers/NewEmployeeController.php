<?php

namespace App\Http\Controllers;

use App\Models\NewEmployee;
use Illuminate\Http\Request;

class NewEmployeeController extends Controller
{
    public function index()
    {
        return view('new-employees');
    }
    public function store(Request $request)
    {
        $employees = new NewEmployee();
        $employees->name = $request->name;
        $employees->email = $request->email;
        $employees->save();

        return 'Employee ' . $request->name . ' create!';
    }
}
