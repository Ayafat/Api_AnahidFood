<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\ProductBasket;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function addbasket(Request $request)
    {
        $product_id = $request->input('product_id');
        $restaurant_id = $request->input('restaurant_id');
        $count = $request->input('count', 1);

        $request->validate([
            'count' => 'required|integer|min:1'
        ]);

        $basket = Basket::firstOrCreate([
            'user_id' => Auth::id(),
            'is_paid' => 0
        ]);

        $existingBasket = ProductBasket::where([
            'product_id' => $product_id,
            'restaurant_id' => $restaurant_id,
            'user_id' => Auth::id(),
            'basket_id' => $basket->id
        ])->first();

        if ($existingBasket) {
            $existingBasket->increment('count', $count);
        } else {
            ProductBasket::create([
                'product_id' => $product_id,
                'restaurant_id' => $restaurant_id,
                'count' => $count,
                'user_id' => Auth::id(),
                'basket_id' => $basket->id
            ]);
        }

        return redirect()->route('basket.index')->with('success', 'محصول با موفقیت به سبد خرید اضافه شد');
    }

    public function editbasket($id)
    {
        $baskets = ProductBasket::findOrFail($id);
        return view('front.basket-edit', compact('baskets'));
    }

    public function updatebasket(Request $request)
    {
        $counts = $request->input('count');

        if ($counts && is_array($counts)) {
            foreach ($counts as $basketId => $count) {
                if (is_numeric($count) && $count > 0) {
                    $basket = ProductBasket::where('id', $basketId)
                        ->where('user_id', Auth::id())
                        ->first();

                    if ($basket) {
                        $basket->update(['count' => $count]);
                    }
                }
            }

            return redirect()->route('basket.index')->with('success', 'سبد خرید با موفقیت به‌روزرسانی شد.');
        }

        return redirect()->route('basket.index')->with('error', 'داده‌ای برای به‌روزرسانی ارسال نشد.');
    }

    
    public function index()
    {
        $data = $this->getBasketData(Auth::id());
        return view('front.basket', $data);
    }
    


    public function deletebasket($id)
    {
        try {
            $productBasket = ProductBasket::findOrFail($id);
            $basket = $productBasket->basket;

            $productBasket->delete();

            if ($basket->productBaskets()->count() === 0) {
                $basket->delete();
            }

            return redirect()->route('basket.index')->with('success', 'محصول با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return redirect()->route('basket.index')->with('error', 'مشکلی پیش آمد، دوباره تلاش کنید.');
        }
    }

    public function checkout($user_id)
{
    // گرفتن سبد پرداخت‌نشده مربوط به این کاربر
    $basket = Basket::where('user_id', $user_id)
                    ->where('is_paid', 0)
                    ->first();

    if (!$basket) {
        return redirect()->route('basket.index')->with('error', 'سبد خریدی برای پرداخت وجود ندارد.');
    }

    // گرفتن محصولات داخل سبد
    $baskets = $basket->productBaskets;

    // مجموع قیمت کل سبد
    $totalsum = $baskets->sum(function ($basketItem) {
        return $basketItem->count * $basketItem->product->price;
    });

    // گرفتن کیف پول کاربر
    $wallet = Wallet::where('user_id', $user_id)->first();

    // بررسی موجودی کافی
    if ($wallet && $wallet->price >= $totalsum) {

        // کم کردن مبلغ از کیف پول
        $wallet->price -= $totalsum;
        $wallet->save();

        // علامت‌گذاری سبد به عنوان پرداخت‌شده
        $basket->is_paid = 1;
        $basket->save();

        return redirect()->route('basket.index')->with('success', 'پرداخت با موفقیت انجام شد.');
    }

    return redirect()->route('basket.index')->with('error', 'موجودی کیف پول کافی نیست.');
}

    // متد کمکی برای دریافت سبد و جمع کل
    private function getBasketData($userId)
    {
        $baskets = ProductBasket::where('user_id', $userId)
            ->whereHas('basket', fn ($q) => $q->where('is_paid', 0))
            ->get();

        $totalsum = $baskets->sum(fn ($basket) => $basket->count * $basket->product->price);

        return compact('baskets', 'totalsum');
    }
}
