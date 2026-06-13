<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $discountTypes = [
            fake()->numberBetween(10, 50) . '% Off',
            '$' . fake()->numberBetween(5, 50) . ' Off',
            'Free Shipping',
            'Save ' . fake()->numberBetween(15, 100) . ' SAR',
        ];

        return [
            'store_id' => Store::factory(),
            'external_id' => fake()->unique()->uuid(),
            'title' => fake()->randomElement($discountTypes) . ' on your order',
            'code' => strtoupper(fake()->randomLetter() . fake()->randomLetter() . fake()->randomLetter() . fake()->numberBetween(10, 99) . fake()->randomLetter()),
            'discount_value' => fake()->randomElement(['10%', '20%', '50 SAR', '100 SAR', 'Free Shipping']),
            'expires_at' => fake()->boolean(80) ? fake()->dateTimeBetween('now', '+3 months')->format('Y-m-d') : null,
            'is_active' => fake()->boolean(90),
        ];
    }
}
