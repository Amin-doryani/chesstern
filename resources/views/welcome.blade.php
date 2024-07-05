
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('assets/css/welcome.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>chesstern</title>
</head>
<body>
    <nav>
        <div class="div1"><h1>Chess<span>tern</span></h1></div>
        <div class="div2">
            <a href="#" class="wearehere">Home</a>
            <a href="#">Tournaments</a>
            <a href="#">Contact</a>
            @guest
                <a href="{{Route('login')}}">login</a>
                <a href="{{Route('createuser')}}">sign up</a>
            @endguest
            
            @auth
            <a href="{{route('dashboard')}}">dashboard</a>
                <a href="{{route('logout')}}">logout</a>
            @endauth
        </div>
    </nav>
    <main>
        <h1>Manage Your Chess Tournaments </h1>
        {{-- <h1>Mnage your chess Tournaments </h1> --}}
        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus mollitia iuse error et suscipit sit?</p> --}}
        <p>Organize and manage Swiss chess tournaments effortlessly. Track progress, generate pairings, and ensure a smooth experience for all players.</p>
        <a href="#">Get Started </a>
    </main>
</body>
</html>

