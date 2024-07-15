<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Game Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .form-actions {
            text-align: center;
        }
        .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #406689;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
        }
        .form-actions button:hover {
            background-color: #29445d;
        }
        .form-actions .back-button{
            background-color: #d9534f;
        }
        .form-actions .back-button:hover {
            background-color: #c9302c;
        }
        article{
            font-size: 1.7em
        }
        h2 span{
            color: #434343;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Set Game Results : <span> {{$game->Player1->name}}({{$game->Player1->elo}})</span> vs <span>  {{$game->Player2->name}}({{$game->Player2->elo}})</span></h2>
    <form action="{{ route('updategameres', $game->id) }}" method="POST" >
        @csrf
        <div class="form-group">
            <label for="name">Game Result: </label>
            <select name="select" id="select">
                <option value="{{$game->Player1->id}}">White Won ({{$game->Player1->name}})</option>
                <option value="0">Draw</option>
                <option value="{{$game->Player2->id}}">Black Won ({{$game->Player2->name}})</option>

            </select>
        </div>
        <div class="form-group">
            <label for="pgn">PGN: </label>
            <textarea id="pgn" name="pgn" rows="4" ></textarea>
        </div>
        
        
       
        <div class="form-actions">
            <button type="submit">Set Result</button>
            <button type="button" class="back-button" onclick="window.history.back()">Back</button>
        </div>
    </form>
</div>

</body>
</html>