<?php

namespace App\Http\Controllers;

use App\core\ProfileManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
     protected $profileManager;

     public function __construct(ProfileManager $profileManager)
     {
        $this->profileManager = $profileManager;
        $this->profileManager->GetUserFromOuthCredential();
     }

     public function SaveProfile(Request $request)
     {
        return $this->profileManager->SaveProfile($request);
     }

    public function EditProfile(Request $request)
    {
        return $this->profileManager->EditProfile($request);
    }

    public function Profiles()
    {
        return $this->profileManager->Profiles();
    }

    



}
