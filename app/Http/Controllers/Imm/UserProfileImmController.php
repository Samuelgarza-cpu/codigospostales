<?php
namespace App\Http\Controllers\Imm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\UserProfile;
use App\Models\imm\UserData;
use App\Models\imm\UserWorkshops;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\imm\UserDiseases;
use App\Models\imm\UserViolence;
use App\Http\Controllers\imm\UserProceedingsImmController;
use App\Http\Controllers\imm\UserComunityImmController;
use App\Models\imm\Services;
use App\Models\imm\UserViolenceField;
use App\Models\imm\UserDisabilities;
use App\Models\imm\UserProfilesAdicttions;
use App\Models\imm\UserServicesReferences;



use App\Models\imm\UserProfilesMedAdi;
use App\Models\imm\UserService;

use PhpParser\Node\Stmt\Return_;

class UserProfileImmController extends Controller
{
    public function createData(Request $request, Response $response,int $id=null)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            
            // Verifica si hay archivos en "files" y si son imágenes válidas
          
            $userData = UserData::where("id", $id)->first();
            if (!$userData) {
                $userData = new UserData();
            }
            $userData->name = $request->name;
            $userData->lastName = $request->lastName;
            $userData->secondName = $request->secondName;
            $userData->sex = $request->sex;
            if ($request->module == 1) {
            $userData->gender_id = intval($request->gender_id);
            $userData->civil_status_id = intval($request->civil_status_id);
            }
            $userData->birthdate = date('Y-m-d', strtotime($request->birthdate));
            $userData->age = intval($request->age);
            $userData->telephone = $request->telephone;
            $userData->email = $request->email;
            $userData->numberchildrens = intval($request->numberchildrens);
            $userData->numberdaughters = intval($request->numberdaughters);
            $userData->pregnant = $request->pregnant;
            $userData->module = $request->module;

        
        

            $userData->save();


            if ($request->module == 1) {
                $procceding = new UserProceedingsImmController();
                $procceding->create($request,$response,$userData->id,$id);
            }
            else if($request->module==2)
            {
                $userWorkshops = UserWorkshops::where("user_datageneral_id", $id)->first();
                if (!$userWorkshops) {
                    $userWorkshops = new UserWorkshops();
                    $userWorkshops->user_datageneral_id = $id;    
                }
                $userWorkshops->date = date('Y-m-d', strtotime($request->date));
                $userWorkshops->location = $request->location;
                $userWorkshops->agent = $request->agent;
                $userWorkshops->colaboration = $request->colaboration;
                $userWorkshops->ponent = $request->ponent;
                $userWorkshops->issue = $request->issue;
                $userWorkshops->user_datageneral_id = intval($userData->id);
                $userWorkshops->axi_id = intval($request->axi_id);
                $userWorkshops->axi_program_id = intval($request->axi_program_id);
                $userWorkshops->observations = $request->observations;
                $userWorkshops->save();

            }
           $comunity = new UserComunityImmController();
            $comunity->create($request,$response,$userData->id,$id);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | datos de usuario registrado.';
            $response->data["alert_text"] = 'UserData registrada';
            $response->data["result"] = $userData->id;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function createProfile(Request $request, Response $response,int $id)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $UserProfile = UserProfile::where("user_datageneral_id", $id)->first();
            if (!$UserProfile) {
                $UserProfile = new UserProfile();
                $UserProfile->user_datageneral_id = $id;
            }
            else{
                UserDiseases::where("user_datageneral_id",$id)->delete();
                UserDisabilities::where("user_datageneral_id",$id)->delete();
                UserProfilesMedAdi::where("user_profiles_id",$UserProfile->id)->delete();
                UserProfilesAdicttions::where("user_profiles_id",$UserProfile->id)->delete();
                
            }


            $UserProfile->activity_id = $request->activity_id;
            $UserProfile->sourceofincome = $request->sourceofincome;
            $UserProfile->workplace_id = $request->workplace_id;
            $UserProfile->entry_time = $request->entry_time;
            $UserProfile->departure_time = $request->departure_time;

            $UserProfile->training_id = $request->training_id;
            $UserProfile->finish = $request->finish;
            $UserProfile->wantofindwork = $request->wantofindwork;
            $UserProfile->wanttotrain = $request->wanttotrain;
            $UserProfile->wantocontinuestudying = $request->wantocontinuestudying;
            $UserProfile->household_id = $request->household_id;
            // $UserProfile->medicalservice_id = $request->medicalservice_id;
            // $UserProfile->addiction_id = $request->addiction_id;
            $UserProfile->caseviolence = $request->caseviolence;

            $UserProfile->save();

