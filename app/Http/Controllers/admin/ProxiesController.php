<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProxiesController extends Controller
{
    //
    public function view(){
      return view('datatables.proxies');
    }
}
