<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopOwnerController extends Controller
{
    function show($shopOwnerId)
    {
        return view('admin.shopowner.edit', compact('shopOwnerId'));
    }

    function create()
    {
        return view('admin.shopowner.edit', compact('shopOwnerId'));
    }
}
