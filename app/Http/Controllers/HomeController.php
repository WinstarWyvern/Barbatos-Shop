<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        $categories = Category::latest()->with('products')->get();
        $count = 0;
        if (request('search')) {
            $categories = Category::latest()->with('products', function ($i) {
                $searchResult = request('search');
                $i->where('name', 'like', "%$searchResult%");
            })->get();

            foreach ($categories as $category) {
                foreach ($category->products as $product) {
                    $count += 1;
                }
            }
        }

        Artisan::call('storage:link');

        return view('home', [
            'categories' => $categories,
            'count' => $count,
        ]);
    }
}
