<?php

namespace App\Http\Controllers;

use App\Models\UE;
use Illuminate\Http\Request;
use Throwable;

class UEcontroller extends Controller
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
                'code_ue' => 'required|min:5|string|unique:ue,code_ue',
                'label_ue' => 'required|min:5|string',
                'desc_ue' => 'required|min:5|string',
                'code_niveau' => 'required|int',


            ]);

            $res = ue::create($validatedData);

            return response()->json(["message" => "ue crée avec succès"], 201);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UE $uE)
    {
       try {
            return response()->json($uE, 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UE $uE)
    {
        try {
            $validatedData = $request->validate([
                'code_ue' => 'sometimes|required|min:5|string|unique:ue,code_ue,' . $uE->id,
                'label_ue' => 'sometimes|required|min:5|string',
                'desc_ue' => 'sometimes|required|min:5|string',
                'code_niveau' => 'sometimes|required|int',
            ]);

            $uE->update($validatedData);

            return response()->json([
                "message" => "ue mise à jour avec succès"
            ], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UE $uE)
    {
        try {
            $UE = ue::findOrFail($codeUE);
            $UE->delete();

            return response()->json([
                "message" => "ue supprimée"
            ], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
