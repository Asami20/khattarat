<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de l'Email</title>
</head>
<body>
    <h1>Vérifiez votre adresse email</h1>
    <p>Bonjour {{ $user->name }},</p>
    <p>Merci de vous être inscrit. Veuillez utiliser le code suivant pour vérifier votre adresse email :</p>
    <h2>{{ $verificationCode }}</h2>
    <p>Si vous n'avez pas créé de compte, aucune autre action n'est nécessaire.</p>
    <p>Cordialement,<br>L'équipe {{ config('app.name') }}</p>
</body>
</html>
