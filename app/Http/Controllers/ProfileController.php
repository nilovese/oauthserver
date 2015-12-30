<?php

namespace App\Http\Controllers;


use App\core\ProfileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\OauthClient;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileManager;

    public function __construct(ProfileManager $profileManager)
    {
        $this->profileManager = $profileManager;
        if(Auth::check())
        {
            $this->profileManager->SetUser(Auth::user());
        }
    }

    public function SaveProfile(Request $request)
    {
        $this->profileManager->GetUserFromOuthCredential();
        return $this->profileManager->SaveProfile($request);
    }

    public function EditProfile(Request $request)
    {
        $this->profileManager->GetUserFromOuthCredential();
        return $this->profileManager->EditProfile();
    }


    public function NewProfile()
    {
        return view("profile.new");
    }

    public function Profiles()
    {
        return view("profile.profiles",["profiles"=>$this->profileManager->Profiles(),"clients"=>OauthClient::all()]);
    }


    public function Logout()
    {
        \Auth::logout();
        
    }


}
