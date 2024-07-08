@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
    {{-- <link rel="stylesheet" href="{{URL::asset('assets/css/dashboard.css')}}"> --}}
    <title>Dashboard</title>
</head>
<body>
    <main class="main">
        <div class="div1">
            <h1>chesstern</h1>
        </div>
        <div class="div2">
            <h1>Manage your chess tournemnts</h1>
            <h3>Swiss chess Tournemtns</h3>
            <a href="#" class="maina">Create New Tournemnets</a>
        </div>
        <div class="div3">
            @auth
            <a href="{{route('logout')}}"><img src="assets/images/icons/logouticon.svg" alt="logout" title="logout" ></a>
            @endauth
            
        </div>
    </main>
    <section class="sec0">
        <h2>Main Page</h2>
    </section>
    <section class="sec1">
        <div class="sec1div1">
            <input type="text" name="ser" id="ser" placeholder="Search">
            <button><img src="assets/images/icons/search.svg" alt="search"></button>
        </div>
        
        <div class="sec1div2">
            <a href="{{route('addtournament')}}"><img src="assets/images/icons/add.svg" alt="add">Create Tournament</a>
        </div>
    </section>
    <section class="sec2">
        
        <article>
            <div class="sec2div1">
                <img src="assets/images/tournimages/pawn.webp" alt="tourn">
            </div>
            <div class="sec2div2">
                <h2>Al hoceima 2022/2023</h2>
                <p>Hi there, if you face any problem contact us, confirm your order and if you can put a good comment it will be grateful thank you</p>
            </div>
            <div class="sec2div3">
                <a href="#" class="roundes">5/7</a>
                <a href="#" class="players"><img src="assets/images/icons/group.svg" alt="group">95/100</a>
                <a href="#" class="request">requsets <span></span></a>
                <a href="#" class="add"><img src="assets/images/icons/add2.svg" alt="add">add</a>
                <a href="#" class="delete"><img src="assets/images/icons/delete.svg" alt="delete">delete</a>
                <a href="#" class="link"><img src="assets/images/icons/link.svg" alt="link" title="link"></a>
            </div>
        </article>


        @foreach ($tourn as $item)
        <article>
            <div class="sec2div1">
                <img src="{{asset($item->image)}}" alt="tourn">
            </div>
            <div class="sec2div2">
                <h2>{{$item->titel}}</h2>
                <p>{{ str::limit(strip_tags($item->desc), 150) }}</p>
            </div>
            <div class="sec2div3">
                <a href="#" class="roundes">Round : {{$item->round}}/{{$item->rounds}}</a>
                <a href="#" class="players"><img src="assets/images/icons/group.svg" alt="group">{{$item->players_count}}/{{$item->maxplayers}}</a>
                @if ($item->requests>0)
                    <a href="#" class="request">requsets <span></span> ({{{$item->requests}}})</a>
                @else
                <a href="#" class="request">requsets</a>
                @endif
                
                <a href="{{route('addplayer',['id'=>$item->id])}}" class="add"><img src="assets/images/icons/add2.svg" alt="add">add</a>
                <form action="{{route ('tournament.destroy',$item->id)}}" method="post" class="delete">  
                    @csrf
                    @Method('DELETE')
                    <button type="submit" ><img src="assets/images/icons/delete.svg" alt="delete"> delete</button>
                </form>
                {{-- <a href="#" class="delete"><img src="assets/images/icons/delete.svg" alt="delete">delete</a> --}}
                <a href="#" class="link"><img src="assets/images/icons/link.svg" alt="link" title="link"></a>
            </div>
        </article>
        @endforeach
        
        
    </section>
        
</body>
</html>





