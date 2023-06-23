@include('home')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
<body class="antialiased">

<div class="d-flex justify-content-center">
    <div class="container-md">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Rol</th>
            <th>Düzenle</th>

        </tr>
        </thead>
        <tbody>
       @foreach($roles as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td><a href="role/edit/{{encrypt($user->id)}}">Düzenle</a> </td>
        </tr>
       @endforeach
        </tbody>
    </table>
</div>
</div>
</body>
