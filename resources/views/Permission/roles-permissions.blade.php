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
            @foreach($perm['permissions'] as $u)
                <tr>
                    <th scope="row">{{$u->id}}</th>
                    <th scope="row">{{$u->name}}</th>
                    <td><form action="/role/remove-perm/{{encrypt($perm->id)}}/{{$u->name}}" method="POST">
                            @csrf
                            <button class="btn-primary" type="submit" >Kaldır</button>
                        </form></td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <th>Yetki Olmayanlar</th>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th>Perm</th>
            </tr>
            </thead>
            <tbody>
            @foreach($nothave as $u)
                <tr>
                    <th scope="row">{{$u->id}}</th>
                    <th scope="row">{{$u->name}}</th>
                    <td><form action="/role/new-perm/{{encrypt($perm->id)}}/{{$u->name}}" method="POST">
                            @csrf
                            <button class="btn-primary" type="submit" >Ekle</button>
                        </form></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
