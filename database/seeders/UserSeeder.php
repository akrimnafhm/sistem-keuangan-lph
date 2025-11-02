<?php

    namespace Database\Seeders;

    use App\Models\User;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class UserSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // Buat user Admin
            User::create([
                'name' => 'Admin LPH',
                'username' => 'admin', // Ini untuk login
                'password' => Hash::make('password'), // Passwordnya adalah 'password'
                'level' => 'admin',
            ]);

            // Anda bisa tambahkan user lain di sini jika perlu
            // User::create([
            //     'name' => 'Akrimna Fahma',
            //     'username' => '22106050085', // NIP/NIM
            //     'password' => Hash::make('password123'),
            //     'level' => 'user',
            // ]);
        }
    }
    
