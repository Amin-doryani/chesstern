<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/req.css')}}">
    <title>Requests</title>
</head>
<body>
    @include('nav')

    <main>
        <h1>Peaple that requested to join this Tournament: </h1>
        <br>
        <br>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Rating</th>
                    <th>B-Day</th>
                    <th>Request Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               
                            
               
                <?php $a = 1;?>
                @foreach ($data as $item)
                
                <tr>
                    <td>{{$a}}</td>
                    <?php $a+=1 ?>
                    
                    <td>
                        @if ($item->image == null)
                            <img class="playerimage" src="{{asset('assets/images/playerimage/playerimg.png')}}"  alt="player2">
                        @else
                        <img class="playerimage" src="{{asset($item->image)}}"  alt="player">
                        @endif
                        {{-- <img class="playerimage" src="{{asset('assets/images/playerimage/hakimi.jpg')}}"  alt=""> --}}
                    </td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->elo}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->created_at}}</td>
                    <td class="td">
                        <a href="addtoplayers/{{$item->id}}/{{$item->idter}}" class="accept">
                            <img src="{{asset('assets/images/icons/accept.svg')}}" alt="add"  >
                            
                        </a>
                        <form action="{{route('requests.destroy',$item->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button><img src="{{asset('assets/images/icons/delete2.svg')}}" alt="delete"  ></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    
</body>
</html>