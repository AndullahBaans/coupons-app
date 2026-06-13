<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Store;

class StorePageController extends Controller
{
    public function index()
    {
        $stores = Store::with('coupons')->get();

        return view('stores', compact('stores'));
    }

    public function show($id)
{
    $store = Store::with('coupons')->findOrFail($id);

    return view('store-details', compact('store'));
}
}