<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $users = User::query()->count();
        $customers = Customer::query()->count();
        $invoices = Invoice::query()->count();

        return view('home', ['users'=> $users, 
                            'customers'=> $customers, 
                            'invoices'=> $invoices]);
    }
}
