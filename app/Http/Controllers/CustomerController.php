<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomerController extends Controller
{
     public function dashboardcus(){
            return view('customer.dashboardcus');
    }

    public function productcus(){
        $products = Product::paginate(10);
        return view('customer.productcus', compact('products'));

    }
}
