<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class AboutController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::active()->latest()->take(8)->get();

        return view('frontend.about.index', compact('testimonials'));
    }
}
