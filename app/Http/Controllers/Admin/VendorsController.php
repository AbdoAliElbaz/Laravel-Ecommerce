<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorsRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorsController extends Controller
{
    public function index() {
        $vendors = Vendor::selection()->paginate(PAGINATION_COUNT);

        return view('admin.Vendors.index' , compact('vendors'));
    }
    public function create() {

        $categories = MainCategory::where('translation_of' , 0)->active()->get();
        return view('admin.vendors.create' , compact('categories'));

    }
    public function store(VendorsRequest $request)
    {
        try {

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = "";
            if ($request->has('photo')) {
                $filePath = uploadImage('', $request->photo);
            }

            $vendor = Vendor::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'active' => $request->active,
                'address' => $request->address,
                'photo' => $filePath,
                'password' => $request->password,
                'category_id' => $request->category_id,
                // 'latitude' => $request->latitude,
                // 'longitude' => $request->longitude,
            ]);


            return redirect()->route('admin.Vendors')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.Vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }

    public function edit($vendor_id) {

        $vendor = Vendor::with('category')->selection()->find($vendor_id);


        if(!$vendor_id)
        return redirect()->route('admin.Vendors')->with(['error'=> 'هذا المتجر غير موجود']);

        $categories = MainCategory::where('translation_of' , 0)->active()->get();

        return view('admin.Vendors.edit' , compact('vendor' , 'categories'));

    }
    public function update($vendor_id , VendorsRequest $request) {

        try {

            // check the right vendor id
            $vendor = Vendor::Selection()->find($vendor_id);
            if (!$vendor)
                return redirect()->route('admin.Vendors')->with(['error' => 'هذا المتجر غير موجود او ربما يكون محذوفا ']);


            DB::beginTransaction();
            //photo
            if ($request->has('photo') ) {
                 $filePath = uploadImage('', $request->photo);
                Vendor::where('id', $vendor_id)->update(['photo' => $filePath]);
            }


            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

             $data = $request->except('_token', 'id', 'photo', 'password');

            //password
            if ($request->has('password') && !is_null($request->password)) {

                $data['password'] = $request->password;
            }

            // update other data
            Vendor::where('id', $vendor_id)->update($data);

            DB::commit();
            return redirect()->route('admin.Vendors')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('admin.Vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }



    }
    public function destroy($id) {
        $vendor = Vendor::find($id);

        $vendor->delete();
    }
}
