@include('home')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
<body class="antialiased">

<div class="d-flex justify-content-center">

<div>
    <h2>Üye olduğum Kulüpler</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Kulüp adı</th>
            <th scope="col">Kulüp kısa</th>
            <th scope="col">İçerik</th>
            <th scope="col">Bölüm</th>
            <th scope="col">Logo</th>
            <th scope="col">Kuruluş Tarihi</th>
            <th scope="col">Kulüp Yöneticisi</th>
            @auth<th>Detay</th>@endauth
        </tr>
        </thead>
        <tbody>
        @foreach($myclubs as $myclub)
            <tr>
                <th>{{$myclub->club_name}}</th>
                <th>{{$myclub->club_slug}}</th>
                <td>{{$myclub->club_content}}</td>
                <td>{{$myclub->club_department}}</td>
                <td><img style="height: 25px ; width: 25px;" src="storage/club_logos/{{$myclub->club_logo}}"></td>
                <td>{{$myclub->created_at}}</td>
                <td>{{$myclub->getManager->name}}</td>
                <td><a href="/club/detay/{{$myclub->id}}"><button class="btn btn-primary">Göster</button></a></td>
            </tr>

        @endforeach
        </tbody>
    </table>
    --
    <h2>Kulüpler</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Kulüp adı</th>
            <th scope="col">Kulüp kısa</th>
            <th scope="col">İçerik</th>
            <th scope="col">Bölüm</th>
            <th scope="col">Logo</th>
            <th scope="col">Kuruluş Tarihi</th>
            <th scope="col">Kulüp Yöneticisi</th>
            @auth<th>Katıl</th>@endauth
        </tr>
        </thead>
        <tbody>
        @foreach($clubs as $club)
            <tr>
            <th>{{$club->club_name}}</th>
                <th>{{$club->club_slug}}</th>
            <td>{{$club->club_content}}</td>
            <td>{{$club->club_department}}</td>
            <td><img style="height: 25px ; width: 25px;" src="storage/club_logos/{{$club->club_logo}}"></td>
                <td>{{$club->created_at}}</td>
                <td>{{$club->club_manager}}</td>
                <td><form action="/club/user/join/{{$club->id}}" method="POST">
                        @csrf
                        <button class="btn-primary" type="submit" >Katıl</button>
                    </form></td>
                <td><a href="/club/detay/{{$club->id}}"><button class="btn btn-primary">Göster</button></a></td>
        </tr>

        @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>
