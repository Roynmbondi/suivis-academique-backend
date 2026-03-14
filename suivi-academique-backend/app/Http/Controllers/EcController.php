<?php

namespace App\Http\Controllers;

use App\Models\Ec;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class EcController extends Controller
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
                'code_ec' => 'required|min:5|string|unique:ec,code_ec',
                'label_ec' => 'required|min:5|string',
                'desc_ec' => 'required|min:5|string',
                'code_ue' => 'required|string|exists:ue,code_ue'
            ]);

            $res = Ec::create($validatedData);

            return response()->json(["message" => "Ec crée avec succès"], 201);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ec $ec)
    {
        try {
            return response()->json($ec, 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ec $ec)
    {
        try {
            $validatedData = $request->validate([
                'label_ec' => 'sometimes|required|min:5|string',
                'desc_ec' => 'sometimes|required|min:5|string',
                'code_ue' => 'sometimes|required|string|exists:ue,code_ue'
            ]);

            $ec->update($validatedData);

            return response()->json(["message" => "Ec mise à jour avec succès"], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ec $ec)
    {
        try {
            $EC = Ec::findOrFail($codeEC);
            $EC->delete();

            return response()->json([
                "message" => "Ec supprimée"
            ], 200);

        } catch(Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
