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
    <div id="overlay"></div>



    



    @include('nav')
    <main class="main">
        
        <div class="div2">
            <h1>Manage your chess tournemnts</h1>
            <h3>Swiss chess Tournemtns</h3>
            <a href="#" class="maina">Create New Tournemnets</a>
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
                <a href="{{route('roundsid',$item->id)}}" class="roundes">Round : {{$item->round}}/{{$item->rounds}}</a>
                <a href="{{route('playersintourna',$item->id)}}" class="players"><img src="assets/images/icons/group.svg" alt="group">{{$item->players_count}}/{{$item->maxplayers}}</a>
                @if ($item->requests>0)
                    <a href="{{route('requests.show',$item)}}" class="request">requsets <span></span> ({{{$item->requests}}})</a>
                @else
                <a href="{{route('requests.show',$item)}}" class="request">requsets</a>
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





