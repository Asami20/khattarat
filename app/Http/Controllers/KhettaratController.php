<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Importer le bon espace de noms

use App\Models\Khettarat;
class KhettaratController extends Controller
{
    public function addKhetrrat(Request $request){
        $validatedData = Validator::make($request->all(), [ 
            'titre' => 'required|string|max:255',
            'bénévole' => 'required|string',
            'guide' => 'required|string',
            'description' => 'required|string',
            'ImageUrl' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'error' => $validatedData->errors()
            ], 422);
        }
        $Khettarat = new Khettarat();
        $Khettarat->titre = $request->titre;
        $Khettarat->bénévole = $request->bénévole;
        $Khettarat->guide = $request->guide;
        $Khettarat->description = $request->description;
        if ($request->hasFile('ImageUrl')) {
            $imageName = time() . '.' . $request->ImageUrl->extension();
            $request->ImageUrl->move(public_path('Khettarat'), $imageName);
            $Khettarat->ImageUrl = 'Khettarat/' . $imageName; // Correction de l'URL de l'image
        }
       

        $Khettarat->save();

        return response()->json([
            'success' => true,
            'message' => 'Khettarat added successfully!',
            'data' => $Khettarat
        ], 201);
    }
    public function updateKhettarat(Request $request,$id){
        $khettarat= Khettarat::find($id);
        if(!$khettarat){
           
        return response()->json([
            'success' => false,
            'message' => 'khettera not found!',
        ], 204);
        }
         $khettarat->titre = $request->input('titre');
         $khettarat->bénévole = $request->input('bénévole');
         $khettarat->guide = $request->input('guide');

         $khettarat->description = $request->input('description');

        if ($request->hasFile('ImageUrl')) {
            $imageName = time().'.'. $request->ImageUrl->extension();
            $request->ImageUrl->move(public_path('img'), $imageName);
             $khettarat->ImageUrl = 'img/'.$imageName; // Correction de l'URL de l'image
        }
    
         $khettarat->save();

        return response()->json([
            'success' => true,
            'message' => 'Khettarat updated successfully!',
            'data' =>  $khettarat
        ], 200);
    }
    public function deleteKhettarat(Request $request,$id){
         $khettarat=Khettarat::find($id);
        if (!$khettarat) {
            return response()->json([
                'success' => false,
                'message' => 'Khettarat not found!',
            ], 404);
        }
    
         $khettarat->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Khettarat deleted successfully!',
            'data' =>  $khettarat 
        ], 200);
    }
    
    public function show(){
      $khettarat=Khettarat::all();
     return response()->json($khettarat);
    }
    }

