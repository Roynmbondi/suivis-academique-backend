<?php

namespace App\Http\Controllers;

use App\Models\salle;
use Illuminate\Http\Request;
use Throwable;

class salleController extends Controller
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
                'code_salle' => 'required|min:3|string|unique:salles,code_salle',
                'capacity' => 'required|int',
                'location' => 'required|min:5|string',
            ]);

            $res = salle::create($validatedData);

            return response()->json(["message" => "Salle crée avec succès"], 201);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(salle $salle)
    {
        try {
            return response()->json($salle, 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, salle $salle)
    {
        try {
            $validatedData = $request->validate([
                'code_salle' => 'sometimes|required|min:3|string|unique:salles,code_salle,' . $salle->id,
                'capacity' => 'sometimes|required|int',
                'location' => 'sometimes|required|min:5|string',
            ]);

            $salle->update($validatedData);

            return response()->json(["message" => "Salle mise à jour avec succès"], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(salle $salle)
    {
        try {
            $salle->delete();
            return response()->json([
                'message' => 'Salle deleted successfully'
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
