<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = User::with('department','departmentassignments.department')->get();
        $response = [
            'message' => "Data pegawai dimuat",
            'data' => $pegawai
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'position' => ['required'],
            'salary' => ['required'],
            'hire_date' => ['required'],
            'department_id' => ['required'],
            'password' => ['required'],

        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $pegawai = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'position' => $request->position,
                'salary' => $request->salary,
                'hire_date' => $request->hire_date,
                'department_id' => $request->department_id,
                'password' => Hash::make($request->password),
            ]);

            $response = [
                'message' => 'Data berhasil dibuat',
                'data' => $pegawai
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
        $pegawai = User::with('department')->find($id);
       
        $response = [
            'message' => 'Detail '. $pegawai->name. ' Berhasil di muat',
            'data' => $pegawai

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
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'position' => ['required'],
            'salary' => ['required'],
            'hire_date' => ['required'],
            'department_id' => ['required'],
            'password' => ['nullable', 'string', 'min:8']

        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $pegawai = User::findOrFail($id);

        $pegawai->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'position' => $request->position,
            'salary' => $request->salary,
            'hire_date' => $request->hire_date,
            'department_id' => $request->department_id,
        ]);
        if ($request->filled('password')) {
            $pegawai->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }
    
        return response()->json(['message' => 'Pegawai berhasil diupdate'], Response::HTTP_OK);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pegawai = User::findOrFail($id);
            $pegawai->delete();
    
            $response = [
                'message' => 'Pegawai berhasil dihapus'
            ];
    
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal menghapus data pegawai: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
