<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display the store page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('store'); // Asegúrate de tener la vista store.blade.php en resources/views
    }
}
