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
                <th scope="col">Kulüp Yöneticisi</th>
                <th scope="col">Kuruluş Tarihi</th>


            </tr>
            </thead>
            <tbody>

                <tr>
                    <th>{{$club->club_name}}</th>
                    <th>{{$club->club_slug}}</th>
                    <td>{{$club->club_content}}</td>
                    <td>{{$club->club_department}}</td>
                    <td><img style="height: 25px ; width: 25px;" src="/storage/club_logos/{{$club->club_logo}}"></td>
                    <td>{{$club->getManager->name}}</td>
                    <td>{{$club->created_at}}</td>



                    @auth
                       @can('memberLeft',$club)
                        <td><form action="/club/user/left/{{$club->id}}" method="POST">
                                @csrf
                                <button class="btn-danger" type="submit" >Ayrıl</button>
                            </form></td>@endcan
                           @can('update',$club)
                               <td> <form action="/club/detay/yonet/{{$club->id}}">
                                       @csrf
                                       <button class="btn-info" type="submit" >Yönet</button>
                                   </form></td>
                           @endcan
                          @endauth
                </tr>
            </tbody>
        </table>

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
                       @can('view',$event)
                        <td><form action="/club/event/join/{{$event->id}}" method="POST">
                                @csrf
                                <button class="btn-primary" type="submit" >Etkinliğe Katıl</button>
                            </form></td>
                             @else
                        <td><form action="/club/event/left/{{$event->id}}" method="POST">
                                @csrf
                                <button class="btn-danger" type="submit" >Etkinlikten Ayrıl</button>
                            </form></td>

                            @endcan


                    </tr>
                @endforeach
                </tbody>
            </table>

            <h1 style="font-size: 2rem"> AKTİF KULÜP ÜYELER</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Adı</th>

                </tr>
                </thead>
                <tbody>
                @foreach($approved as $pe)
                    <tr>
                        <th>{{$pe->name}}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>



</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>
