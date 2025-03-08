<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Session;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request, Item $item)
{
    $cart = Session::get('cart', []);
    $quantity = $request->input('quantity', 1); 

    if (isset($cart[$item->id])) {
        $cart[$item->id]['quantity'] += $quantity;
    } else {
        $cart[$item->id] = [
            'name' => $item->name,
            'category' => $item->category->name ?? 'Unknown',
            'price' => $item->price,
            'quantity' => $quantity,
            'image' => $item->image,

        ];
    }

    Session::put('cart', $cart);

    return redirect()->back()->with('success', 'Item added to cart!');
}


    public function viewCart()
{
    $cart = Session::get('cart', []);
    return view('cart', compact('cart'));
}
public function updateCart(Request $request, $id)
{
    $cart = Session::get('cart', []);
    
    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = max(1, (int) $request->input('quantity', 1)); 
        Session::put('cart', $cart);
    }

    return redirect()->route('user.cart.view')->with('success', 'Cart updated!');
}

public function removeFromCart($id)
{
    $cart = Session::get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        Session::put('cart', $cart);
    }

    return redirect()->route('user.cart.view')->with('success', 'Item removed from cart!');
}

public function checkout()
{
    $cart = Session::get('cart', []);
    $invoiceNumber = 'INV-' . strtoupper(uniqid());

    $availableStock = [];
    foreach ($cart as $id => $item) {
        $product = Item::find($id);
        $availableStock[$id] = $product ? $product->quantity : 0;
    }

    return view('checkout', compact('cart', 'invoiceNumber', 'availableStock'));
}


public function processCheckout(Request $request)
{
    $validator = Validator::make($request->all(), [
        'address' => 'required|string|min:10|max:100',
        'postal_code' => 'required|string|size:5|regex:/^\d{5}$/',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $cart = Session::get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Cart is empty.');
    }

    $updatedCart = [];
    $totalPrice = 0;

    foreach ($cart as $id => $cartItem) {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->back()->with('error', "Barang '{$cartItem['name']}' tidak ditemukan.");
        }

        if ($cartItem['quantity'] > $item->quantity) {
            return redirect()->back()->with('error', "Barang '{$cartItem['name']}' hanya tersisa {$item->quantity}. Silakan kurangi jumlah pesanan.");
        }

        $updatedCart[$id] = [
            'name' => $cartItem['name'],
            'category' => $item->category->name ?? 'Unknown',
            'price' => $cartItem['price'],
            'quantity' => $cartItem['quantity'],
        ];

        $totalPrice += $cartItem['price'] * $cartItem['quantity'];
    }

    $invoice = Invoice::create([
        'invoice_number' => 'INV-' . strtoupper(uniqid()),
        'address' => $request->address,
        'postal_code' => $request->postal_code,
        'total_price' => $totalPrice,
        'items' => json_encode($updatedCart), 
    ]);

    
    foreach ($cart as $id => $cartItem) {
        $item = Item::find($id);
        $item->decrement('quantity', $cartItem['quantity']);
    }

    Session::forget('cart');

    return redirect()->route('user.cart.invoice', ['invoice' => $invoice->id])
        ->with('success', 'Checkout berhasil! Berikut adalah invoice Anda.');
}




public function showInvoice(Invoice $invoice)
{
    return view('invoice', compact('invoice'));
}




}

