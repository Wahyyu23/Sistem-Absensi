<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Services\EmployeesService;
use Illuminate\Http\Request;



class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeesService $employeeService)
    {
        $this->employeeService = $employeeService;
    }
    public function showEmployee()
    {
        try {
            $response = $this->employeeService->getAllEmployees();

            return response()->json([
                'status' => 'success',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Kesalahan saat mengambil data',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateEmployee()
    {
        try {
            $response = $this->employeeService->updateEmployee(
                request('id'),
                request('uid'),
                request('username'),
                request('password'),
                request('employeeName'),
                request('dateOfBirth'),
                request('employeePhone'),
                request('employeeEmail'),
                request('profilePicture'),
                request('position'),
                request('department'),
                request('hireDate'),
                request('terminationDate')
            );
            return response()->json([
                'status' => 'success',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Kesalahan saat mengupdat data',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deleteEmployee($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data pegawai berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Kesalahan saat menghapus data',
                'message' => $e->getMessage()
            ]);
        }
    }

}
