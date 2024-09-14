<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departmernt = Department::all();

        $response = [
            'message' => 'Data deparment berhasil di muat',
            'data' => $departmernt
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => ['required'],

        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $department = Department::create([
                'department_name' => $request->department_name,
            ]);

            $response = [
                'message' => 'Data berhasil dibuat',
                'data' => $department
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::find($id);

        $response = [
            'message' => 'Detail ' . $department->department_name . ' Berhasil di muat',
            'data' => $department

        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => ['required'],

        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $department = Department::findOrFail($id);

        $department->update([
            'department_name' => $request->department_name,

        ]);


        return response()->json(['message' => 'Department berhasil diupdate'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->delete();

            $response = [
                'message' => 'Department berhasil dihapus'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal menghapus data department: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
