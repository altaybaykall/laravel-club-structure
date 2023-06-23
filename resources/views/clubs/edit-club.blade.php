<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Clubs</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />


</head>
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
        <form action="/club/edit/save/{{$club->id}}" method="POST" id="club_add" enctype="multipart/form-data">
            @csrf
            <h3 >{{$club->club_name}} Düzenleniyor</h3>
            <input type="hidden" name="id" value="{{encrypt($club->id)}}" >
            <div class="form-group mb-2">
                <label for="name" class="text-muted mb-0"><small>Kulüp adı</small></label>
                <input  value="{{$club->club_name}}" name="club_name" id="name" class="form-control" type="text"  autocomplete="off" />
                @error('club_name')
                <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label for="name" class="text-muted mb-0"><small>Kulüp Kısaltması</small></label>
                <input  value="{{$club->club_slug}}"  name="club_slug" id="name" class="form-control" type="text"  autocomplete="off" />
                @error('club_slug')
                <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                @enderror
            </div>


            <div class="form">
                <label for="content" class="text-muted mb-0"><small>Kulüp Açıklaması</small></label>
                <input  value="{{$club->club_content}}" name="club_content" id="content" class="form-control" type="text" />
                @error('club_content')
                <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="dep" class="text-muted mb-0"><small>Alan</small></label>
                <input  value="{{$club->club_department}}" name="club_department" id="dep" class="form-control" type="text"  autocomplete="off" />
                @error('club_department')
                <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col  ">
                <input type="file" name="file" id="image" placeholder="Resim Seçiniz" accept="image/*"
                      >
                @error('file')
                <p CLASS="alert small alert-danger">{{$message}} </p>
                @enderror
            </div>
            <button type="submit" class="btn btn-default btn-success btn-xs">Kaydet</button>
        </form>



    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>
