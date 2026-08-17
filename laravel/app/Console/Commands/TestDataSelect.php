<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestDataSelect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-data-select';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $employees = Employee::all();
//        foreach ($employees as $employee) {
//            echo $employee->first_name . ' ' . $employee->age . PHP_EOL;
//        }

//        $employees = Employee::find(3);
//        echo $employees['id'] . ' ' . $employees['first_name'];

//        $employees = Employee::where('first_name', '=', 'Alex')->get();
//        foreach ($employees as $employee) {
//            echo 'id: ' . $employee->id . '; Name: ' . $employee->first_name . '; Age: ' . $employee->age . ';' . PHP_EOL;
//        }

//        $employees = Employee::orderBy('age', 'asc')
//            ->skip(2)
//            ->limit(2)
//            ->get();
//        foreach ($employees as $employee) {
//            echo 'id: ' . $employee->id . '; Name: ' . $employee->first_name . '; Age: ' . $employee->age . ';' . PHP_EOL;
//        }

//        $employees = DB::table('employees')
//            ->groupBy('first_name')
//            ->select('first_name', DB::raw('count(1) as employee_total'))
//            ->get();
//
//        foreach ($employees as $employee) {
//            echo 'name: ' . $employee->first_name . '; count: ' . $employee->employee_total . ';' . PHP_EOL;
//        }

        $employees = Employee::distinct()->get(['first_name']);

        foreach ($employees as $employee) {
            echo 'name: ' . $employee->first_name . PHP_EOL;
        }
    }
}
