<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rounds</title>
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
    <style>
        article {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 300px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            font-size: 16px;
            box-sizing: border-box;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        option {
            padding: 10px;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper:before {
            content: '\25BC';
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .select-wrapper:hover select {
            background-color: #406689;
            color: #fff;
        }
        
        article a{
            text-decoration: none;
            color: black;
            width: 50%;
            text-align: center;
            
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }
        .art2{
            width: 80%;
            display: flex;
            justify-content: space-between;
            padding: 0px 0px;
            height: 80px;
            align-items: center;
        }
        #selected{
            background-color: #406689;
            color: white;
        }
    </style>
</head>
<body>
    @include('nav')
    <article >
        <select name="round" id="round">
            @foreach ($rounds as $item)
            <option value="{{$item->round}}">Round {{$item->round}}
                @if ($item->round > $tour->round)
                    {{$item->status}}
                @endif
            </option>
            @endforeach
        </select>
    </article>
    <article class="art2">
        <a href="#" id="selected">Results</a>
        <a href="#" >Matches</a>
        
    </article>
    <article>
       
    </article>
</body>
</html>