<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clubs extends Model
{
    use HasFactory;
    protected $table ="clubs";
    public $fillable= ['club_name','club_content','club_department','club_logo','club_slug','club_manager'];


    public  function  getManager(){
        return $this->hasOne(User::class,'id','club_manager');
    }


    public  function  user(){
        return $this->belongstoMany(User::class,'user_club','club_id','user_id');
    }


    public  function  events(){
        return $this->hasMany(ClubEvents::class,'club_id','id');
    }

}
