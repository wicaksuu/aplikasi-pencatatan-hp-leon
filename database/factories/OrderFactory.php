<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil platform langsung dari database
        $platforms = Platform::pluck('name')->toArray();
        if (empty($platforms)) {
            $platforms = ['Shopee', 'Tokopedia', 'TikTok Shop'];
        }

        $items = ['iPhone 15 Pro Max', 'iPhone 14', 'Samsung S24 Ultra', 'MacBook Air M2', 'iPad Pro M4', 'AirPods Pro 2', 'Samsung Galaxy Z Fold 5', 'Xiaomi 14 Ultra'];
        
        // Tanggal acak dalam 6 bulan terakhir
        $date = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'nama_barang' => fake()->randomElement($items),
            'no_order' => 'ORD-' . strtoupper(fake()->bothify('??####??')),
            'nomor_va' => fake()->boolean(70) ? fake()->numerify('880############') : null,
            'qty' => fake()->numberBetween(1, 5),
            'harga' => fake()->randomElement([15000000, 12000000, 20000000, 18500000, 3000000, 25000000, 16000000]),
            'platform' => fake()->randomElement($platforms),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
