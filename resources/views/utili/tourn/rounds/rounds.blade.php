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
        <div class="spandiv"><span class="po">{{$item->pointes}}/{{$tour->round}}   </span></div>
        @push('scripts')
        <script>
            const idter = {{ $tour->id }};
        
        </script>
        @endpush
       </div>
       <?php $a+=1; ?>
       @endforeach
    </article>
    <article id="games">
        {{-- <div class="select">
            <h1>Round {{$tour->round}}</h1>
            <select name="round" id="mySelect" >
                @foreach ($rounds as $item)
                <option value="{{$item->round}}">Round {{$item->round}}
                    @if ($item->round > $tour->round)
                        {{$item->status}}
                    @endif
                </option>
                @endforeach
            </select>
        </div> --}}
        <?php $b=1?>
        @foreach ($games as $item)
        
        @if ($item->res !== null)
        <?php 
        $theres = $item->res;
        if ($theres == $item->Player1->id) {
            $ress = "White";
        }elseif ($theres == $item->Player2->id) {
            $ress = "Black";
        }else {
            $ress = "Draw";
        }
        
        ?>
        <div class="game">
            <h1> {{$b}}</h1>
            <?php $b+=1 ?>
            <div class="gamediv1">
                <h4>
                    @if ($item->Player2->pointes !== null)
                 <span class="spanpo">{{$item->Player2->pointes}}</span>
                @else
                <span class="spanpo">0.0</span>
                @endif
                    
                    {{$item->Player2->name}}({{$item->Player2->elo}})</h4>
            </div>
            <div id="gamediv2" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/images/backgrounds/chessboard.png') }}'); background-size: cover; background-position: center;width: 350px;
            height: 350px;">
            
            @if($ress === "White")
                <h1>White WON</h1>
            @elseif($ress === "Black")
                <h1>Black WON</h1>
            @else
                <h1 id="draw">Draw</h1>
            @endif

            
                
            </div>
            <div class="gamediv3" ><h4>
                
                @if ($item->Player1->pointes!== null)
                 <span class="spanpo">{{$item->Player1->pointes}}</span>
                @else
                <span class="spanpo">0.0</span>
                @endif
                
                {{$item->Player1->name}}({{$item->Player1->elo}})</h4></div>
            <div>
                <a href="#" class="setgameres" id="blockedbutton">Set game result</a>
            </div>
        </div>



        @else
        <div class="game">

            <h1> {{$b}}</h1>
            <?php $b+=1 ?>
            <div class="gamediv1">
                <h4>
                    @if ($item->Player2->pointes!== null)
                 <span class="spanpo">{{$item->Player2->pointes}}</span>
                @else
                <span class="spanpo">0.0</span>
                @endif
                    
                    
                    {{$item->Player2->name}}({{$item->Player2->elo}})</h4>
            </div>
            <div class="gamediv2">
                <img src="{{asset('assets/images/backgrounds/chessboard.png')}}" alt="board">
            </div>
            <div class="gamediv3">
                @if ($item->Player1->pointes!== null)
                 <span class="spanpo">{{$item->Player1->pointes}}</span>
                @else
                <span class="spanpo">0.0</span>
                @endif
                
                
                    <h4>{{$item->Player1->name}}({{$item->Player1->elo}})</h4></div>
            <div>
                <a href="/setgameres/{{$item->id}}/{{$item->idter}}" class="setgameres">Set game result</a>
            </div>
        </div>
        @endif
            
        @endforeach
        
        
        
        
    </article>
    <article>
        @if ($tour->rounds>$tour->round)
        <a href="{{Route('newround',$tour->id)}}" class="newround">Start New Round</a>
        @endif
         
    </article>
    <script src="{{asset('assets/js/rounds.js')}}"></script>
</body>
</html>