<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'username' => 'admin123',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'is_admin' => 1,
            'institusi' => 'Admin',
            'nama_penanggung_jawab' => null,
            'kartu_identitas' => '22223333',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
