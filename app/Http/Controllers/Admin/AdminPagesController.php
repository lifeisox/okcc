<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPagesController extends Controller
{
    /**
     * Landing page of Admin
     */
    public function index() { return view('admin.index'); }
    /**
     * Landing pages for Admin Top
     */
    public function officer() { return view('admin.officer'); }
    public function super() { return view('admin.super'); }
    /**
     * Side Menu pages
     */
    public function usersStart() { return view('admin.officer.user'); }
}
