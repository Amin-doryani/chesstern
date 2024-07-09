
    <nav class="nav">
        <div class="div1"><h1>Chess<span>tern</span></h1></div>
        <div class="div2">
            <a href="{{route('dashboard')}}">Accueil</a>
            <a href="#">My Tournaments</a>
            
            <a href="#">Public Tournaments</a>
            @auth
            <a href="{{route('logout')}}" class="logout"><img src="assets/images/icons/logouticon.svg" alt="logout" title="logout" ></a>
            @endauth
        </div>
    </nav>

