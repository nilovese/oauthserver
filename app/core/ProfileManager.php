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
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProfileManager
{
    protected $request;

    protected $user;

    public function __construct(Request $request)
    {
        $this->request = $request->all();
    }

    public function GetUserFromOuthCredential()
    {

        $this->user = User::find(\Authorizer::getResourceOwnerId());
    }

    public function SaveProfile()
    {
        return $this->user->profiles()->save(Profile::create($this->request));
    }

    public function Profiles()
    {
        return $this->user->profiles;
    }
}