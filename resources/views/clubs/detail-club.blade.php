@include('home')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
<body class="antialiased">
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>
<div class="d-flex justify-content-center">

    <div>
        <h2>{{$club->club_name}}</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Kulüp adı</th>
                <th scope="col">Kulüp kısa</th>
                <th scope="col">İçerik</th>
                <th scope="col">Bölüm</th>
                <th scope="col">Logo</th>
                <th scope="col">Kuruluş Tarihi</th>
                <th scope="col">üyeler</th>
                @auth<th>Katıl</th>@endauth
            </tr>
            </thead>
            <tbody>

                <tr>
                    <th>{{$club->club_name}}</th>
                    <th>{{$club->club_slug}}</th>
                    <td>{{$club->club_content}}</td>
                    <td>{{$club->club_department}}</td>
                    <td><img style="height: 25px ; width: 25px;" src="/storage/club_logos/{{$club->club_logo}}"></td>
                    <td>{{$club->created_at}}</td>
                    <td>{{$approved->pluck('name')}}</td>

                    @auth

                        <td><form action="/club/user/left/{{$club->id}}" method="POST">
                                @csrf
                                <button class="btn-danger" type="submit" >Ayrıl</button>
                            </form></td>
                        @can('update',$club)
                            <td> <form action="/club/edit/{{$club->id}}">
                                    @csrf
                                    <button class="btn-info" type="submit" >Düzenle</button>
                                </form></td>
                            <td> <form  method="POST" action="/club/delete/{{$club->id}}">
                                    @csrf
                                    <button class="btn-danger" type="submit" >SİL</button>
                                </form></td>@endauth @endcan
                </tr>
            </tbody>
        </table>

        @can('update', $club)
        <div style="background-color: #a0aec0; padding: 30px">
            <form action="/club/event/new/{{$club->id}}" method="POST" id="club_add" >
                @csrf
                <h4>YENİ EVENT EKLE - Kulüp : {{$club->club_name}} </h4>

                <div class="form-group mb-2">
                    <label for="name" class="text-muted mb-0"><small>Event Adı</small></label>
                    <input  name="event_title" id="name" class="form-control" type="text"  autocomplete="off" />
                    @error('club_name')
                    <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                </div>


                <div class="form">
                    <label for="content" class="text-muted mb-0"><small>Event Açıklaması</small></label>
                    <input name="event_content" id="content" class="form-control" type="text" />
                    @error('club_content')
                    <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="dep" class="text-muted mb-0"><small>Başlangıç Tarihi</small></label>
                    <input name="event_start_date" id="dep" class="form-control" type="date"  autocomplete="off" />

                </div>
                <div class="form-group mb-2">
                    <label for="dep" class="text-muted mb-0"><small>Bitiş Tarihi</small></label>
                    <input name="event_finish_date" id="dep" class="form-control" type="date"  autocomplete="off" />

                </div>

                <button type="submit" class="btn btn-default btn-success btn-xs">Kaydet</button>
            </form>
            @endcan
            <h1 style="font-size: 2rem"> {{$club->club_name}} Etkinlikleri</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Event adı</th>
                    <th scope="col">Event İçerik</th>
                    <th scope="col">Bşlngç Tarih</th>
                    <th scope="col">Bitiş Tarih</th>
                    <th>Kulüp</th>
                    <th>Oluşturan</th>
                </tr>
                </thead>
                <tbody>
                @foreach($club->events as $event)
                    <tr>
                        <th>{{$event->event_title}}</th>
                        <th>{{$event->event_content}}</th>
                        <td>{{$event->event_start_date}}</td>
                        <td>{{$event->event_finish_date}}</td>
                        <td>{{$event->club}}</td>
                        <td>{{$event->event_owner}}</td>
                        @can('clubEvent-join')
                        <td><form action="/club/user/join/{{$club->id}}" method="POST">
                                @csrf
                                <button class="btn-primary" type="submit" >Katıl</button>
                            </form></td>

                        <td><form action="/club/user/join/{{$club->id}}" method="POST">
                                @csrf
                                <button class="btn-danger" type="submit" >Ayrıl</button>
                            </form></td>
                        @endcan
                        @can('update',$club)
                            <td> <form  method="POST" action="/club/event/delete/{{$event->id}}">
                                    @csrf
                                    <button class="btn-danger" type="submit" >Sil</button>
                                </form></td>
                            <td> <form  action="/club/event/edit/{{$event->id}}">
                                    @csrf
                                    <button class="btn-info" type="submit" >Düzenle</button>
                                </form></td>
                        @endcan


                    </tr>
                @endforeach
                </tbody>
            </table>

            @can('update',$club)
            <h1 style="font-size: 2rem"> ONAY BEKLEYEN ÜYELER</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Adı</th>
                    <th scope="col">Email</th>
                    <th>Onay</th>
                    <th>Red</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pending as $pe)
                    <tr>
                        <th>{{$pe->name}}</th>
                        <th>{{$pe->email}}</th>
                        @can('update',$club)
                            <td> <form  method="POST" action="/club/user/accept/{{$pe->id}}/{{$club->id}}">
                                    @csrf
                                    <button class="btn-danger" type="submit" >Onay</button>
                                </form></td>
                            <td> <form  method="POST" action="/club/user/deny/{{$pe->id}}/{{$club->id}}">
                                    @csrf
                                    <button class="btn-info" type="submit" >Red</button>
                                </form></td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            @endcan

    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>
