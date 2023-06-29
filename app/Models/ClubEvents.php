<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubEvents extends Model
{
    use HasFactory;

    protected $table = "club_events";
    public $fillable= ['event_title',
        'event_content',
        'event_start_date',
        'event_finish_date',
        'event_owner',
        'club_id',
        'user_limit'];


    public function clubs()
    {
        return $this->belongsTo(Clubs::class);
    }

    public  function  user(){
        return $this->belongstoMany(User::class,'club_event_user','event_id','user_id');
    }


}
