<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Payments_methods;
use App\Models\Role;
use App\Models\User;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(ProductSeeder::class);
        $this->call(ShippingMethodsSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(APIConfigrationSeeder::class);

        Payments_methods::create([
            'Payments_methods_id' => 'cash',
            'description' => 'Cash',
            'image' => 'http://127.0.0.1:8000/storage/images/cash.png',
            'status' => "active",
            'api_token' => null
        ]);

        Menu::create([

            'name' => 'Menu 1',
            'position' => 'header',

            'data' => '[{"text":"Home","href":"http://google.com","icon":"undefined undefined","target":"_top","title":"My Home"},{"text":"Opcion2","href":"","icon":"fa fa-bar-chart-o","target":"_self","title":""},{"text":"Opcion4","href":"","icon":"fa fa-crop","target":"_self","title":""},{"text":"Opcion7","href":"","icon":"fa fa-search","target":"_self","title":"","children":[{"text":"Opcion5","href":"","icon":"fa fa-flask","target":"_self","title":""}]},{"text":"Opcion3","href":"","icon":"fa fa-cloud-upload","target":"_self","title":""},{"text":"Opcion7-1-1","href":"","icon":"fa fa-filter","target":"_self","title":"","children":[{"text":"Opcion6","href":"","icon":"fa fa-map-marker","target":"_self","title":"","children":[{"text":"Opcion7-1","href":"","icon":"fa fa-plug","target":"_self","title":""}]}]},{"text":"new","href":"a","icon":"","target":"_blank","title":"quia beatae nulla. a"},{"text":"long","href":"https://www.google.com/","icon":"fa fa-i-cursor","target":"_self","title":"google"},{"text":"aaa","href":"a","icon":"fa fa-adn","target":"_top","title":"yes"},{"text":"Test ","href":"http://localhost/own/public/menu/build","icon":"","target":"_blank","title":"gggg"}]',
        ]);

        $roles = [
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Beheerder'],
            ['id' => 3, 'name' => 'Klant'],
        ];

        foreach ($roles as $role) {
            // create the role
            Role::create($role);
        }

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin123'),
            'role' => 1,
        ]);

        Customer::create([
            'user_id' => $user->id,
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@gmail.com',
            'phonenumber' => '0612345678',

        ]);
    }
}