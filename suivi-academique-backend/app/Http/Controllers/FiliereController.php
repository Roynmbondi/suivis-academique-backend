<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filieres = Filiere::all();

        return response()->json($filieres, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'code_filiere' => 'required|min:5|string|unique:filiere,code_filiere',
                'label_filiere' => 'required|min:5|string',
                'description_filiere' => 'required'
            ]);

            $res = Filiere::create($validatedData);

            return response()->json(["message" => "Filière crée avec succès"], 201);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Filiere $filiere)
    {
        try {
            return response()->json($filiere, 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filiere $filiere)
    {
        try {
            $validatedData = $request->validate([
                'code_filiere' => 'sometimes|required|min:5|string|unique:filiere,code_filiere,' . $filiere->code_filiere,
                'label_filiere' => 'sometimes|required|min:5|string',
                'description_filiere' => 'sometimes|required'
            ]);

            $filiere->update($validatedData);

            return response()->json(["message" => "Filière mise à jour avec succès"], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $codeFiliere)
    {
        try {
            $filiere = Filiere::findOrFail($codeFiliere);
            $filiere->delete();

            return response()->json([
                "message" => "Filière supprimée"
            ], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
