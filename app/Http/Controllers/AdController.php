<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdUser;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function index(Request $request)
    {

        $adQuery = Ad::query(); //stavljamo upit u varijablu gde kasnije koristimo taj upit da gradimo dalje
        $category = $request->get('cat');

        if ($category) {

            $adQuery->whereHas('category', function ($query) use($category)
            {
                $query->where('name', $category);
            });
        }

        // Filter po ceni
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');
        if (isset($price_from)) {
        $adQuery->where('price', '>=', $price_from);
        }
        if (isset($price_to)) {
        $adQuery->where('price', '<=', $price_to);
        }

        $adQuery->orderBy('price', $request->get('type') === 'lower' ? 'asc' : 'desc');

        $adQuery->orderBy('price', $request->get('type') === 'lower' ? 'asc' : 'desc' );

        try {
            $all_ads = $adQuery->with('adViews')->paginate(6);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Ad not found.');
        }

        $categories = Category::all()->sortBy('name');

        $all_ads->appends(['cat' => $category, 'type' => $request->get('type')]);

        return view ('welcome',compact('all_ads','categories'));

    }

    public function show($id,Request $request)
    {
        $ad = Ad::with('adViews')->find($id); //adViews je relacija iz modela Ad
        
        if (!$ad) {
            return redirect()->back()->with('error', 'Ad not found.');
        }

        $user = Auth::user();
        $category = $ad->category;
        $viewsCount = $ad->adViews->count(); //adViews je ovde property ne funkcija kao u modelu Ad
        $likeCount = $ad->likes()->count();

        if ($user) {
            if( ! AdUser::where('user_id', $user->id)->where('ad_id', $ad->id)->first()) {
                $ad->adViews()->attach($user);
            }
        }

        // if( ! AdUser::where('user_id', $user->id)->where('ad_id', $ad->id)->first()) {
        // $adUser = new AdUser();
        // $adUser->user_id = $user->id;
        // $adUser->ad_id = $ad->id;
        // $adUser->save(); //isto kao gore samo samo sve ovo ostalo umesto attacha-a  
        // }

        return view('singleAd', compact('ad','category','viewsCount','likeCount'));

    }

    public function like($id)
    {

        $ad = Ad::find($id);
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('info', 'You need to be logged in to like ads.');
        }

        if ($ad->likes()->where('user_id', $user->id)->exists()) {
            $likeCount = $ad->likes()->count();
            return redirect()->back()->with('warning', "You have already liked this ad.")->with('warningTtl', 5);
        } else {
            //create like
            $ad->likes()->attach($user->id);
            $likeCount = $ad->likes()->count();

            return redirect()->back()->with('success', "Ad liked successfully. It now has $likeCount likes.");
        }

    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category_id = $request->input('category_id');
        // $category_name = $category_id->name;
        $categories = Category::all()->sortBy('name');
    
        $ads = Ad::query();
    
        if ($query) {
            $ads->where('title', 'LIKE', "%$query%");
        }
    
        if ($category_id) {
            $ads->where('category_id', $category_id);
        }

        // if ($category_name) {
        //     $ads->where('category_name', $category_name);
        // }
    
        $ads = $ads->paginate(5);

        if ($ads->isEmpty()) {
            return back()->with('info', 'No results found you were searching. Please try again.');
        }
    
        return view('search', compact('ads','categories'));
    }

}
