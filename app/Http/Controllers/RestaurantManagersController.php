<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Helpers\ImageUploader;

class RestaurantManagersController extends Controller
{
   public function index()
   {
       $restaurant = Restaurant::all()->first();

       return View('restaurantmanager.index' , ['restaurant'=>$restaurant]);
   }
   public function add(Request $request)
   {
    try {


    $validated = $request->validate([
        'name' => 'string|required',
        'logo' => 'required|image',
        //'files.*' => 'mimes:jpeg, jpg, png, bmp, doc, pdf, mp3, svg, gif, webp|nullable|max:250000',
    ]);
    $name = $request->input('name');

    Restaurant::query()->delete();
    $logoPath = ImageUploader::handle($request->file('logo'), 'logos');
    $restaurant =new Restaurant;
    $restaurant->name = $name;
    $restaurant->logo = $logoPath;
    $restaurant->save();

    session()->flash('success', 'تم انشاء الصنف بنجاح');
    return redirect()->to('/restaurant');

} catch (\Exception $e) {

    session()->flash('error', 'يوجد خطأ');
    return redirect()->to('/restaurant');
}
   }
}
