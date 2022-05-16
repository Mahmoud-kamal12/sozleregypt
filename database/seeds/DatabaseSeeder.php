<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        \App\Admin::create([
            'name' => 'Mahmoud Kamal',
            'email' => 'admin@gmial.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        \App\User::create([
            'name' => 'Mahmoud Kamal',
            'email' => 'user@gmial.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $ar = [
            "المصحف التوافقي" ,
            "كُلّيات رسائل النور",
            "كُتيّبات رسائل النور",
            "مجموعات رسائل النور",
            "الدراسات والبحوث",
            "الأوراد والأذكار",
            "رسائل النور باللغات العالمية",
            "منتجات سمعية",
            "كتب التوزيع",
        ];
        $en = [
            "Al-Mushaf Al-Tawafuky",
            "Risale-i Nur Collection",
            "Small Books Risale-i Nur",
            "Collected Books Risale-i Nur",
            "Studies On Risale-i Nur",
            "Prayer - Dhikr Books",
            "Risale-i Nur in World Languages",
            "Audible Productions",
            "Distributed Books",
        ];

        for ($index = 0 ; $index < count($ar); $index++){
            \App\Classification::create([
                "ar" => ['classification' => $ar[$index]],
                "en" => ['classification' => $en[$index]],
            ]);
        }

    }
}
