<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // สร้างผู้ใช้ตัวอย่าง
        $owner = User::create([
            'name' => 'เจ้าของร้าน',
            'email' => 'owner@coffee.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        $employee1 = User::create([
            'name' => 'สมชาย พนักงาน',
            'email' => 'somchai@coffee.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);

        $employee2 = User::create([
            'name' => 'สมหญิง บาริสต้า',
            'email' => 'somying@coffee.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);

        // สร้างสินค้า
        $this->call(ProductSeeder::class);

        // สร้างออเดอร์ตัวอย่าง
        $this->createSampleOrders([$owner, $employee1, $employee2]);
    }

    private function createSampleOrders(array $users): void
    {
        $products = Product::all();

        // สร้างออเดอร์ย้อนหลัง 7 วัน
        for ($day = 6; $day >= 0; $day--) {
            $date = now()->subDays($day);
            $ordersPerDay = rand(5, 15);

            for ($i = 0; $i < $ordersPerDay; $i++) {
                $user = $users[array_rand($users)];
                $itemCount = rand(1, 5);
                $selectedProducts = $products->random($itemCount);

                $order = Order::create([
                    'user_id' => $user->id,
                    'status' => 'completed',
                    'total_amount' => 0,
                    'created_at' => $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                    'updated_at' => $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                ]);

                $totalAmount = 0;

                foreach ($selectedProducts as $product) {
                    $quantity = rand(1, 3);
                    $itemTotal = $product->price * $quantity;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'unit_price' => $product->price,
                        'total_price' => $itemTotal,
                    ]);

                    $totalAmount += $itemTotal;
                }

                $order->update(['total_amount' => $totalAmount]);
            }
        }
    }
}
