<?php
/**
 * Created by PhpStorm.
 * User: kausersarker
 * Date: 12/22/15
 * Time: 4:43 PM
 */

namespace App\core;


use App\Profile;
use App\User;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProfileManager
{
    protected $request;

    protected $user;

    public function SetUser($user)
    {
        $this->user = $user;
    }

    public function GetUserFromOuthCredential()
    {
        $this->user = User::find(\Authorizer::getResourceOwnerId());
    }

    public function SaveProfile($request)
    {
        $this->request = $request->all();
        $profile = $this->user->profiles()->save(Profile::create($this->request));
        if(isset($this->request["client_id"]))
        {
            $profile->clients()->attach($this->request["client_id"]);
        }
        return $profile;

    }

    public function EditProfile($request)
    {
        $this->request = $request->all();
        unset($this->request["access_token"]);
        unset($this->request["client_id"]);
        $profile = Profile::find($this->request["id"]);
        $profile->update($this->request);
        return $profile;
    }

    public function Profiles()
    {
        return $this->user->profiles;
    }
}