<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        return response()->json($cart);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $validated['product_id'],
            ],
        );
        return response()->json(['cart' => $cart, 'success' => "Item added to cart."], 201);
    }
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        if ($cart) {
            $cart->delete();
            return response()->json(['success' => 'Item removed from cart.']);
        }
        return response()->json(['message' => 'Item not found.'], 404);
    }
    public function deleteAll()
    {
        Cart::where('user_id', Auth::id())->delete();
        return response()->json(['success' => 'All items removed from cart.']);
    }
}