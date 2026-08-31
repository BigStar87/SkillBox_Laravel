<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public $addres = [
        'street' => 'Kulas Light',
        'suite' => 'Art. 556',
        'city' => 'Gwenbourgh',
        'zipcode' => '92998-3874'
    ];

    public function index()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $data = $this->jsonEncode($this->addres);

        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->address = !empty($request->input('address')) ? $request->input('address') : $data;
        $employee->work_data = $request->input('work_data');
        $employee->save();

        $url = $this->getUrl($request);
        $path = $this->getPath($request);

        return 'Employee ' . $employee->name . ' create!' . PHP_EOL . $url . PHP_EOL . $path;
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->address = $request->input('address');
        $employee->work_data = $request->input('work_data');

        $employee->save();

        return 'Employee ' . $employee->name . ' updated!';
    }

    public function getUrl($request)
    {
        $getUrl = $request->url();

        return $getUrl;
    }

    public function getPath($request)
    {
        $getPath = $request->path();

        return $getPath;
    }

    public function jsonEncode($array)
    {
        return json_encode($array);
    }
}
