<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallerie; 
use Illuminate\Support\Facades\Validator;

class GallerieController extends Controller
{
    public function addImage(Request $request) 
    {
        $validatedData = Validator::make($request->all(), [
            'titre' => 'required',
            'description' => 'required',
            'ImageUrl' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'error' => $validatedData->errors()
            ], 422);
        }

        $img = new Gallerie();
        $img->titre = $request->titre;
        $img->description = $request->description;

        if ($request->hasFile('ImageUrl')) {
            $imageName = time().'.'. $request->ImageUrl->extension();
            $request->ImageUrl->move(public_path('img'), $imageName);
            $img->ImageUrl = 'img/'.$imageName; // Correction de l'URL de l'image
        }

        $img->save();

        return response()->json([
            'success' => true,
            'message' => 'Image added successfully!',
            'data' => $img
        ], 201);
    }
    public function UpdateImg(Request $request,$id_gallerie){
        $img=Gallerie::find($id_gallerie);
        if (!$img) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found!',
            ]);
        }
        $img->titre = $request->input('titre');
        $img->description = $request->input('description');

        if ($request->hasFile('ImageUrl')) {
            $imageName = time().'.'. $request->ImageUrl->extension();
            $request->ImageUrl->move(public_path('img'), $imageName);
            $img->ImageUrl = 'img/'.$imageName; // Correction de l'URL de l'image
        }

        $img->save();

        return response()->json([
            'success' => true,
            'message' => 'image updated successfully!',
            'data' => $img
        ], 200);
       }

    
       public function delete(Request $request, $id_gallerie)
       {
           // Rechercher l'image par son ID
           $img = Gallerie::find($id_gallerie);
       
           // Vérifier si l'image existe
           if (!$img) {
               return response()->json([
                   'success' => false,
                   'message' => 'Image not found!',
               ], 404);
           }
       
           // Supprimer l'image de la base de données
           $img->delete();
       
           // Retourner une réponse JSON confirmant la suppression de l'image
           return response()->json([
               'success' => true,
               'message' => 'Image deleted successfully!',
               'data' => $img 
           ], 200);
       }
       
       public function show(){
        $img=Gallerie::all();
        return response()->json($img);
       }
}
