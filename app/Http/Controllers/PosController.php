<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)->get();
        $categories = $products->pluck('category')->unique()->values();
        return view('pos.index', compact('products', 'categories'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'category' => $product->category,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', "เพิ่ม {$product->name} ลงในตะกร้าเรียบร้อย");
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        return back()->with('success', 'ลบจากตะกร้าเรียบร้อย');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->input('quantities', []) as $productId => $quantity) {
            if (isset($cart[$productId])) {
                if ($quantity <= 0) {
                    unset($cart[$productId]);
                } else {
                    $cart[$productId]['quantity'] = $quantity;
                }
            }
        }

        session()->put('cart', $cart);
        return back();
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'ตะกร้าว่าง');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'completed',
            'total_amount' => 0,
        ]);

        $totalAmount = 0;

        foreach ($cart as $item) {
            $itemTotal = $item['price'] * $item['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'total_price' => $itemTotal,
            ]);

            $totalAmount += $itemTotal;
        }

        $order->update(['total_amount' => $totalAmount]);
        session()->forget('cart');

        return redirect()->route('pos.receipt', $order)->with('success', 'ออเดอร์สำเร็จ');
    }

    public function receipt(Order $order)
    {
        return view('pos.receipt', compact('order'));
    }

    public function clearCart()
    {
        session()->forget('cart');
        return back()->with('success', 'ล้างตะกร้าเรียบร้อย');
    }
}
