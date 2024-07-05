<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <title>login</title>
</head>
<body  >
    <main>
    <form action="{{Route("checklogin")}}" method="POST">
        @csrf
        <input type="text" name="email" id="email" placeholder="email">
        <input type="password" name="pass" id="pass" placeholder="password">
        <button type="submit">submit</button>
    </form>
    </main>
</body>
</html>
