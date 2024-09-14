<?php

namespace App\Http\Controllers;

use App\Models\Leaverequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LeaverequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaverequest = Leaverequest::with('user')->get();

        $response = [
            "message" => "Data berhasil dimuat",
            "data" => $leaverequest
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function terima($id)
    {


        try {
            $leaverequest = Leaverequest::findOrFail($id);

            $leaverequest->update([
                'status' =>  'approved'
            ]);

            $response = [
                'message' => "Izin cuti diterima",
                'data' => $leaverequest
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function tolak($id) {
        try {
            $leaverequest = Leaverequest::findOrFail($id);

            $leaverequest->update([
                'status' =>  'rejected'
            ]);

            $response = [
                'message' => "Izin cuti ditolak",
                'data' => $leaverequest
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
        }

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
            'start_date' => ['required'],
            'end_date' => ['required'],
            'leave_type' => ['required'],
            'status' => ['required'],

        ]);


        if ($validator->fails()) {

            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $leaverequest = Leaverequest::created([
                'user_id' =>  $request->user_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'leave_type' => $request->leave_type,
                'status' => $request->status


            ]);

            $response = [
                'message' => "Cuti berhasil di ajukan",
                "data" => $leaverequest
            ];
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
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
