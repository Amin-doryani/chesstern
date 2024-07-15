<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rounds</title>
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/players.css')}}">
    <script src="{{asset('assets/js/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/js/rounds.js')}}"></script>

    
</head>
<body>
    @include('nav')
    <article >
        {{-- <select name="round" id="round">
            @foreach ($rounds as $item)
            <option value="{{$item->round}}">Round {{$item->round}}
                @if ($item->round > $tour->round)
                    {{$item->status}}
                @endif
            </option>
            @endforeach
        </select> --}}
    </article>
    <article class="art2">
        <a  class="selected" id="link2">Results</a>
        <a   id="link1">Games</a>
        
    </article>
    <article class="playerart" id="players">
        <?php $a = 1; ?>
        @foreach ($players as $item)
            
        
       <div class="playersdiv">
        <div class="divdiv">
        <span class="res">#{{$a}}</span>
        @if ($item->image == null)
            <img class="playerimg" src="{{asset('assets/images/playerimage/playerimg.png')}}"  alt="player">
        @else
            <img class="playerimg" src="{{asset($item->image)}}"  alt="player">
        @endif
        <h3>{{$item->name}} ({{$item->elo}})</h3>
        </div>
        <div class="spandiv"><span class="po">{{$item->pointes}}/{{$tour->round}}  tiebreack {{$item->tiebreack}} </span></div>
        
       </div>
       <?php $a+=1; ?>
       @endforeach
    </article>
    <article id="games">
        <div class="select">
            <h1>Round {{$tour->round}}</h1>
            <select name="round" id="round">
                @foreach ($rounds as $item)
                <option value="{{$item->round}}">Round {{$item->round}}
                    @if ($item->round > $tour->round)
                        {{$item->status}}
                    @endif
                </option>
                @endforeach
            </select>
        </div>
        <?php $b=1?>
        @foreach ($games as $item)
        <div class="game">

            <h1> {{$b}}</h1>
            <?php $b+=1 ?>
            <div class="gamediv1">
                <h4>{{$item->Player2->name}}({{$item->Player2->elo}})</h4>
            </div>
            <div class="gamediv2">
                <img src="{{asset('assets/images/backgrounds/chessboard.png')}}" alt="board">
            </div>
            <div class="gamediv3"><h4>{{$item->Player1->name}}({{$item->Player1->elo}})</h4></div>
            <div>
                <a href="/setgameres/{{$item->id}}/{{$item->idter}}" class="setgameres">Set game result</a>
            </div>
        </div>
        @endforeach
        
        
        
        
    </article>
    <article>
         <a href="{{Route('newround',$tour->id)}}" class="newround">Start New Round</a>
    </article>
</body>
</html>