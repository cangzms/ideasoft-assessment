<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function discount($id)
    {

        $orders = Order::find($id);

        if (!$orders) { // order kontrolü
            return response()->json([
                'Error' => 'Order Not Found'], 404);
        }

        $discounts = [];

        if ($orders->total >= 1000) {
            $discount_ten_percent = number_format($orders->total * 0.10, 2); //toplam sipariş 1000 üzeri ise yüzde 10 indirim uygular.
            $discounts[] = [
                'discountReason' => '10_PERCENT_OVER_1000',
                'discountAmount' => $discount_ten_percent,
                'subtotal' => number_format($orders->total - $discount_ten_percent, 2)
            ];

        }

        $items = json_decode($orders->items, true);

        $discount_six_get_one = 0;

        foreach ($items as $item) {
            $product = Product::find($item['productId']);
            $category = $product->category;
            $cheapestPrice = PHP_FLOAT_MAX;
            if ($category == 2 && $item['quantity'] >= 6)// 2idli kategoriye ait üründen 6 adet alındığında 1 tanesini ücretsiz ver.
            {
                $discounts[] = [
                    'discountReason' => 'BUY_6_GET_1',
                    'discountAmount' => $item['unitPrice'],
                    'subtotal' => number_format($item['total'] - $item['unitPrice'], 2)
                ];

                $discount_six_get_one += (float)$item['unitPrice'];
            }

            if ($category == 1 && $item['quantity'] >= 2)// 1 idli kategoriden 2 veya daha fazla ürün alındığında ne ucuz ürüne yüzde 20 indirim uygular.
            {
                if ($item['unitPrice'] < $cheapestPrice) {
                    $cheapestPrice = $item['total'];
                }
                $discount_cheapest = number_format($cheapestPrice * 0.20, 2);
            }
        }
        $discounts[] = [
            'discountReason' => '20_PERCENT_CHEAPEST_ITEM',
            'discountAmount' => $discount_cheapest,
            'subtotal' => number_format($item['total'] - $discount_cheapest, 2)
        ];
        // indirim miktarlarının toplamı
        $total_discount = number_format($discount_six_get_one + $discount_ten_percent + $discount_cheapest, 2);
        // indirimli genel fiyat
        $discounted_total = number_format($orders->total - $total_discount, 2);

        return response()->json([
            'orderId' => $id,
            'discounts' => $discounts,
            'totalDiscount' => $total_discount,
            'discountedTotal' => $discounted_total]);
    }
}
