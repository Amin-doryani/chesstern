<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add player</title>
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
    <h2>Add Player </h2>
    <form action="{{ route('storePlayer', $idter) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="username">Username: </label>
            <textarea id="username" name="username" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*" >
        </div>
        <div class="form-group">
            <label for="elo">Elo: </label>
            <input type="number" id="elo" name="elo" required>
        </div>
        <div class="form-group">
            <label for="startin"> B-Year</label>
            <input type="date" id="date" name="date" required>
        </div>
       
        <div class="form-actions">
            <button type="submit">Add Player</button>
            <button type="button" class="back-button" onclick="window.history.back()">Back</button>
        </div>
    </form>
</div>

</body>
</html>