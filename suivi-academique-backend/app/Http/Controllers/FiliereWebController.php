<?php
// app/Http/Controllers/FiliereWebController.php


namespace App\Http\Controllers;


use App\Models\Filiere;
use Illuminate\Http\Request;


class FiliereWebController extends Controller
{
public function index()
{
$filieres = Filiere::all();
return view('filiere', compact('filieres'));
}


public function store(Request $request)
{
$request->validate([
'code_filiere' => 'required|string|min:5|unique:filiere,code_filiere',
'label_filiere' => 'required|string|min:5',
'description_filiere' => 'required',
]);


Filiere::create($request->all());
return redirect()->back()->with('success', 'Filière ajoutée avec succès');
}


public function update(Request $request, $code)
{
$request->validate([
'label_filiere' => 'required|string|min:5',
'description_filiere' => 'required',
]);


$filiere = Filiere::findOrFail($code);
$filiere->update($request->only(['label_filiere', 'description_filiere']));


return redirect()->back()->with('success', 'Filière modifiée');
}


public function destroy($code)
{
$filiere = Filiere::findOrFail($code);
$filiere->delete();


return redirect()->back()->with('success', 'Filière supprimée');
}
}
