<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserProductController extends Controller
{
    public function create()
    {
        return view('user-products.create');
    }

    // Store user + products
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'username'=>'required|string|unique:users',
            'phone'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|string',
            'products'=>'required|array|min:1',
            'products.*.product_name'=>'required|string',
            'products.*.price'=>'required|numeric|min:0',
            'products.*.quantity'=>'required|integer|min:1',
            'products.*.product_type'=>'required|in:flat,discount',
            'products.*.discount'=>'nullable|numeric|min:0',
        ]);
        dd($request->all());
        DB::transaction(function() use($request){
            $user = User::create([
                'name'=>$request->name,
                'username'=>$request->username,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);

            $finalAmount = 0;

            foreach($request->products as $product){
                $price = $product['price'] * $product['quantity'];
                if($product['product_type']=='discount'){
                    $price -= $product['discount'];
                } else {
                    $product['discount'] = 0;
                }
                $finalAmount += $price;

                $user->products()->create($product);
            }

            $user->update(['final_amount'=>$finalAmount]);
        });

        return redirect()->route('users.index')->with('success','User & products saved!');
    }

    // Show users list
    public function index(Request $request)
    {
        $users = User::with('products');

        if($request->name_filter){
            $users->where('name','like','%'.$request->name_filter.'%');
        }

        $users = $users->get();
        return view('user-products.index', compact('users'));
    }
}

