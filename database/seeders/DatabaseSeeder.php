<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\models\User;
use App\models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { Category::truncate();
       \App\Models\User::factory(0)->create();
       \App\Models\Event::factory(0)->create();

       $categories = [

        'Awards and competitions',
        'Festivals and parties' ,
        'Speaker session ',
        'Networking sessions',
        'Conferences',
        'Workshops and classes',
        'Sponsorships',
        'Trade shows and expos',
        
      ];
      foreach($categories as $category){
          Category::create(['name'=>$category]);
        }
        Role::truncate();
        $adminRole = Role::create(['name'=>'admin']);

        $admin = User::create([
          'name'=>'admin',
          'email'=>'admin@gmail.com',
          'password'=>bcrypt('admin'),
          'email_verified_at'=>NOW()
          
        ]);
        
        $admin->roles()->attach( $adminRole);
        
   }
}
