<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class MergeCartListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $sessionCart = Session::get('cart', []);
        
        if (empty($sessionCart)) {
            return;
        }

        $user = $event->user;
        $dbCart = Cart::firstOrCreate(['user_id' => $user->id]);

        foreach ($sessionCart as $productId => $item) {
            $existingItem = $dbCart->items()->where('product_id', $productId)->first();
            if ($existingItem) {
                $existingItem->quantity += $item['quantity'];
                $existingItem->save();
            } else {
                $dbCart->items()->create([
                    'product_id' => $productId,
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'image_url' => $item['image_url'],
                ]);
            }
        }

        Session::forget('cart');
    }
}
