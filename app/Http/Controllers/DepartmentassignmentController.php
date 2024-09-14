<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Departmentassignment;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class DepartmentassignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penugasan = Departmentassignment::with('user', 'department')->get();
        $response = [
            'message' => 'Penugasan berhasil dimuat',
            'data' => $penugasan
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
            'user_id' => ['required'],
            'department_id' => ['required'],
            'startdate' => ['required'],
            'enddate' => ['required'],

        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $penugasan = Departmentassignment::create([
                'user_id' => $request->user_id,
                'department_id' => $request->department_id,
                'startdate' => $request->startdate,
                'enddate' =>  $request->enddate,
            ]);

            $response = [
                'message' => 'Data berhasil dibuat',
                'data' => $penugasan
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
        $penugasan = Departmentassignment::where('user_id', $id)->with('department')->get();
        $response = [
            'message' => 'Penugasan berhasil dimuat',
            'data' => $penugasan
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
            'user_id' => ['required'],
            'department_id' => ['required'],
            'startdate' => ['required'],
            'enddate' => ['required'],

        ]);
        if ($validator->fails()) {

            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $penugasan = Departmentassignment::findOrFail($id);
        $penugasan->update([

            'user_id' => $request->user_id,
            'department_id' => $request->department_id,
            'startdate' => $request->startdate,
            'enddate' =>  $request->enddate,

        ]);

        response()->json($penugasan, Response::HTTP_OK);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
