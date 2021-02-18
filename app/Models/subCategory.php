<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MainCategory;

class subCategory extends Model
{
    protected $table = 'sub_categories';

    protected $fillable = [
         'translation_lang', 'translation_of' ,'name',  'slug' , 'photo', 'active', 'created_at' , 'updated_at' , 'category_id' , 'parent_id'
    ];



   public function scopeActive($query) {
       return $query -> where('active' , 1);
   }

   public function scopeSelection($query) {
       return $query->select('id', 'translation_lang' , 'name' , 'slug' , 'photo' , 'active', 'translation_of','category_id' , 'parent_id');
   }

   public function getPhotoAttribute($val)
    {
        return ($val !== null) ?  asset('storage/'. $val) : "";
    }

    public function categories() {
      return  $this->hasMany(self::class , 'translation_of');
    }


    public function mainCategory() {
        return $this->belongsTo(MainCategory::class , 'category_id' , 'id');
    }


    public function vendors() {
        return $this->hasMany('App\Models\Vendor' , 'category_id', 'id' );
    }

    public function scopeDefaultLanguages($query) {
        return  $query->where('translation_of' , 0);
    }
}
