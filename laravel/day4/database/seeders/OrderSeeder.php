<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (! $user) {
            return;
        }

        $orders = [
            ['user_id' => $user->id, 'total' => 49.99, 'status' => 'completed'],
            ['user_id' => $user->id, 'total' => 19.50, 'status' => 'pending'],
        ];

        foreach ($orders as $o) {
            Order::updateOrCreate(['user_id' => $o['user_id'], 'total' => $o['total'], 'status' => $o['status']], $o);
        }
    }
}
