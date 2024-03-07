<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nationality;
use App\Models\Order;
use App\Models\User;
use App\Models\UserSubCategory;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use \Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.provider.index')->with('users', User::where('role', 'provider')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualifications = \App\Models\Qualification::pluck('ar_name', 'id')->toArray();
        $areas = \App\Models\Country::pluck('ar_name', 'id')->toArray();
        $categories = \App\Models\Category::pluck('ar_name', 'id')->toArray();
        $nationalities = Nationality::pluck('ar_name', 'id')->toArray();
        return view('admin.provider.add', ['categories' => $categories, 'areas' => $areas, 'qualifications' => $qualifications, 'nationalities' => $nationalities]);
    }

    public function show($id)
    {

        $regions = \App\Models\Region::where('city_id', $id)->pluck('ar_name', 'id')->toArray();
        return view('admin.regions.ajax-region', ['regions' => $regions]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'image'     => 'nullable|mimes:jpg,jpeg,gif,png',
            'name'      => 'required|string|',
            'bio'                    => 'required',
            'main_category_id'       => 'required|exists:categories,id',
            'category_id'       => 'required|exists:sub_categories,id',
            'provider_type' => 'required',
            'identity'  => 'nullable|string|unique:users,identity',
            'email'     => 'required||string|email|max:255|unique:users',
            'phone'     => 'required||string|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',

        ]);
        $inputs = $request->all();
