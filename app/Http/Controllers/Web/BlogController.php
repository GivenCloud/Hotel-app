<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Hotel;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::paginate(2);
        return view('web.blog.index', compact('hotels'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return view('web.blog.show', compact('hotel'));
    }
}
