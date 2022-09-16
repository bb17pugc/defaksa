<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect("/restaurant");
    }

    public static function getRestaurant()
    {
         $restaurant = Restaurant::get()->first();
        if(!isset($restaurant))
        {
            $restaurant = new Restaurant;
            $restaurant->name="no restaurant added";
            $restaurant->logo="public/logos/LogoDefault.png";
        }
        return $restaurant;
    }
}
