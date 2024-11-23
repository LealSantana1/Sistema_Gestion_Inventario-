<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admin = Admin::where('username', 'superadmin')->first();

        if (is_null($admin)) {
            $admin           = new Admin();
            $admin->name     = "Victo Hugo";
            $admin->email    = "victorhugo@gmail.com";
            $admin->username = "keen";
            $admin->password = Hash::make('password');
            $admin->is_superuser = true;
            $admin->save();
        }
    }
}
