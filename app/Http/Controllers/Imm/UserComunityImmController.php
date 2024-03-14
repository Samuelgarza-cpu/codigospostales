<?php

namespace App\Http\Controllers\imm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\UserComunity;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class UserComunityImmController extends Controller
{
    public function create(Request $request, Response $response,int $latestId,int $id = null)
    {
        if ($id) {
            $userCommunity = UserComunity::where("user_datageneral_id",$id)->first();
            if (!$userCommunity) {
                $userCommunity = new UserComunity();
                $userCommunity->user_datageneral_id = $latestId;
            }
            $userCommunity->street = $request->street;
            $userCommunity->number = $request->number;
            $userCommunity->colonies_id = intval($request->colonies_id);
            $userCommunity->zone = $request->zone;
            $userCommunity->dependece = $request->dependece;

            if (\is_int($request->statebirth)) 
                    $userCommunity->statebirth = $request->statebirth;
                    $userCommunity->statebirth = intval($request->statebirth);
            $userCommunity->save();
        }
        else{
            $userCommunity = new UserComunity();
            $userCommunity->street = $request->street;
            $userCommunity->number = $request->number;
            $userCommunity->colonies_id = intval($request->colonies_id);
            $userCommunity->zone = $request->zone;
            $userCommunity->dependece = $request->dependece;
            $userCommunity->statebirth = intval($request->statebirth);
            $userCommunity->user_datageneral_id = $latestId;
            $userCommunity->save();
        }
        
       
    }
}
