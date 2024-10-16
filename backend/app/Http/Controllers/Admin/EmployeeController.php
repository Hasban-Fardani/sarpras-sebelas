<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @group 11. Employee Management
 *
 * API endpoints for managing employees
 */
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // get page and per_page
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        // get all employees
        $data = Employee::query();

        // search by name
        $data->when($request->search, function ($data) use ($request) {
            $data->where(function ($query) use ($request) {
                // select * from employees where name like %search%
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        });

        $data->orderBy('created_at', 'desc');

        // paginate
        $data = $data->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'message' => 'success get all employees',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();
        $employee = Employee::create($data);

        return response()->json([
            'message' => 'success create new employee',
            'data' => $employee
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return response()->json([
            'message' => 'success get employee',
            'data' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();
        $employee->update($data);

        return response()->json([
            'message' => 'success update employee',
            'data' => $employee
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'message' => 'success delete employee'
        ]);
    }

    /**
     * Make user account from employee
     */
    public function assign(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'role' => 'required|in:admin,pengawas,unit',
            'username' => 'required|unique:users,username',
            'nip' => 'required|exists:employees,nip',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid request',
                'error' => $validator->errors()
            ]);
        }

        $data = $validator->validated();
        $data['id'] = $employee->id;
        $user = User::create($data);

        Log::info('create user ' . $user->username . ' from employee ' . $employee);

        return response()->json([
            'message' => 'success assign user to employee',
        ]);
    }

    /**
     * Delete user account
     */
    public function unassign(Employee $employee)
    {
        $user = User::where('id', $employee->id);
        $user->delete();

        return response()->json([
            'message' => 'succes delete account',
        ]);
    }
}
