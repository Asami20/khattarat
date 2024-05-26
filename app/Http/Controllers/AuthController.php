<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;

class AuthController extends Controller
{
    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', 
            'c_password' => 'required|same:password',
            'phone' => 'required|string',
            'username' => 'required|string|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Création de l'utilisateur
        $user = new User();
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->c_password= Hash::make($request->input('c_password'));
        $user->phone = $request->input('phone');
        $user->username = $request->input('username');
        
        // Génération et enregistrement du code de vérification
        $user->verification_code = mt_rand(100000, 999999);
    
        // Envoi de l'email de vérification
        Mail::to($user->email)->send(new VerificationMail($user, $user->verification_code));
        $user->save();

        return response()->json(['message' => 'Utilisateur créé avec succès. Un email de vérification a été envoyé.'], 201);
    }
    
    public function Login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Login successful', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
        }
    }
}
