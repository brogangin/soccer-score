<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return view('data', [
            'data' => Data::data(),
        ]);
    }
}
