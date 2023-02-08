<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $transactions = Cart::latest()->with('products')->where('user_id', Auth::user()->id)
            ->where('isActive', 0)->get();

        return view('user.history', [
            "transactions" => $transactions,
        ]);
    }
}
