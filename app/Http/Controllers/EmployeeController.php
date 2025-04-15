<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Http\Request;



class EmployeeController extends Controller
{
    public function index()
    {
        //return response()->json(employee::all(), 200);
        return Employee::all();
    }

    public function store(Request $request)
    {
        //$user = employee::create($request->all());
        //return response()->json($user, 201);

        return Employee::create($request->all());
    }

    public function show($id)
    {
        //return response()->json(employee::find($id), 200);
        return Employee::find($id);
    }

    public function update(Request $request, $id){
        $employee = Employee::find($id);
        $employee->update($request->all());

        return $employee;
    }

    public function destroy($id)
{
        return Employee::destroy($id);
}
}
