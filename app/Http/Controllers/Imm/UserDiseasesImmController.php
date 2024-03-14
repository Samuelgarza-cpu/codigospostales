<?php

namespace App\Http\Controllers\imm;
use App\Http\Controllers\Controller;
use App\Models\Becas\User;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\UserDiseases;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class UserDiseasesImmController extends Controller
{
    public function create(Request $request, Response $response,int $id,int $diseas)
    {
        // $response->data = ObjResponse::DefaultResponse();
        return "HOLAAAAAAAAAAAAA";
        try {
            $new_gender = UserDiseases::create([
                'user_datageneral_id' => $id,
                'diseas_id'=> $diseas
            ]);
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
