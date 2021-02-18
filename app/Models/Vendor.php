<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;

    protected $table = 'vendors';

    protected $fillable = [
         'name', 'photo' ,'mobile',  'address' , 'password',  'email', 'active', 'category_id', 'created_at' , 'updated_at' , 'category_id'
    ];

    protected $hidden = [
        'category_id',

    ];

    public function scopeActive($query) {
        return $query -> where('active' , 1);
    }

    public function scopeSelection($query) {
        return $query->select( 'id','name', 'photo' ,'mobile',  'address' , 'email', 'active' , 'category_id');
    }

    public function getPhotoAttribute($val)
     {
         return ($val !== null) ?  asset('storage/'. $val) : "";
     }



    public function category() {
        return $this->belongsTo('App\Models\MainCategory' , 'category_id', 'id' );
    }

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }


}
