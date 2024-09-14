<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendance = Attendance::with('user')->get();

        $response = [
            'message' => 'Data berhasil di muat',
            'data' => $attendance

        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['require'],
            'date' => ['require'],
            'check_in' => ['require'],
            'check_out' => ['require'],
            'status' => ['require']

        ]);


        if ($validator->fails()) {

            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $attendance = Attendance::created([
                'user_id' => $request->user_id,
                'date' => $request->date,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'status' => $request->status,

            ]);

            $response = [
                'message' => 'Data berhasil di buat',
                'data' => $attendance
            ];

            return response()->json($response, Response::HTTP_CREATED);

        } catch (\Throwable $e) {
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
