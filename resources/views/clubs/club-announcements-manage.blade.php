@include('home')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
<body class="antialiased">
<div class="d-flex justify-content-center">

    <div>
        <h2>{{$club->club_name}} Duyurular </h2>

            <div style="background-color: #a0aec0; padding: 30px">
                <form action="/club/announcements/new/{{$club->id}}" method="POST" id="club_announcement_new" >
                    @csrf
                    <h4>Yeni Duyuru Oluştur - Kulüp : {{$club->club_name}} </h4>

                    <div class="form-group mb-2">
                        <label for="name" class="text-muted mb-0"><small>Duyuru Başlığı</small></label>
                        <input  name="announcement_title" id="name" class="form-control" type="text"  autocomplete="off" />
                        @error('announcement_title')
                        <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="form">
                        <label for="content" class="text-muted mb-0"><small>Duyuru Açıklaması</small></label>
                        <textarea name="announcement_content" id="content" class="form-control" > </textarea>
                        @error('announcement_content')
                        <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-default btn-success btn-xs">Kaydet</button>
                </form>



                <h1 style="font-size: 2rem"> {{$club->club_name}} Duyuru</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Duyuru Başlık</th>
                        <th scope="col">Duyuru içerik</th>
                        <th scope="col">Oluşturan</th>
                        <th scope="col">Tarih</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($club->announcements as $ca)
                        <tr>
                            <th>{{$ca->announcement_title}}</th>
                            <th>{{$ca->announcement_content}}</th>
                            <td>{{$ca->getAuthor->name}}</td>
                            <td>{{$ca->created_at}}</td>

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
