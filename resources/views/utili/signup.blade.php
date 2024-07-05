<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
</head>
<body>
    <main>
        <form action="{{Route("storeuser")}}" method="POST">
            @csrf
            <input type="text" name="name" id="name" placeholder="name">
            <input type="text" name="lastname" id="lastname" placeholder="last name">
            <input type="text" name="email" id="email" placeholder="email">
            <input type="password" name="pass" id="pass">
            <button type="submit">submit</button>
        
        
        </form>
    </main>
</body>
</html>
