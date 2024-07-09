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
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Rating</th>
                    <th>B-Day</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Mohamed Amin ED DARYANI</td>
                    <td>doryaniamin</td>
                    <td>1450</td>
                    <td>21/07/2002</td>
                    <td>22/07/2024</td>
                    <td>
                        <a href="#">
                            <img src="assets/images/icons/accept.svg" alt="delete" title="add" >

                        </a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Mohamed Amin ED DARYANI</td>
                    <td>doryaniamin</td>
                    <td>1450</td>
                    <td>21/07/2002</td>
                    <td>22/07/2024</td>
                    <td>
                        <a href="#">
                            <img src="assets/images/icons/accept.svg" alt="add"  >
                            
                        </a>
                    </td>

                </tr>
                <tr>
                    <td>1</td>
                    <td>Mohamed Amin ED DARYANI</td>
                    <td>doryaniamin</td>
                    <td>1450</td>
                    <td>21/07/2002</td>
                    <td>22/07/2024</td>
                    <td class="td">
                        <a href="#">
                            <img src="assets/images/icons/accept.svg" alt="add"  >
                            
                        </a>
                        <form action="#" method="POST">
                            @csrf
                            @method('DELETE')
                            <button><img src="assets/images/icons/delete2.svg" alt="delete"  ></button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
    
</body>
</html>