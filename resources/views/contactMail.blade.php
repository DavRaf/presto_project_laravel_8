<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h1>Buongiorno amministrazione</h1>
    <h2>Hai ricevuto un contatto da:</h2>
    <h2>{{$contact->user->email}}</h2>
    <h4>Il messaggio contiene:</h4>
    <p>{{$contact->message}}</p>

</body>
</html>