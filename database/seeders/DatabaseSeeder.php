<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'taqiy', 'email' => 'taqiy@gmail.com', 'password' => Hash::make('170629'), 'role' => 'admin']);
        User::create(['name' => 'hapis', 'email' => 'hapis@gmail.com', 'password' => Hash::make('170629'), 'role' => 'petugas']);
        User::create(['name' => 'asdimosaja', 'email' => 'asdimosaja@gmail.com', 'password' => Hash::make('170629'), 'role' => 'siswa']);

        $alat = Category::create(['name' => 'Elektronik']);
        $perlengkapan = Category::create(['name' => 'perlengkapan']);

        Tool::create(['category_id' => $perlengkapan->id, 'code' => 'ELK-01', 'name' => 'buku', 'stock' => 31]);
        Tool::create(['category_id' => $alat->id, 'code' => 'ELK-02', 'name' => 'printer', 'stock' => 10]);
        Tool::create(['category_id' => $alat->id, 'code' => 'JRG-01', 'name' => 'speaker', 'stock' => 15]);
    }
}