<?php

namespace App\Http\Controllers;

use App\Models\personnel;
use Illuminate\Http\Request;
use Throwable;

class personnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|min:3|string',
                'email' => 'required|email|unique:personnels,email',
                'position' => 'required|min:3|string',
            ]);

            $res = personnel::create($validatedData);

            return response()->json(["message" => "Personnel crée avec succès"], 201);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(personnel $personnel)
    {
        try {
            return response()->json($personnel, 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, personnel $personnel)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'sometimes|required|min:3|string',
                'email' => 'sometimes|required|email|unique:personnels,email,' . $personnel->id,
                'position' => 'sometimes|required|min:3|string',
            ]);

            $personnel->update($validatedData);

            return response()->json(["message" => "Personnel mis à jour avec succès"], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(personnel $personnel)
    {
        try {
            $personnel->delete();
            return response()->json([
                'message' => 'Personnel deleted successfully'
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
