<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;


class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nom_complet' => 'required|string|max:255',
            'titre_message' => 'required|string|max:255',
            'contenu_message' => 'required|string',
        ]);


        $message = \App\Models\Message::create([
            'email' => $request->email,
            'nom_complet' => $request->nom_complet,
            'titre_message' => $request->titre_message,
            'contenu_message' => $request->contenu_message,
        ]);
        
        

        return response()->json($message, 201);
    }
}
