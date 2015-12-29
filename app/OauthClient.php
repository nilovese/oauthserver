<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    protected $table = 'oauth_clients';

    protected $fillable = ['secret', 'name'];

    public function Profiles()
    {
        return $this->belongsToMany("App\Profile","profile_client","profile_id","client_id");
    }
}
