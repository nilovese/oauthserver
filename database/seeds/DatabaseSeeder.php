<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();



        factory(App\User::class, 50)->create()->each(function($u) {
            $u->posts()->save(factory(App\Post::class)->make());
        });

        factory(App\OauthClient::class,10)->create();
        // $this->call(UserTableSeeder::class);
        //\DB::table("oauth_clients")->truncate();
        Model::reguard();
    }
}
