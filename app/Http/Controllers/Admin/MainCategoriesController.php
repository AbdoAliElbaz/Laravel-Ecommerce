<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoriesRequest;
use App\Models\Language;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{
    public function index() {

        $default_lang = def_lang();

        $categories = MainCategory::where('translation_lang' , $default_lang)->selection()->get();
        return view('admin.mainCategories.index' , compact('categories'));
      }


    public function create() {
       $language =  Language::active()->selection()->get() ;

            return view('admin.mainCategories.create' , compact('language'));
        }


    public function store(MainCategoriesRequest $request) {

        try {

            $main_categories = collect($request->category) ;
            $filter = $main_categories->filter(function($value , $key){ return $value['abbr'] == def_lang(); });


            $default_category =  array_values($filter->all()) [0];


            $file_path = "" ;
            if($request->has('photo')) {
                $file_path = uploadImage('' , $request->photo);

                DB::beginTransaction();

            $default_category_id = MainCategory::insertGetId([
                    'translation_lang' => $default_category['abbr'],
                    'translation_of' => 0 ,
                    'name' => $default_category['name'],
                    'slug' => $default_category['name'],
                    'photo' => $file_path
                ]);

             $categories = $main_categories->filter(function($value ){ return $value['abbr'] != def_lang(); });

                if(isset($categories) && ($categories -> count()))
                {
                    $categories_arr = [] ;
                    foreach($categories as $category) {
                        $categories_arr[] = [    'translation_lang' => $category['abbr'],
                        'translation_of' => $default_category_id ,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $file_path ];
                    }

                }
                MainCategory::insert($categories_arr);
            }
            DB::commit();
            return redirect()->route('admin.mainCategories')->with(['success' => 'تم الحفظ بنجاح']);
        }
        catch(\Exception $ex) {
            DB::rollback();
            // dd($request);
            return redirect()->route('admin.mainCategories')->with(['error' => 'حدث خطأ ما ']);

        }
        }



    public function edit($mainCat_id) {

        // get specific categories and it's translations
         $mainCategory = MainCategory::with('categories')->selection()->find($mainCat_id);

         if(!$mainCategory)
         return redirect()->route('admin.mainCategories')->with(['error'=> 'هذا القسم غير موجود']);

        return view('admin.mainCategories.edit' , compact('mainCategory'));

    }

    public function update($mainCat_id , MainCategoriesRequest $request)  {


        // return ($request);

        $main_category = MainCategory::find($mainCat_id);
        if(!$main_category)
        return redirect()->route('admin.mainCategories')->with(['error'=> 'هذا القسم غير موجود']);


        $category = array_values($request->category) [0];


        MainCategory::where('id' , $mainCat_id)->update([
            'name' => $category['name'],
            'active' => $request->active,

        ]) ;
        return redirect()->route('admin.mainCategories')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function destroy($mainCat_id) {

        try {
            $maincategory = MainCategory::find($mainCat_id);
            // check if the category is exist or not
            if(!$maincategory) {
                return redirect()->redirect('admin.mainCategories')->with(['error'=> 'هذا القسم غير موجود']);
            }
            $vendors = $maincategory->vendors ;
                // check if the category has vendors
            if(isset($vendors) && $vendors->count() > 0 ) {
                return redirect()->route('admin.mainCategories')->with(['error'=> 'هذا القسم يوجد به تجار ولا يمكن حذفه']);
            }
            // delete category successfully
            $maincategory->categories()->delete();
            $maincategory->delete() ;
            return redirect()->route('admin.mainCategories')->with(['success' => 'تم حذف القسم بنجاح']);
            }
        catch (\Exception $ex) {
            return redirect()->route('admin.mainCategories')->with(['error' => 'حدث خطأ ما ']);
            }
    }


    public function changeStatus($id) {
    try {
        $mainCategory = MainCategory::find($id) ;

        if(!$mainCategory)
            return redirect()->route('admin.mainCategories')->with(['error' => 'هذا القسم غير موجود']);

            $status = $mainCategory->active == 0 ? 1 :0 ;
            $mainCategory->update(['active' => $status]);

            return redirect()->route('admin.mainCategories')->with(['success' => 'تم تغيير الحاله بنجاح']);


    }
    catch (\Exception $ex) {
        return redirect()->route('admin.mainCategories')->with(['error' => 'حدث خطأ ما ']);
        }
    }
}

