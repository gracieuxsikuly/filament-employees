<?php

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/employees', function () {
        $employees=Employee::orderBy('last_name')->get();
    return EmployeeResource::collection($employees);
});
