<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    var $path_view = 'landing';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('documentation')->where('is_show', 'Ya')->where('is_public', 'Ya')->inRandomOrder()->limit(3)->get();
        // $add = News::with('documentation')->where('is_show', 'Ya')->where('is_public', 'Ya')->inRandomOrder()->paginate(2);
        // dd($add->total());

        return view("$this->path_view", [
           'news' => $news,
        ]);
    }
}
