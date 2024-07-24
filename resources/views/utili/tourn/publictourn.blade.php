@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>public tournaments</title>
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/public.css')}}">

</head>
<body>
    @include('nav')
    <section class="sec44">
        
        @foreach ($tourn1 as $item)
            <article class="lastart">
                    <div class="div1">
                        <img src="{{asset($item->image)}}" alt="tourn">
                    </div>
                    <div class="div2">
                        <h2>{{$item->titel}}</h2>
                        <p>{{ str::limit(strip_tags($item->desc), 100) }}</p>
                    </div>
                    <div class="div3">
                        <a href="#" class="roundes">Round : {{$item->round}}/{{$item->rounds}}</a>
                        <a href="#" class="players"><img src="assets/images/icons/group.svg" alt="group">{{$item->players_count}}/{{$item->maxplayers}}</a>
                        <a href="{{route('addplayer',['id'=>$item->id])}}" class="add"><img src="assets/images/icons/add2.svg" alt="add">join</a>
                    </div>
                </article>
        @endforeach
    </section>
</body>
</html>