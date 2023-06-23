<?php

use App\Http\Controllers\ClubAdminController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubEventsController;
use App\Http\Controllers\ClubUsersController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authorize;


Route::get('/', function () {
    return redirect('/login');
});
Route::get('/home', function () {
    return redirect('/login');
});


// Kulüp Show
Route::get('/club',[ClubController::class,'getClubs']);
Route::get('/club/detay/{club}',[ClubController::class,'getClubDetail']);


//Kulüp Crud Routes
    Route::get('/club/add',[ClubAdminController::class,'getCreateClub']);
    Route::post('/club/add',[ClubAdminController::class,'addClub']);
    Route::get('/club/edit/{id}',[ClubAdminController::class,'editClub']);
    Route::post('/club/edit/save/{club}',[ClubAdminController::class,'editSaveClub']);
    Route::post('/club/delete/{club}',[ClubAdminController::class,'deleteClub']);


// Kulübe Katılma
    Route::post('/club/user/join/{club}', [ClubUsersController::class, 'userJoinClub']);
    Route::post('/club/user/left/{id}', [ClubUsersController::class, 'userLeftClub']);
    Route::post('/club/user/accept/{id}/{clubId}',[ClubUsersController::class,'userAccept'])->middleware('permission:club-userAccept');
    Route::post('/club/user/deny/{id}/{clubId}',[ClubUsersController::class,'userDeny'])->middleware('permission:club-userRevoke');

// Kulüp Event Routes
    Route::get('/club/event/edit/{event}',[ClubEventsController::class,'editClubEvent']);
    Route::post('/club/event/edit/save/{event}',[ClubEventsController::class,'editClubEventSave']);
    Route::post('/club/event/delete/{event}',[ClubEventsController::class,'deleteClubEvent']);
    Route::post('/club/event/new/{id}',[ClubEventsController::class,'addClubEvent']);


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['role:Super-Admin']], function () {
    Route::get('/roles-control', [DashboardController::class, 'getRoles']);
    Route::get('/role/edit/{id}', [DashboardController::class, 'getRolePermission']);
    Route::post('/role/new-perm/{id}/{permission}', [DashboardController::class, 'roleAddPermission']);
    Route::post('/role/remove-perm/{id}/{permission}', [DashboardController::class, 'roleRemovePermission']);
});
