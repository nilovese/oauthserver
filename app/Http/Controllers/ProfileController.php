<?php

namespace App\Http\Controllers;


use App\core\ProfileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileManager;

    public function __construct(ProfileManager $profileManager)
    {
        $this->profileManager = $profileManager;
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
        return $profiles = $this->profileManager
                                ->Profiles(Auth::user());


    }


    public function Logout()
    {
        \Auth::logout();
        
    }


}
