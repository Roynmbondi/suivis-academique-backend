<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;
use Throwable;


class Niveaucontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::all();

        return response()->json($niveaux, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'label_niveau' => 'required|string|min:5',
                'desc_niveau' => 'required|string',
                'code_filiere' => 'required|string|exists:filiere,code_filiere'
            ]);

            $res = Niveau::create($validatedData);

            return response()->json(["message" => "Niveau crée avec succès"], 201);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        try {
            return response()->json($niveau, 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Niveau $niveau)
    {
       try {
            $validatedData = $request->validate([
                'label_niveau' => 'sometimes|required|string|min:5',
                'desc_niveau' => 'sometimes|required|string',
                'code_filiere' => 'sometimes|required|string|exists:filiere,code_filiere'
            ]);

            $niveau->update($validatedData);

            return response()->json(["message" => "Niveau mis à jour avec succès"], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        try {
            $niveau = Niveau::findOrFail($codeNiveau);
            $niveau->delete();

            return response()->json([
                "message" => "suppresion reussie"
            ], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => "Niveau non trouvé"()
            ], 404);
        }
    }
}
