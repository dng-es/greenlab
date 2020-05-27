<?php

use App\Category;
use App\Product;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CannTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'seller';
        $role->description = 'Seller';
        $role->save();

        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'admin@foo.com';
        $user->password = Hash::make('12345678');
        $user->email_verified_at = Carbon::now();
        $user->save();
        $user->roles()->attach(Role::where('name', 'admin')->first());

        $user = new User();
        $user->name = 'Vendedor';
        $user->email = 'seller@foo.com';
        $user->password = Hash::make('12345678');
        $user->email_verified_at = Carbon::now();
        $user->save();
        $user->roles()->attach(Role::where('name', 'seller')->first());        

        $category = new Category();
        $category->name = 'Extracciones';
        $category->notes = 'Las notas de las extracciones.';
        $category->save();

        $category = new Category();
        $category->name = 'Hierba';
        $category->notes = '';
        $category->save();

        $category = new Category();
        $category->name = 'Comida';
        $category->notes = '';
        $category->save();

        $category = new Category();
        $category->name = 'Hachís';
        $category->notes = '';
        $category->save();

        $category = new Product();
        $category->name = 'Chernobil';
        $category->category_id = 4;
        $category->menu = 1;
        $category->amount = 0;
        $category->price = 0;
        $category->save();

        $category = new Product();
        $category->name = 'White Rhino';
        $category->category_id = 4;
        $category->menu = 1;
        $category->amount = 0;
        $category->price = 0;
        $category->save();

        $category = new Product();
        $category->name = 'White Rhino';
        $category->category_id = 2;
        $category->menu = 1;
        $category->amount = 0;
        $category->price = 0;
        $category->save();

        $category = new Product();
        $category->name = 'Top44';
        $category->category_id = 2;
        $category->menu = 1;
        $category->amount = 0;
        $category->price = 0;
        $category->save();        
    }
}