//        dd($request->qualifications);
        if ($request->hasFile('image'))
        {
            //$image = uploader($request, 'image');

            //$inputs['image'] = $image;
            //$inputs = $request->all();

            $image = $request->file('image');
            $filename = 'image_'.time();

            $filePath = 'photos/' . $filename . '.webp';
        
            // Save the original image to the storage
            Storage::disk('public')->put($filePath, File::get($image));
            
    
            $inputs['image'] = 'photos/'.$filename . '.webp';

        }


        $inputs['cv'] = null;
        $inputs['bio'] = htmlentities($request->bio);
        $inputs['is_admin'] = 0;
        $inputs['role'] = 'provider';
        $inputs['password'] = Hash::make($request->password);

        $user = User::create($inputs);


        if ($user){

            $subCategory_id = $request->get('category_id');
            UserSubCategory::create([
                'user_id'           => $user->id,
                'sub_category_id'   => $subCategory_id,
                'created_at'        => Carbon::now(),
            ]);
        }

            return redirect()->back()->with('success', 'تم اضافة المورد بنجاح !');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qualifications = \App\Models\Qualification::pluck('ar_name', 'id')->toArray();
        $areas = \App\Models\Country::pluck('ar_name', 'id')->toArray();
        $categories = \App\Models\Category::pluck('ar_name', 'id')->toArray();
        $nationalities = Nationality::pluck('ar_name')->toArray();
        return view('admin.provider.edit', ['areas' => $areas, 'categories' => $categories, 'qualifications' => $qualifications, 'nationalities' => $nationalities])->with('user', User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'image' => 'sometimes|mimes:jpg,jpeg,gif,png',
            'name' => 'required|string|',
            'provider_type' => 'required',
            'main_category_id'       => 'nullable|exists:categories,id',
            'category_id'       => 'nullable|exists:sub_categories,id',
            'email' => 'nullable||string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable||numeric|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'bio'      => 'required'
        ]);

        $inputs = $request->all();
        if ($request->image != null) {
            if ($request->hasFile('image')) {
                deleteImg($user->image);
                //$picture = uploader($request, 'image');

                //$inputs = $request->all();

                $image = $request->file('image');
                $filename = 'image_'.time();

                $filePath = 'photos/' . $filename . '.webp';
        
                // Save the original image to the storage
                Storage::disk('public')->put($filePath, File::get($image));
                
        
                $picture = 'photos/'.$filename . '.webp';
    
                $user->update(['image' => $picture]);
            }
        }


        if ($request->password != null) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->update(Arr::except($inputs, ['password', 'image']));

        /*if ($user){

            $subCategory_id = $request->get('category_id');
            UserSubCategory::create([
                'user_id'           => $user->id,
                'sub_category_id'   => $subCategory_id,
                'created_at'        => Carbon::now(),
            ]);
        }*/
            return redirect()->back()->with('success', 'تم تعديل المورد بنجاح !');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->email == 'admin@admin.com') {
            alert()->error('لايمكن حذف الادمن  ');
            return back();
        }
        if ($user) {
            deleteImg($user->image);
            $user->delete();
            return redirect()->back()->with('success', 'تم حذف المورد بنجاح');
        }
            return redirect()->back()->with('error', 'المورد التي تحاول حذفه غير موجودة');
    }

    public function block($id)
    {
        $user = User::find($id);
        $user->update(['is_active' => '0']);
        return back();
    }

    public function top($id)
    {
        $user = User::find($id);
        $user->update(['is_top' => '1']);
        
        return redirect()->back()->with('success', 'تم اضافة مزود الخدمة في اعلي القائمة ' ); 
    }

    public function notTop($id)
    {
        $user = User::find($id);
        $user->update(['is_top' => '0']);
            return redirect()->back()->with('success', 'تم ازالة مزود الخدمة في اعلي القائمة ' ); 
    }

    public function view($id)
    {
        $provider = User::find($id);
        return view('admin.provider.view', compact('provider'));
    }

    public function deleteSubCategory($id,$provider_id){

        $sub_category =  UserSubCategory::where('sub_category_id','=',$id)->where('user_id',$provider_id)->first();
        if($sub_category){
            $sub_category->delete();

            return redirect()->back()->with('success', 'تم مسح المجال ' ); 
        }else{

            return redirect()->back()->with('warning', 'من فضلك اختار مجال صحيح' ); 
        }

    }


    public function deleteAdsCategory($provider_id){

        $ads_category =  User::find($provider_id);
        if($ads_category){
            $ads_category->ads_category = null;
            $ads_category->save();

            return redirect()->back()->with('success', 'تم مسح المجال ' ); 
        }else{

            return redirect()->back()->with('warning', 'من فضلك اختار مجال صحيح' ); 
        }

    }

    public function active($id)
    {
        $user = User::find($id);
        $user->update(['is_active' => '1']);
        return back();
    }

    public function rates()
    {
        $rates = Order::all();
        return view('admin.provider.rates', ['rates' => $rates]);
    }


    public function activeUser($id){

        $user = User::find($id);
        if($user){

            $user->confirmation_code = null;
            $user->verification_code = null;

            $user->is_verified = 1;

            $user->save();

            return redirect()->back()->with('success', 'تم تفعيل الحساب بنجاح ' ); 
        }else{
            return redirect()->back()->with('warning', 'لم نتمكن من تفعيل السحاب ' ); 

        }
    }


    public function addSubCategoriesToProvider(Request $request){
        $this->validate($request, [
            'id' => 'required',
            // 'category_id' => 'required',
        ]);

        $provider  = User::find($request->id);
        if($provider){
            // real provider
            if($request->ads_category != null){
                $provider->ads_category = $request->ads_category;
                $provider->save();
            }

            // add subcategories for provider

            if($request->sub_categories){
                foreach ($request->sub_categories as $sub_category){

                    // check if user already has this item
                    $foundItem = UserSubCategory::where('user_id',$provider->id)->where('sub_category_id',$sub_category)->first();
                    if(!$foundItem){

                        $usersub=new UserSubCategory();
                        $usersub->user_id=$provider->id;
                        $usersub->sub_category_id=$sub_category;
                        $usersub->save();

                    }
                }
            }


            return redirect()->back()->with('success', 'تم اضافة المجالات للمزود ' ); 

        }

        return redirect()->back();
    }


    public function updateAll(Request $request){


        if ($request->get('action') == "registration"){

            foreach ($request->get('ids') as $item){
                $user = User::find($item);

                if ($user){
                    $user->update([
                        'registration'  => 1,
                    ]);
                }
            }
        }

        if ($request->get('action') == "non_registration"){

            foreach ($request->get('ids') as $item){
                $user = User::find($item);

                if ($user){
                    $user->update([
                        'registration'  => 0,
                    ]);
                }
            }
        }

            return redirect()->back()->with('success', 'تم تحديث المزودين ' ); 

    }
    
 public function delete_selected_subcategories(Request $request){
     
    try {
        foreach ($request->ids as $id) {
            // Assuming you want to delete records based on the IDs
            $subCategoryUser = UserSubCategory::where('sub_category_id', $id)
                ->where('user_id', $request->provider)
                ->delete();
        }

        // Additional logic if needed...

        // If the deletion is successful, return a success message
        return response()->json(['success' => true, 'message' => 'Selected subcategories deleted successfully']);
    } catch (\Exception $e) {
        // Handle exceptions if any

        // If there's an error during the deletion, return an error message
        return response()->json(['success' => false, 'message' => 'Error deleting subcategories', 'error' => $e->getMessage()]);
    }
 }        
}
