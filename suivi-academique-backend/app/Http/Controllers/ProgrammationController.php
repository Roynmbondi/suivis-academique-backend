<?php

namespace App\Http\Controllers;

use App\Models\Programmation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class ProgrammationController extends Controller
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
            $programmation = Programmation::create($request->all());
            return response()->json([
                'message' => 'Programmation created successfully',
                'data' => $programmation
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating programmation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Programmation $programmation)
    {
       try {
            return response()->json($programmation, 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programmation $programmation)
    {
        try {
            $programmation->update($request->all());
            return response()->json([
                'message' => 'Programmation updated successfully',
                'data' => $programmation
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating programmation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programmation $programmation)
    {
        try {
            $programmation->delete();
            return response()->json([
                'message' => 'Programmation deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting programmation',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
