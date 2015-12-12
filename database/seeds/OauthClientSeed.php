<?php

use Illuminate\Database\Seeder;

class OauthClientSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0;$i < 10; $i++ )
        {
            \DB::table("oauth_clients")->create
            ([
                    "id" => "id$i",
                "secret" => "secret$i",
                  "name" => "client$i"
            ]);
        }
    }
}
