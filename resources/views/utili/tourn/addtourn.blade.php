{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Tournment</title>
</head>
<body>
    <form action="#" method="POST">
        <input type="text" name="title" id="title" placeholder="title">
        <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
        
    </form>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Tournament</title>
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
    </style>
</head>
<body>

<div class="form-container">
    <h2>Create New Tournament {{$authid}}</h2>
    <form action="{{ route('tournament.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <textarea id="desc" name="desc" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*" >
        </div>
        <div class="form-group">
            <label for="maxplayers">Max Players</label>
            <input type="number" id="maxplayers" name="maxplayers" required>
        </div>
        <div class="form-group">
            <label for="rounds">Rounds</label>
            <input type="number" id="rounds" name="rounds" required>
        </div>
        
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="public">Public(Any one with the link can request to join)</option>
                <option value="private">Private</option>
            </select>
        </div>
        <div class="form-group">
            <label for="startin">Start Date</label>
            <input type="date" id="startin" name="startin" required>
        </div>
        <div class="form-group">
            <label for="reqendin">Requests End Date</label>
            <input type="date" id="reqendin" name="reqendin" required>
        </div>
        
        
        <div class="form-group">
            <label for="min">Time Control : Minutes</label>
            <input type="number" id="min" name="min" required>
        </div>
        <div class="form-group">
            <label for="sec">Seconds</label>
            <input type="number" id="sec" name="sec" required>
        </div>
        
        <div class="form-actions">
            <button type="submit">Create Tournament</button>
            <button type="button" class="back-button" onclick="window.history.back()">Back</button>
        </div>
    </form>
</div>

</body>
</html>
