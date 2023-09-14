<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(Request $request)
    {
        $orders = Order::select('id', 'customerId', 'items', 'total')->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'Error' => 'Order Not Found'
            ]);
        }

        return $orders;

    }

    public function create(OrderRequest $request)
    {
        $customer = Customer::find($request->customerId);
        if (!$customer) {
            return response()->json(['Error' => 'Customer not found'], 404); // Customer kontrolü
        };

        $items = $request->items;
        $total = 0;

        foreach ($items as $item) {
            $product = Product::find($item['productId']);
            if (!$product || $product->stock < $item['quantity']) {  // Product ve stok kontrolü
                return response()->json([
                    'Error' => 'Stock is not enough',
                    'Product' => $product->name,
                    'Current Stock' => $product->stock], 404);
            }

            $total += (float)$item['total']; // Ürünlerin toplam fiyatlarının genel toplama atanması

            $product_stock = $product->stock - $item['quantity']; // stok sayılarının düşülmesi

            $product->update([
                'stock' => $product_stock // stok sayısının güncellenmesi
            ]);
        }

        $items = json_encode($items);

        Order::create([
            'customerId' => $customer->id,
            'items' => $items,
            'total' => $total
        ]);

        return response()->json(['message' => 'Order created successfully.'], 201);

    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully.'], 201);

    }
}
