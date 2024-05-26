<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre; // Assurez-vous d'importer le modèle Livre
use Illuminate\Support\Facades\Validator;

class LivreController extends Controller
{
    public function addLivre(Request $request)
    {
        // Étendre la validation pour inclure le fichier PDF
        $validatedData = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'ImageUrl' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf_uploaded' => 'nullable|file|mimes:pdf|max:10000' // Validation du fichier PDF
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'error' => $validatedData->errors()
            ], 422);
        }
        $livre = new Livre();
        $livre->titre = $request->titre;
        $livre->description = $request->description;
        if ($request->hasFile('ImageUrl')) {
            $imageName = time() . '.' . $request->ImageUrl->extension();
            $request->ImageUrl->move(public_path('livre'), $imageName);
            $livre->ImageUrl = 'livre/' . $imageName; // Correction de l'URL de l'image
        }
        if ($request->hasFile('pdf_uploaded')) {
            $pdfName = time() . '.' . $request->pdf_uploaded->extension();
            $request->pdf_uploaded->move(public_path('livre'), $pdfName);
            $livre->pdf_uploaded = 'livre/' . $pdfName; // Stocker le chemin du fichier PDF
        }

        $livre->save();

        return response()->json([
            'success' => true,
            'message' => 'Livre added successfully!',
            'data' => $livre
        ], 201);
    }
    public function updateLivre(Request $request,$id){
        $livre=Livre::find($id);
        if (!$livre) {
            return response()->json([
                'success' => false,
                'message' => 'livre not found!',
            ]);
        }
        $livre->titre = $request->input('titre');
        $livre->description = $request->input('description');

        if ($request->hasFile('ImageUrl')) {
            $imageName = time().'.'. $request->ImageUrl->extension();
            $request->ImageUrl->move(public_path('img'), $imageName);
            $livre->ImageUrl = 'img/'.$imageName; // Correction de l'URL de l'image
        }
        if ($request->hasFile('pdf_uploaded')) {
            $pdfName = time() . '.' . $request->pdf_uploaded->extension();
            $request->pdf_uploaded->move(public_path('livre'), $pdfName);
            $livre->pdf_uploaded = 'livre/' . $pdfName; // Stocker le chemin du fichier PDF
        }


        $livre->save();

        return response()->json([
            'success' => true,
            'message' => 'livre updated successfully!',
            'data' => $livre
        ], 200);
    }
    public function deleteLivre(Request $request,$id){
        $livre=Livre::find($id);
        if (!$livre) {
            return response()->json([
                'success' => false,
                'message' => 'livre not found!',
            ], 404);
        }
    
        $livre->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'livre deleted successfully!',
            'data' => $livre 
        ], 200);
    }
    
    public function show(){
     $livre=Livre::all();
     return response()->json($livre);
    }
    
}
