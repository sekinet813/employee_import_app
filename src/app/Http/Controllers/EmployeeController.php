<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::all(); // 全件取得
        return response()->json($employees);
    }

    public function truncateEmployees() {
        // テーブルをtruncate（全データ削除）
        Employee::truncate();
        return response()->json(['message' => 'Employees table has been truncated successfully.']);
    }
}
