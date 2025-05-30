<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product; // Change this if you use a different model

class DecreaseQuantity extends Command
{
    protected $signature = 'quantity:decrease';
    protected $description = 'Decrease product quantity by 1 every minute until it reaches 0';

    public function handle()
    {
        // Find all products with quantity > 0
        $products = Product::where('quantity', '>', 0)->get();

        foreach ($products as $product) {
            $product->decrement('quantity');
            $this->info("Product ID {$product->id}: Decreased to {$product->quantity}");
        }

        return 0;
    }
}
