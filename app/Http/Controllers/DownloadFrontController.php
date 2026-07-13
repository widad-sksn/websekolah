<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;

class DownloadFrontController extends Controller
{
    public function index()
    {
        $downloads = Download::latest()->paginate(15);
        return view('download.index', compact('downloads'));
    }
}
