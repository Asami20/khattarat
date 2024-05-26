<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
{
    
           
    public function addPub(Request $request)
    {
        // Étendre la validation pour inclure le fichier PDF
        $validatedData = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|string',
            'ImageUrl' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf_uploaded' => 'nullable|file|mimes:pdf|max:10000' // Validation du fichier PDF
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'error' => $validatedData->errors()
            ], 422);
        }
        $Publication = new Publication();
        $Publication->titre = $request->titre;
        $Publication->description = $request->description;
        $Publication->duree = $request->duree;

        if ($request->hasFile('ImageUrl')) {
            $imageName = time() . '.' . $request->ImageUrl->extension();
            $request->ImageUrl->move(public_path('Publication'), $imageName);
            $Publication->ImageUrl = 'Publication/' . $imageName; // Correction de l'URL de l'image
        }
        if ($request->hasFile('pdf_uploaded')) {
            $pdfName = time() . '.' . $request->pdf_uploaded->extension();
            $request->pdf_uploaded->move(public_path('Publication'), $pdfName);
            $Publication->pdf_uploaded = 'Publication/' . $pdfName; // Stocker le chemin du fichier PDF
        }

        $Publication->save();

        return response()->json([
            'success' => true,
            'message' => 'Publication added successfully!',
            'data' => $Publication
        ], 201);
    }
    public function updatePub(Request $request,$id){
        $Publication=Publication::find($id);
        if (!$Publication) {
            return response()->json([
                'success' => false,
                'message' => 'Publication not found!',
            ]);
        }
        $Publication->titre = $request->input('titre');
        $Publication->description = $request->input('description');
        $Publication->duree = $request->input('duree');

        if ($request->hasFile('ImageUrl')) {
            $imageName = time().'.'. $request->ImageUrl->extension();
            $request->ImageUrl->move(public_path('img'), $imageName);
            $Publication->ImageUrl = 'img/'.$imageName; // Correction de l'URL de l'image
        }
        if ($request->hasFile('pdf_uploaded')) {
            $pdfName = time() . '.' . $request->pdf_uploaded->extension();
            $request->pdf_uploaded->move(public_path('Publication'), $pdfName);
            $Publication->pdf_uploaded = 'Publication/' . $pdfName; // Stocker le chemin du fichier PDF
        }


        $Publication->save();

        return response()->json([
            'success' => true,
            'message' => 'Publication updated successfully!',
            'data' => $Publication
        ], 200);
    }
    public function deletePub(Request $request,$id){
        $Publication=Publication::find($id);
        if (!$Publication) {
            return response()->json([
                'success' => false,
                'message' => 'Publication not found!',
            ], 404);
        }
    
        $Publication->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Publication deleted successfully!',
            'data' => $Publication 
        ], 200);
    }
    
    public function show(){
     $Publication=Publication::all();
     return response()->json($Publication);
    }
}
