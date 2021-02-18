<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Language extends Model
{
     use Notifiable;

    // protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'languages';

    protected $fillable = [
        'abbr',   'locale', 'name','direction' , 'active' ,'created_at' , 'updated_at'
    ];

    public function scopeActive($query) {
        return $query -> where('active' , 1);
    }


    public function scopeSelection($query) {
        return $query-> select('id','abbr', 'name','direction', 'active');
    }

    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
      }
}
