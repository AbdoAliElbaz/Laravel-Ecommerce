<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\subCategory;


class MainCategory extends Model
{
    use Notifiable;

    // protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'main_categories';

    protected $fillable = [
         'translation_lang', 'translation_of' ,'name',  'slug' , 'photo', 'active', 'created_at' , 'updated_at'
    ];

    protected static function boot() {
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }

   public function scopeActive($query) {
       return $query -> where('active' , 1);
   }

   public function scopeSelection($query) {
       return $query->select('id', 'translation_lang' , 'name' , 'slug' , 'photo' , 'active', 'translation_of');
   }

   public function getPhotoAttribute($val)
    {
        return ($val !== null) ?  asset('storage/'. $val) : "";
    }

    public function categories() {
      return  $this->hasMany(self::class , 'translation_of');
    }


    public function subCategories() {
        return $this->hasMany(subCategory::class , 'category_id' , 'id');
    }


    public function vendors() {
        return $this->hasMany('App\Models\Vendor' , 'category_id', 'id' );
    }

    public function scopeDefaultLanguages($query) {
        return  $query->where('translation_of' , 0);
    }


}
