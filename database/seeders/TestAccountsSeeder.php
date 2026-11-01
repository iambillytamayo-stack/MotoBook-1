<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TestAccountsSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            throw new RuntimeException('Test accounts may only be seeded in local or testing environments.');
        }

        DB::transaction(function (): void {
            $customer = User::updateOrCreate(
                ['email' => 'customer@example.com'],
                [
                    'name' => 'Test Customer',
                    'phone' => '+15555550101',
                    'password' => 'password',
                    'role' => 'customer',
                    'status' => 'active',
                ],
            );
            $customer->wallet()->firstOrCreate([], ['balance' => 0]);

            $rider = User::updateOrCreate(
                ['email' => 'rider@example.com'],
                [
                    'name' => 'Test Rider',
                    'phone' => '+15555550102',
                    'password' => 'password',
                    'role' => 'rider',
                    'status' => 'active',
                ],
            );
            $rider->wallet()->firstOrCreate([], ['balance' => 0]);
            $rider->riderProfile()->updateOrCreate([], [
                'vehicle_type' => 'motorcycle',
                'status' => 'offline',
                'is_verified' => true,
            ]);

            $merchant = User::updateOrCreate(
                ['email' => 'merchant@example.com'],
                [
                    'name' => 'Test Merchant',
                    'phone' => '+15555550103',
                    'password' => 'password',
                    'role' => 'merchant',
                    'status' => 'active',
                ],
            );
            $merchant->wallet()->firstOrCreate([], ['balance' => 0]);
            Store::updateOrCreate(
                ['user_id' => $merchant->id],
                [
                    'name' => 'Test Merchant Store',
                    'slug' => 'test-merchant-store',
                    'description' => 'Demo store for local testing.',
                    'category' => 'Restaurant',
                    'address' => '123 Test Street',
                    'phone' => $merchant->phone,
                    'is_open' => true,
                    'is_verified' => true,
                ],
            );

            $demoMerchants = [
                [
                    'name' => 'Jollibee Merchant',
                    'email' => 'jollibee@example.com',
                    'phone' => '+15555550104',
                    'store' => 'Jollibee',
                    'slug' => 'jollibee-roxas-city',
                    'category' => 'Fast Food',
                    'description' => 'Demo Jollibee restaurant for local testing.',
                    'menu' => [
                        'Chicken Meals' => [
                            ['name' => 'Chickenjoy with Rice', 'description' => 'Crispy fried chicken served with rice and gravy.', 'price' => 129],
                            ['name' => 'Chickenjoy Bucket', 'description' => 'A shareable bucket of crispy fried chicken.', 'price' => 499],
                            ['name' => 'Jolly Spaghetti', 'description' => 'Filipino-style spaghetti with a sweet sauce.', 'price' => 79],
                        ],
                        'Burgers and Snacks' => [
                            ['name' => 'Yumburger', 'description' => 'A classic burger with a savory dressing.', 'price' => 45],
                            ['name' => 'Jolly Hotdog', 'description' => 'A hotdog topped with cheese and dressing.', 'price' => 75],
                        ],
                        'Desserts' => [
                            ['name' => 'Peach Mango Pie', 'description' => 'A crisp pie filled with peach and mango.', 'price' => 49],
                        ],
                    ],
                ],
                [
                    'name' => 'Mang Inasal Merchant',
                    'email' => 'manginasal@example.com',
                    'phone' => '+15555550105',
                    'store' => 'Mang Inasal',
                    'slug' => 'mang-inasal-roxas-city',
                    'category' => 'Restaurant',
                    'description' => 'Demo Mang Inasal restaurant for local testing.',
                    'menu' => [
                        'Grilled Meals' => [
                            ['name' => 'Chicken Inasal Paa', 'description' => 'Grilled chicken leg served with rice.', 'price' => 149],
                            ['name' => 'Chicken Inasal Pecho', 'description' => 'Grilled chicken breast served with rice.', 'price' => 179],
                            ['name' => 'Pork BBQ Meal', 'description' => 'Grilled pork barbecue served with rice.', 'price' => 139],
                        ],
                        'Rice Meals' => [
                            ['name' => 'Pork Sisig Meal', 'description' => 'Sizzling pork sisig served with rice.', 'price' => 159],
                            ['name' => 'Palabok', 'description' => 'Rice noodles with savory palabok sauce and toppings.', 'price' => 129],
                        ],
                        'Desserts and Drinks' => [
                            ['name' => 'Halo-Halo', 'description' => 'Shaved ice dessert with sweet Filipino toppings.', 'price' => 89],
                        ],
                    ],
                ],
                [
                    'name' => 'BigBrew Merchant',
                    'email' => 'bigbrew@example.com',
                    'phone' => '+15555550106',
                    'store' => 'BigBrew',
                    'slug' => 'bigbrew-roxas-city',
                    'category' => 'Cafe',
                    'description' => 'Demo BigBrew cafe for local testing.',
                    'menu' => [
                        'Milk Tea' => [
                            ['name' => 'Okinawa Milk Tea', 'description' => 'Okinawa-style milk tea served over ice.', 'price' => 59],
                            ['name' => 'Wintermelon Milk Tea', 'description' => 'Sweet wintermelon milk tea served over ice.', 'price' => 59],
                            ['name' => 'Dark Choco Milk Tea', 'description' => 'Chocolate milk tea served over ice.', 'price' => 69],
                        ],
                        'Fruit Tea and Coffee' => [
                            ['name' => 'Passion Fruit Tea', 'description' => 'Bright, refreshing passion fruit iced tea.', 'price' => 49],
                            ['name' => 'Iced Coffee', 'description' => 'Chilled brewed coffee with milk.', 'price' => 59],
                        ],
                        'Snacks' => [
                            ['name' => 'Cheese Waffle', 'description' => 'A warm waffle with a cheesy filling.', 'price' => 45],
                        ],
                    ],
                ],
                [
                    'name' => 'Pizza Hut Merchant',
                    'email' => 'pizzahut@example.com',
                    'phone' => '+15555550107',
                    'store' => 'Pizza Hut',
                    'slug' => 'pizza-hut-roxas-city',
                    'category' => 'Pizza',
                    'description' => 'Demo Pizza Hut restaurant for local testing.',
                    'menu' => [
                        'Pizzas' => [
                            ['name' => 'Pepperoni Pizza', 'description' => 'Pizza topped with pepperoni and melted cheese.', 'price' => 349],
                            ['name' => 'Cheese Lover Pizza', 'description' => 'A cheesy pizza with a golden crust.', 'price' => 329],
                            ['name' => 'Supreme Pizza', 'description' => 'Pizza topped with assorted meat and vegetables.', 'price' => 399],
                        ],
                        'Pasta' => [
                            ['name' => 'Creamy Carbonara', 'description' => 'Creamy pasta with bacon and a savory sauce.', 'price' => 189],
                            ['name' => 'Baked Lasagna', 'description' => 'Layered pasta baked with sauce and cheese.', 'price' => 199],
                        ],
                        'Sides' => [
                            ['name' => 'Garlic Bread', 'description' => 'Toasted bread with garlic butter.', 'price' => 99],
                        ],
                    ],
                ],
            ];

            foreach ($demoMerchants as $demoMerchant) {
                $demoUser = User::updateOrCreate(
                    ['email' => $demoMerchant['email']],
                    [
                        'name' => $demoMerchant['name'],
                        'phone' => $demoMerchant['phone'],
                        'password' => 'password',
                        'role' => 'merchant',
                        'status' => 'active',
                    ],
                );
                $demoUser->wallet()->firstOrCreate([], ['balance' => 0]);

                $store = Store::updateOrCreate(
                    ['user_id' => $demoUser->id],
                    [
                        'name' => $demoMerchant['store'],
                        'slug' => $demoMerchant['slug'],
                        'description' => $demoMerchant['description'],
                        'category' => $demoMerchant['category'],
                        'address' => 'Roxas City, Capiz',
                        'phone' => $demoMerchant['phone'],
                        'is_open' => true,
                        'is_verified' => true,
                    ],
                );

                $sortOrder = 0;

                foreach ($demoMerchant['menu'] as $categoryName => $menuItems) {
                    $menuCategory = $store->menuCategories()->updateOrCreate(
                        ['name' => $categoryName],
                        ['sort_order' => $sortOrder],
                    );

                    foreach ($menuItems as $menuItem) {
                        $store->menuItems()->updateOrCreate(
                            ['name' => $menuItem['name']],
                            [
                                'menu_category_id' => $menuCategory->id,
                                'description' => $menuItem['description'],
                                'price' => $menuItem['price'],
                                'is_available' => true,
                            ],
                        );
                    }

                    $sortOrder++;
                }
            }
        });

        $this->command?->info('Test accounts seeded (local/testing only):');
        $this->command?->info('  Customer: customer@example.com / password');
        $this->command?->info('  Rider: rider@example.com / password');
        $this->command?->info('  Merchant: merchant@example.com / password');
        $this->command?->info('  Jollibee merchant: jollibee@example.com / password');
        $this->command?->info('  Mang Inasal merchant: manginasal@example.com / password');
        $this->command?->info('  BigBrew merchant: bigbrew@example.com / password');
        $this->command?->info('  Pizza Hut merchant: pizzahut@example.com / password');
        $this->command?->info('  Demo menus added for all four restaurant accounts.');
    }
}
