<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;

class VerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        $user = User::find($request->user()->id);

        // Générer un code de vérification unique
        $verificationCode = mt_rand(100000, 999999);

        // Stocker le code de vérification dans la base de données
        $user->verification_code = $verificationCode;
        $user->save();

        // Envoyer l'email de vérification
        Mail::to($user->email)->send(new VerificationMail($user, $verificationCode));

        return response()->json(['message' => 'Email de vérification envoyé!']);
    }
    public function verifyEmail(Request $request)
{
    $user = User::where('verification_code', $request->input('verification_code'))->first();

    if ($user) {
        $user->email_verified_at = now();
       

        return response()->json(['message' => 'Email vérifié avec succès!']);
    } else {
        return response()->json(['message' => 'Code de vérification invalide.'], 400);
    }
}

}