            if (is_array($request->diseases)) {

                    foreach ($request->diseases as $key => $disease) {
                    UserDiseases::create([
                        'user_datageneral_id' => $id,
                        'diseas_id'=> $disease["value"],
                        'origin_id'=> $disease["origin_id"]
                    ]);

                    }
            }
            if (is_array($request->disabilities)) {
                foreach ($request->disabilities as $key => $disabilitie) {
                    UserDisabilities::create([
                     'user_datageneral_id' => $id,
                     'disability_id'=> $disabilitie["value"],
                     'origin_id'=> $disabilitie["origin_id"]

                 ]);
            }

            }
            if (is_array($request->medicalservice_id)) {
                foreach ($request->medicalservice_id as $key => $medicalservice) {
                    UserProfilesMedAdi::create([
                     'user_profiles_id' => $UserProfile->id,
                     'medicalservice_id'=> $medicalservice["value"],

                 ]);
            }
        }
            if (is_array($request->addiction_id)) {
                foreach ($request->addiction_id as $key => $addictions) {
                    UserProfilesAdicttions::create([
                     'user_profiles_id' => $UserProfile->id,
                     'addiction_id'=> $addictions["value"],

                 ]);
            }
            }
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | perfil registrado.';
            $response->data["alert_text"] = 'Profile registrado';
            $response->data["result"] = $id;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function createViolence(Request $request, Response $response,int $id)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $userViolence = UserViolence::where("user_datageneral_id", $id)->first();
            if (!$userViolence) {

                $userViolence = new UserViolence();
                $userViolence->user_datageneral_id = $id;
            }
            else{
                UserViolenceField::where("user_violences_id",$userViolence->id)->delete();

            }
            // $userViolence->typesviolence_id = intval($request->typesviolence_id);
            // $userViolence->fieldsviolence_id = intval($request->fieldsviolence_id);
            $userViolence->lowefecct = $request->lowefecct;
            $userViolence->narrationfacts = $request->narrationfacts;
            $userViolence->date = date('Y-m-d', strtotime($request->date));
            $userViolence->location = $request->location;
            $userViolence->addiction_id = intval($request->addiction_id);
            $userViolence->weapons = $request->weapons;
            $userViolence->save();
            
            
            if ($request->typesviolences) {
                foreach ($request->typesviolences as $key => $typesviolence) {
                    UserViolenceField::create([
                     'user_violences_id' => $userViolence->id,
                     'typesviolence_id'=> $typesviolence["value"],
                     'fieldsviolence_id'=> $typesviolence["origin_id"]

                 ]);
            }

            }
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | caso de violencia registrado.';
            $response->data["alert_text"] = 'UserViolence registrado';
            $response->data["result"] = $userViolence->id;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function profileAgressor(Request $request, Response $response,int $id=null)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {


                $userData = UserData::where("user_violence", $id)->first();
                if (!$userData) {
                    
                    $userData = new UserData();
                    $userData->user_violence = $id;
                    $userViolence = new UserViolence();
                    $userViolence->user_datageneral_id = $id;
                    

                }
                else{
                    $userViolence = UserViolence::where("id", $userData->user_violence)->first();
                    // $userData = UserViolence::where("id", $id)->first();
                    // $id = intval($userData->user_datageneral_id);
                    // $userData = UserData::where("id", $id)->first();
                    
                }
                $userData->name = $request->name;
                $userData->lastName = $request->lastName;
                $userData->secondName = $request->secondName;
                $userData->sex = $request->sex;
                $userData->gender_id = intval($request->gender_id);
                $userData->birthdate = date('Y-m-d', strtotime($request->birthdate));
                $userData->age = $request->age;
                $userData->telephone = $request->telephone;
                $userData->module = $request->module;

                $userData->save();
                
                $comunity = new UserComunityImmController();
                $comunity->create($request,$response,$userData->id,$userData->id);
                $this->createProfile($request,$response,$userData->id);
                $idreturn = UserViolence::where("id", $id)->first();
                    $id= intval($idreturn->user_datageneral_id);
                $response->data = ObjResponse::CorrectResponse();
                $response->data["message"] = 'peticion satisfactoria | datos del agresor registrados.';
                $response->data["alert_text"] = 'UserData registrada';
                $response->data["result"] = $id;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function createService(Request $request, Response $response,int $id)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $UserService = UserService::where("user_datageneral_id", $id)->first();
            if (!$UserService) {
                $UserService = new UserService();
                $id = intval($id);
                $UserService->user_datageneral_id = $id;
            }
            else{
                UserServicesReferences::where("user_service_id",$UserService->id)->delete();

            }
            // $UserService->workplace_id = intval($request->workplace_id);
            $UserService->subservice = $request->subservice;
            $UserService->axi_id = intval($request->axi_id);
            $UserService->axi_program_id = intval($request->axi_program_id);
            $UserService->lineacction = $request->lineacction;
            $UserService->observations = $request->observations;
            $UserService->status_id = intval($request->status_id);
            $UserService->save();
            if ($request->workplace_id) {
                foreach ($request->workplace_id as $key => $workplace) {
                    UserServicesReferences::create([
                     'user_service_id' => $UserService->id,
                     'services_id'=> $workplace["value"],
                 ]);
            }
        }

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | servicio registrado.';
            $response->data["alert_text"] = 'UserData registrada';
            $response->data["result"] = $UserService;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function index(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserData::where('user_datageneral.active', true)
            ->select('user_proceedings.procceding as Folio', 'user_datageneral.id','user_violences.id as idviolence', 'user_profiles.caseviolence as caso_violencia', 'user_datageneral.name as Nombre', 'user_datageneral.lastName as Apellido paterno', 'user_datageneral.secondName as Apellido materno',
                'status.status as status')
            ->join('user_proceedings', 'user_proceedings.user_datageneral_id', '=', 'user_datageneral.id')
            ->join('user_services', 'user_services.user_datageneral_id', '=', 'user_datageneral.id')
            ->join('status', 'status.id', '=', 'user_services.status_id')
            ->join('user_profiles', 'user_profiles.user_datageneral_id', '=', 'user_datageneral.id')

            ->leftjoin('user_violences', 'user_violences.user_datageneral_id', '=', 'user_datageneral.id')
            ->where('user_datageneral.module', 1)

            ->orderBy('user_datageneral.id', 'asc')
            ->get();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de tipos de violencia.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function usersM4Module1(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserData::where('user_datageneral.active', true)
            ->select('user_proceedings.procceding as Folio', 'user_datageneral.id','user_violences.id as idviolence', 'user_profiles.caseviolence as caso_violencia', 'user_datageneral.name as Nombre', 'user_datageneral.lastName as Apellido paterno', 'user_datageneral.secondName as Apellido materno',
                'status.status as status')
            ->join('user_proceedings', 'user_proceedings.user_datageneral_id', '=', 'user_datageneral.id')
            ->join('user_services', 'user_services.user_datageneral_id', '=', 'user_datageneral.id')
            ->join('status', 'status.id', '=', 'user_services.status_id')
            ->join('user_profiles', 'user_profiles.user_datageneral_id', '=', 'user_datageneral.id')
            ->join('user_proceedings as pro', 'pro.user_datageneral_id', '=', 'user_datageneral.id')

            ->leftjoin('user_violences', 'user_violences.user_datageneral_id', '=', 'user_datageneral.id')
            ->where('user_datageneral.module', 1)
            ->whereNotExists(function ($query)  {
                $query->select(DB::raw(1))
                    ->from('expendents as ex')
                    ->whereRaw('ex.procceding_id = pro.id');
            })
            ->orderBy('user_datageneral.id', 'asc')
            ->get();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de tipos de violencia.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    
    public function allUsersModule2(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserData::where('user_datageneral.active', true)
            ->select('user_workshops.id as id_taller','user_datageneral.id','user_datageneral.name as Nombre', 'user_datageneral.lastName as Apellido paterno', 'user_datageneral.secondName as Apellido materno',
            'user_comunities.dependece as Dependecia'
            )
            ->join('user_comunities', 'user_comunities.user_datageneral_id', '=', 'user_datageneral.id')
            ->join('user_workshops', 'user_workshops.user_datageneral_id', '=', 'user_datageneral.id')

            ->where('user_datageneral.module', 2)

            ->orderBy('user_datageneral.id', 'asc')
            ->get();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de usuarios en talleres.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function destroy(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            UserData::where('id', $id)
            ->update([
                'active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | Usuario eliminado.';
            $response->data["alert_text"] ='Usuario eliminado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getData(Request $request, Response $response,int $id){
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserData::where('user_datageneral.id', $id)
            ->select(
                'user_datageneral.id',
                'user_datageneral.name',
                'user_datageneral.lastName',
                'user_datageneral.secondName',
                'user_datageneral.gender_id',
                'user_datageneral.sex',
                'user_datageneral.birthdate',
                'user_datageneral.age',
                'user_datageneral.telephone',
                'user_datageneral.email',
                'user_datageneral.civil_status_id',
                'user_datageneral.numberchildrens',
                'user_datageneral.numberdaughters',
                'user_datageneral.pregnant',
                'user_datageneral.module',
                'user_proceedings.procceding',
                'user_proceedings.timeingress',

                DB::raw("DATE_FORMAT(user_proceedings.dateingress, '%m/%d/%Y') AS dateingress"),
                'user_proceedings.timeingress',
                'user_comunities.street',
                'user_comunities.number',
                'user_comunities.colonies_id',
                'user_comunities.zone',
                'user_comunities.statebirth',
            )
            ->leftjoin('user_proceedings', 'user_proceedings.user_datageneral_id', '=', 'user_datageneral.id')
            ->leftjoin('user_comunities', 'user_comunities.user_datageneral_id', '=', 'user_datageneral.id')
            
            ->orderBy('user_datageneral.id', 'asc')
            ->get();


            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de tipos de violencia.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getProfile(Request $request, Response $response,int $id){
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserProfile::where('user_profiles.user_datageneral_id', $id)
            ->select(
                'user_profiles.activity_id',
                'user_profiles.sourceofincome',
                'user_profiles.workplace_id',
                'user_profiles.entry_time',
                'user_profiles.departure_time',
                'user_profiles.training_id',
                'user_profiles.finish',
                'user_profiles.wantofindwork',
                'user_profiles.wanttotrain',
                'user_profiles.wantocontinuestudying',
                'user_profiles.household_id',
                'user_profiles.caseviolence',
                DB::raw('GROUP_CONCAT(DISTINCT medicalservices.medicalservice,user_profiles_medicalservices.medicalservice_id,",",user_profiles_medicalservices.medicalservice_id) as medicalservices'),
                DB::raw('GROUP_CONCAT(DISTINCT addictions.addiction,user_profiles_adicttions.addiction_id,",",user_profiles_adicttions.addiction_id) as adicttions'),
                DB::raw('GROUP_CONCAT(DISTINCT diseases.diseas,user_diseases.diseas_id) as diseas_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT diseases.diseas,user_diseases.diseas_id,"_description,",user_diseases.origin_id) as diseas_origin_id'),
                DB::raw('GROUP_CONCAT(DISTINCT disabilities.disability,disabilities.id) as disability_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT disabilities.disability,disabilities.id,"_description,",user_disabilities.origin_id) as disability_origin_id')
            )
            ->leftJoin('user_disabilities', 'user_disabilities.user_datageneral_id', '=', 'user_profiles.user_datageneral_id')
            ->leftJoin('user_diseases', 'user_diseases.user_datageneral_id', '=', 'user_profiles.user_datageneral_id')
            ->leftJoin('diseases', 'diseases.id', '=', 'user_diseases.diseas_id')
            ->leftJoin('disabilities', 'disabilities.id', '=', 'user_disabilities.disability_id')
            ->leftJoin('user_profiles_adicttions', 'user_profiles_adicttions.user_profiles_id', '=', 'user_profiles.id')
            ->leftJoin('user_profiles_medicalservices', 'user_profiles_medicalservices.user_profiles_id', '=', 'user_profiles.id')
            ->leftJoin('medicalservices', 'medicalservices.id', '=', 'user_profiles_medicalservices.medicalservice_id')
            ->leftJoin('addictions', 'addictions.id', '=', 'user_profiles_adicttions.addiction_id')
            ->groupBy(
                'user_profiles.activity_id',
                'user_profiles.sourceofincome',
                'user_profiles.workplace_id',
                'user_profiles.entry_time', // Agrega esta columna a GROUP BY
                'user_profiles.departure_time',
                'user_profiles.training_id',
                'user_profiles.finish',
                'user_profiles.wantofindwork',
                'user_profiles.wanttotrain',
                'user_profiles.wantocontinuestudying',
                'user_profiles.household_id',
                'user_profiles.caseviolence',
              
            
            )
            ->get();
        


            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de tipos de violencia.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getViolence(Request $request, Response $response,int $id){
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserViolence::where('user_violences.user_datageneral_id', $id)
            ->select(
           
            'user_violences.lowefecct',
            'user_violences.narrationfacts',
            'user_violences.date',
            'user_violences.location',
            'user_violences.addiction_id',
            'user_violences.weapons',
            DB::raw('GROUP_CONCAT(DISTINCT typesviolences.violence,user_violence_fields.typesviolence_id) as user_violence_fields'),
             DB::raw('GROUP_CONCAT(DISTINCT typesviolences.violence,user_violence_fields.typesviolence_id,"_description,",user_violence_fields.fieldsviolence_id) as fieldsviolence_id')
            )
            ->leftjoin('user_violence_fields', 'user_violence_fields.user_violences_id', '=', 'user_violences.id')
            ->leftjoin('typesviolences', 'typesviolences.id', '=', 'user_violence_fields.typesviolence_id')
            ->leftjoin('fieldsviolences', 'fieldsviolences.id', '=', 'user_violence_fields.fieldsviolence_id')

            ->groupBy(
                'user_violences.id',
                'user_violences.lowefecct',
                'user_violences.narrationfacts',
                'user_violences.date',
                'user_violences.location',
                'user_violences.addiction_id',
                'user_violences.weapons',
                )
            ->orderBy('user_violences.id', 'asc')
            ->get();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de tipos de violencia.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getprofileAgressor(Request $request, Response $response,int $id){
        $response->data = ObjResponse::DefaultResponse();
        try {
            $id = UserViolence::where('user_violences.user_datageneral_id', $id)->first();
            $id = intval($id->id);

            $list = UserData::where('user_datageneral.user_violence', $id)
            ->select(
                'user_datageneral.name',
                'user_datageneral.lastName',
                'user_datageneral.secondName',
                'user_datageneral.gender_id',
                'user_datageneral.sex',
                'user_datageneral.birthdate',
                'user_datageneral.age',
                'user_comunities.street',
                'user_comunities.number',
                'user_comunities.colonies_id',
                'user_comunities.zone',
                'user_datageneral.telephone',
                'user_comunities.statebirth',
                'user_profiles.activity_id',
                'user_profiles.sourceofincome',
                'user_profiles.workplace_id',
                'user_profiles.entry_time',
                'user_profiles.departure_time',
                'user_profiles.household_id',
                DB::raw('GROUP_CONCAT(DISTINCT medicalservices.medicalservice,user_profiles_medicalservices.medicalservice_id,",",user_profiles_medicalservices.medicalservice_id) as medicalservices'),
                DB::raw('GROUP_CONCAT(DISTINCT addictions.addiction,user_profiles_adicttions.addiction_id,",",user_profiles_adicttions.addiction_id) as adicttions'),
                DB::raw('GROUP_CONCAT(DISTINCT diseases.diseas,user_diseases.diseas_id) as diseas_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT diseases.diseas,user_diseases.diseas_id,"_description,",user_diseases.origin_id) as diseas_origin_id'),
                DB::raw('GROUP_CONCAT(DISTINCT disabilities.disability,disabilities.id) as disability_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT disabilities.disability,disabilities.id,"_description,",user_disabilities.origin_id) as disability_origin_id')
            )
            ->leftjoin('user_comunities', 'user_comunities.user_datageneral_id', '=', 'user_datageneral.id')
            ->leftjoin('user_profiles', 'user_profiles.user_datageneral_id', '=', 'user_datageneral.id')
            ->leftjoin('user_disabilities', 'user_disabilities.user_datageneral_id', '=', 'user_profiles.user_datageneral_id')
            ->leftjoin('user_diseases', 'user_diseases.user_datageneral_id', '=', 'user_profiles.user_datageneral_id')
            ->leftjoin('diseases', 'diseases.id', '=', 'user_diseases.diseas_id')
            ->leftjoin('disabilities', 'disabilities.id', '=', 'user_disabilities.disability_id')
            ->leftjoin('user_profiles_adicttions', 'user_profiles_adicttions.user_profiles_id', '=', 'user_profiles.id')
            ->leftjoin('user_profiles_medicalservices', 'user_profiles_medicalservices.user_profiles_id', '=', 'user_profiles.id')
            ->leftjoin('medicalservices', 'medicalservices.id', '=', 'user_profiles_medicalservices.medicalservice_id')
            ->leftjoin('addictions', 'addictions.id', '=', 'user_profiles_adicttions.addiction_id')
            ->groupBy(
                'user_datageneral.id',
                'user_datageneral.name',
                'user_datageneral.lastName',
                'user_datageneral.secondName',
                'user_datageneral.gender_id',
                'user_datageneral.sex',
                'user_datageneral.birthdate',
                'user_datageneral.age',
                'user_comunities.street',
                'user_comunities.number',
                'user_comunities.colonies_id',
                'user_comunities.zone',
                'user_datageneral.telephone',
                'user_comunities.statebirth',
                'user_profiles.activity_id',
                'user_profiles.sourceofincome',
                'user_profiles.workplace_id',
                'user_profiles.entry_time',
                'user_profiles.departure_time',
                'user_profiles.household_id',
              
            )
            ->orderBy('user_datageneral.id', 'asc')
            ->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de tipos de violencia.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getServices(Request $request, Response $response,int $id){
        $response->data = ObjResponse::DefaultResponse();
        try {

            $list = UserService::where('user_services.user_datageneral_id', $id)
            ->select(
                'user_services.subservice',
                'user_services.axi_id',
                'user_services.axi_program_id',
                'user_services.lineacction',
                'user_services.observations',
                'user_services.status_id',
                DB::raw('GROUP_CONCAT(DISTINCT services.service,user_services_references.services_id,",",user_services_references.services_id) as workplaces'),

            )
            ->orderBy('user_services.id', 'asc')
            ->leftjoin('user_services_references', 'user_services_references.user_service_id', '=', 'user_services.id')
            ->leftjoin('services', 'services.id', '=', 'user_services_references.services_id')
            ->groupBy(
                'user_services.id',
                'user_services.subservice',
                'user_services.axi_id',
                'user_services.axi_program_id',
                'user_services.lineacction',
                'user_services.observations',
                'user_services.status_id',
              
            )
            ->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de servicios del usuario.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function statusServiceProfile(Request $request, Response $response,int $iduser,int $idstatus){
        $response->data = ObjResponse::DefaultResponse();
        try {
            UserService::where('user_datageneral_id', $iduser)
            ->update([
                'status_id' => $idstatus,
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | Status Actualizado.';
            $response->data["alert_text"] ='Status Actualizado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getUserAllData(Request $request, Response $response,int $id){
        $response->data = ObjResponse::DefaultResponse();
        try {

            $list = UserData::from('user_datageneral as dt')
            ->select(        
                'pro.procceding as Folio',
                DB::raw("DATE_FORMAT(pro.dateIngress, '%d/%m/%Y') as `Fecha de ingreso`"),
                DB::raw("TIME_FORMAT(pro.timeingress , '%h:%i %p') as `Hora de ingreso`"),
                'dt.name as Nombre',
                'dt.lastName as `Apellido Paterno`',
                'dt.secondName as `Apellido Materno`',
                DB::raw("IF(dt.sex = 0, 'Hombre', 'Mujer') as Sexo"),
                'g.gender as Genero',
                DB::raw("DATE_FORMAT(dt.birthdate, '%d/%m/%Y') as `Fecha de nacimiento`"),
                'dt.age as Edad',
                'dt.telephone as Telefono',
                'dt.email as Correo',
                'cv.civil_status as `Estado civil`',
                'dt.numberdaughters as `Numero de hijos`',
                'dt.numberchildrens as `Numero de hijas`',
                DB::raw("IF(dt.pregnant = 0, 'Si', 'No') as `Esta Embarazada`"),
                'com.street as `Calle`',
                'com.number as `Numero`',
                'com.colonies_id',
                'com.statebirth',
                DB::raw("IF(com.zone = 0, 'Urbana', 'Rural') as `Zona`"),
                'act.activity as `Actividad que realiza`',
                DB::raw("IF(pf.sourceofincome = 0, 'Si', 'No') as `Fuentes de ingresos`"),
                'wk.workplace as `Lugar de trabajo`',
                DB::raw("TIME_FORMAT(pf.entry_time, '%h:%i %p') as `Hora de entrada`"),
                DB::raw("TIME_FORMAT(pf.departure_time, '%h:%i %p') as `Hora de salida`"),
                'tr.training as `Formacion educativa`',
                DB::raw("IF(pf.finish = 0, 'Si', 'No') as `¿Concluida?`"),
                DB::raw("IF(pf.wantofindwork = 0, 'Si', 'No') as `¿Desea encontrar trabajo?`"),
                DB::raw("IF(pf.wanttotrain = 0, 'Si', 'No') as `¿Desea Capacitarse?`"),
                DB::raw("IF(pf.wantocontinuestudying = 0, 'Si', 'No') as `¿Desea seguir con sus estudios?`"),
                'hous.household as Vivienda',
                DB::raw("GROUP_CONCAT(DISTINCT  md.medicalservice) as `Serviciós medícos`"),
                DB::raw("GROUP_CONCAT(DISTINCT  addic.addiction) as Adicciones"),
                DB::raw("GROUP_CONCAT(DISTINCT  CONCAT('Enfermedad ', d.diseas, ' Origen ', ori.origin)) as `Enfermedades y origen`"),
                DB::raw("GROUP_CONCAT(DISTINCT  CONCAT('Discapacidad ', disa.disability, ' Origen ', orig.origin)) as `Discapacidades y origen`"),
                'vio.lowefecct as `Efectos de violencia`',
                'vio.narrationfacts as `Narracion de hechos`',
                DB::raw("DATE_FORMAT(vio.date, '%d/%m/%Y') as `Fecha de hechos`"),
                'adi.addiction as `El agresor estaba bajo los efectos`',
                DB::raw("CASE WHEN vio.weapons = 0 THEN 'Si' WHEN vio.weapons = 1 THEN 'No' ELSE NULL END as `¿Uso Armas?`"),
                DB::raw("GROUP_CONCAT(DISTINCT  CONCAT('Tipo violencia ', typ.violence, ' Ambito violencia ', fields.fieldviolence)) as `Tipos de violencia y Ambitos`"),
                DB::raw("'agresor' as `agresor`"),
                'dg.name as agresor_Nombre',
                'dg.lastName as `agresor_Apellido Paterno`',
                'dg.secondName as `agresor_Apellido Materno`',
                DB::raw("(CASE WHEN dg.sex = 0 THEN 'Hombre' WHEN dg.sex = 1 THEN 'Mujer' ELSE NULL END) as agresor_Sexo"),
                'gen.gender as agresor_Genero',
                DB::raw("DATE_FORMAT(dg.birthdate, '%d/%m/%Y') as `agresor_Fecha de nacimiento`"),
                'dg.age as agresor_Edad',
                'dg.telephone as agresor_Telefono',
                'comag.street as `agresor_Calle`',
                'comag.number as `agresor_Numero`',
                'comag.colonies_id as `agresor_colonies_id`',
                DB::raw("CASE WHEN comag.zone = 0 THEN 'Urbana' WHEN comag.zone = 1 THEN 'Rural' ELSE NULL END as agresor_Zona"),
                'actag.activity as `agresor_Actividad que realiza`',
                DB::raw("CASE WHEN pfag.sourceofincome = 0 THEN 'Si' WHEN pfag.sourceofincome = 1 THEN 'No' ELSE NULL END as `agresor_Fuentes de ingresos`"),
                'wkag.workplace as `agresor_Lugar de trabajo`',
                DB::raw("TIME_FORMAT(pfag.entry_time, '%h:%i %p') as `agresor_Hora de entrada`"),
                DB::raw("TIME_FORMAT(pfag.departure_time, '%h:%i %p') as `agresor_Hora de salida`"),
                'housag.household as agresor_Vivienda',
                DB::raw("GROUP_CONCAT( DISTINCT mdag.medicalservice) as `agresor_Serviciós medícos`"),
                DB::raw("GROUP_CONCAT(DISTINCT  addicag.addiction) as agresor_Adicciones"),
                DB::raw("GROUP_CONCAT(DISTINCT  CONCAT('Enfermedad ', dag.diseas, ' Origen ', oriag.origin)) as `agresor_Enfermedades y origen`"),
                DB::raw("GROUP_CONCAT(DISTINCT  CONCAT('Discapacidad ', disbag.disability, ' Origen ', origg.origin)) as `agresor_Discapacidades y origen`"),
                'serv.subservice as Subservicio',
                'serv.lineacction as `Linea de acción`',
                'serv.observations as Observaciones',
                'ax.axi as Eje',
                'axp.axisprogram as Programa',
                's.status',
                DB::raw("GROUP_CONCAT(DISTINCT  svc.service) as `Serviciós`"),

            )
            ->join('genders as g', 'dt.gender_id', '=', 'g.id')
            ->join('civil_status as cv', 'dt.civil_status_id', '=', 'cv.id')
            ->join('user_proceedings as pro', 'pro.user_datageneral_id', '=', 'dt.id')
            ->join('user_comunities as com', 'com.user_datageneral_id', '=', 'dt.id')
            ->join('user_profiles as pf', 'pf.user_datageneral_id', '=', 'dt.id')
            ->join('activities as act', 'act.id', '=', 'pf.activity_id')
            ->join('workplaces as wk', 'wk.id', '=', 'pf.workplace_id')
            ->join('trainings as tr', 'tr.id', '=', 'pf.training_id')
            ->join('households as hous', 'hous.id', '=', 'pf.household_id')
            ->leftJoin('user_profiles_medicalservices as pfmd', 'pfmd.user_profiles_id', '=', 'pf.id')
            ->leftJoin('user_profiles_adicttions as pfadd', 'pfadd.user_profiles_id', '=', 'pf.id')
            ->leftJoin('medicalservices as md', 'md.id', '=', 'pfmd.medicalservice_id')
            ->leftJoin('addictions as addic', 'addic.id', '=', 'pfadd.addiction_id')
            ->leftJoin('user_diseases as dis', 'dis.user_datageneral_id', '=', 'dt.id')
            ->leftJoin('diseases as d', 'd.id', '=', 'dis.diseas_id')
            ->leftJoin('origins as ori', 'ori.id', '=', 'dis.origin_id')
            ->leftJoin('user_disabilities as disab', 'disab.user_datageneral_id', '=', 'dt.id')
            ->leftJoin('disabilities as disa', 'disa.id', '=', 'disab.disability_id')
            ->leftJoin('origins as orig', 'orig.id', '=', 'disab.origin_id')
            ->leftJoin('user_violences as vio', 'vio.user_datageneral_id', '=', 'dt.id')
            ->leftJoin('addictions as adi', 'adi.id', '=', 'vio.addiction_id')
            ->leftJoin('user_violence_fields as viofi', 'viofi.user_violences_id', '=', 'vio.id')
            ->leftJoin('typesviolences as typ', 'typ.id', '=', 'viofi.typesviolence_id')
            ->leftJoin('fieldsviolences as fields', 'fields.id', '=', 'viofi.fieldsviolence_id')
            ->leftJoin('user_datageneral as dg', 'dg.user_violence', '=', 'vio.id')
            ->leftJoin('genders as gen', 'dg.gender_id', '=', 'gen.id')
            ->leftJoin('user_comunities as comag', 'comag.user_datageneral_id', '=', 'dg.id')
            ->leftJoin('user_profiles as pfag', 'pfag.user_datageneral_id', '=', 'dg.id')
            ->leftJoin('activities as actag', 'actag.id', '=', 'pfag.activity_id')
            ->leftJoin('workplaces as wkag', 'wkag.id', '=', 'pfag.workplace_id')
            ->leftJoin('households as housag', 'housag.id', '=', 'pfag.household_id')
            ->leftJoin('user_profiles_medicalservices as pfmdag', 'pfmdag.user_profiles_id', '=', 'pfag.id')
            ->leftJoin('user_profiles_adicttions as pfaddag', 'pfaddag.user_profiles_id', '=', 'pfag.id')
            ->leftJoin('medicalservices as mdag', 'mdag.id', '=', 'pfmdag.medicalservice_id')
            ->leftJoin('addictions as addicag', 'addicag.id', '=', 'pfaddag.addiction_id')
            ->leftJoin('user_diseases as disag', 'disag.user_datageneral_id', '=', 'dg.id')
            ->leftJoin('diseases as dag', 'dag.id', '=', 'disag.diseas_id')
            ->leftJoin('origins as oriag', 'oriag.id', '=', 'disag.origin_id')
            ->leftJoin('user_disabilities as disabag', 'disabag.user_datageneral_id', '=', 'dg.id')
            ->leftJoin('disabilities as disbag', 'disbag.id', '=', 'disabag.disability_id')
            ->leftJoin('origins as origg', 'origg.id', '=', 'disabag.origin_id')
            ->leftJoin('user_services as serv', 'serv.user_datageneral_id', '=', 'dt.id')
            ->leftJoin('status as s', 's.id', '=', 'serv.status_id')
            ->leftJoin('axis as ax', 'ax.id', '=', 'serv.axi_id')
            ->leftJoin('axisprograms as axp', 'axp.id', '=', 'serv.axi_program_id')
            ->leftJoin('user_services_references as seref', 'seref.user_service_id', '=', 'serv.id')
            ->leftJoin('services as svc', 'svc.id', '=', 'seref.services_id')

            ->where('dt.user_violence', null)
            ->where('dt.active', 1)
            ->where('dt.id', $id)
           
            ->groupBy(

                'pro.procceding',
                'pro.dateIngress',
                'pro.timeingress',
                'dt.name',
                'dt.lastName',
                'dt.secondName',
                'dt.sex',
                'g.gender',
                'dt.birthdate',
                'dt.age',
                'dt.telephone',
                'dt.email',
                'cv.civil_status',
                'dt.numberdaughters',
                'dt.pregnant',
                'dt.numberchildrens',
                'com.street',
                'com.number',
                'com.colonies_id',
                'com.statebirth',
                'com.zone',
                'act.activity',
                'pf.sourceofincome',
                'wk.workplace',
                'pf.entry_time',
                'pf.departure_time',
                'tr.training',
                'pf.finish',
                'pf.wantofindwork',
                'pf.wanttotrain',
                'pf.wantocontinuestudying',
                'hous.household',
                'vio.lowefecct',
                'vio.narrationfacts',
                'vio.date',
                'adi.addiction',
                'vio.weapons',
                'agresor',
                'dg.name',
                'dg.lastName',
                'dg.secondName',
                'dg.sex',
                'gen.gender',
                'dg.birthdate',
                'dg.age',
                'dg.telephone',
                'comag.street',
                'comag.number',
                'comag.colonies_id',
                'comag.zone',
                'actag.activity',
                'pfag.sourceofincome',
                'wkag.workplace',
                'pfag.entry_time',
                'pfag.departure_time',
                'housag.household',
                'serv.subservice',
                'serv.lineacction',
                'serv.observations',
                's.status',
                'ax.axi',
                'axp.axisprogram',
               
            )
            ->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de servicios del usuario.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getUserData(Request $request, Response $response,int $id){
        $response->data = ObjResponse::DefaultResponse();
        try {

            $list = UserData::from('user_datageneral as dt')
            ->select(
                'pro.id as Folio_id',        
                'pro.procceding as Folio',
                'dt.name as Nombre',
                'dt.lastName as `Apellido Paterno`',
                'dt.secondName as `Apellido Materno`',
                'dt.age as Edad',
                'dt.telephone as Telefono',
                'com.street as `Calle`',
                'com.number as `Numero`',
                'com.colonies_id',
                
               
              
              
             
            )
            ->join('user_proceedings as pro', 'pro.user_datageneral_id', '=', 'dt.id')
            ->join('user_comunities as com', 'com.user_datageneral_id', '=', 'dt.id')
            

            ->where('dt.user_violence', null)
            ->where('dt.active', 1)
            ->where('dt.id', $id)
           
            
            ->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de servicios del usuario.';
            $response->data["result"] = $list;

        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getDataModule2(Request $request, Response $response,int $id){
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserData::where('user_datageneral.id', $id)
            ->select(
                'user_workshops.date',
                'user_workshops.location',
                'user_workshops.agent',
                'user_workshops.colaboration',
                'user_workshops.ponent',
                'user_workshops.issue',
                'user_workshops.axi_id',
                'user_workshops.axi_program_id',
                'user_workshops.observations',
                'user_datageneral.id',
                'user_datageneral.name',
                'user_datageneral.lastName',
                'user_datageneral.secondName',
                'user_datageneral.sex',
                'user_datageneral.telephone',
                'user_datageneral.email',
                'user_datageneral.module',
                'user_comunities.colonies_id',
                'user_comunities.dependece',
            )
            ->join('user_comunities', 'user_comunities.user_datageneral_id', '=', 'user_datageneral.id')
            ->join('user_workshops', 'user_workshops.user_datageneral_id', '=', 'user_datageneral.id')
            // ->join('user_comunities', 'user_comunities.user_datageneral_id', '=', 'user_datageneral.id')
           
            ->orderBy('user_datageneral.id', 'asc')
            ->get();
    
    
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de tipos de usuarios.';
            $response->data["result"] = $list;
    
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getUserAllDataModule2(Request $request, Response $response,int $id){
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserData::where('user_datageneral.id', $id)
            ->select(
                DB::raw("DATE_FORMAT(user_workshops.date, '%d/%m/%Y') as `Fecha`"),
                'user_workshops.location as Lugar',
                'user_workshops.agent as Agente',
                'user_workshops.colaboration as Colaboración',
                'user_workshops.ponent as Ponentes',
                'user_workshops.issue as Temas',
                'ax.axi as Eje',
                'axp.axisprogram as Programa',
                'user_workshops.observations as Observación',
                'user_datageneral.name as Nombre',
                'user_datageneral.lastName as Apellido Paterno',
                'user_datageneral.secondName as Apellido Materno',
                DB::raw("IF(user_datageneral.sex = 0, 'Hombre', 'Mujer') as Sexo"),
                'user_datageneral.telephone as Telefono',
                'user_datageneral.email as Correó',
                'user_comunities.colonies_id',
                'user_comunities.dependece as Dependecia o Institucion',
                DB::raw("GROUP_CONCAT(DISTINCT  file.url) as imagenes"),
            )
            ->join('user_comunities', 'user_comunities.user_datageneral_id', '=', 'user_datageneral.id')
            ->join('user_workshops', 'user_workshops.user_datageneral_id', '=', 'user_datageneral.id')
            ->Join('axis as ax', 'ax.id', '=', 'user_workshops.axi_id')
            ->join('axisprograms as axp', 'axp.id', '=', 'user_workshops.axi_program_id')
            ->join('user_files as file', 'file.user_workshops_id', '=', 'user_workshops.id')
            ->groupBy(
            'user_workshops.date',
            'user_workshops.location',
            'user_workshops.agent',
            'user_workshops.colaboration',
            'user_workshops.ponent',
            'user_workshops.issue',
            'ax.axi',
            'axp.axisprogram',
            'user_workshops.observations',
            'user_datageneral.id',
            'user_datageneral.name',
            'user_datageneral.lastName',
            'user_datageneral.secondName',
            'user_datageneral.sex',
            'user_datageneral.telephone',
            'user_datageneral.email',
            'user_comunities.colonies_id',
            'user_comunities.dependece',
            )
            ->orderBy('user_datageneral.id', 'asc')
            ->get();
    
    
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de tipos de usuarios.';
            $response->data["result"] = $list;
    
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
