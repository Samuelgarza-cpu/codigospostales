<?php
namespace App\Http\Controllers\imm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\imm\UserFiles;
use App\Models\imm\UserWorkshops;

use App\Models\ObjResponse;
use Illuminate\Http\Response;

class UserFilesImmController extends Controller
{
    public function create(Request $request, Response $response)
{
    $response->data = ObjResponse::DefaultResponse();
    try {
        $data = $request->all();
        $nombresArchivos = [];
    $idFiles = UserWorkshops::where("user_datageneral_id", $request->id)->first(); 
         UserFiles::where("user_workshops_id",$idFiles->id)->delete();

        $folderPath = public_path("IMM/{$idFiles->id}");
        if (is_dir($folderPath)) {
            deleteDirectory($folderPath);   
        }            
            foreach ($data as $key => $value) {
            $serverPort = $_SERVER['SERVER_PORT'];
            $isHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
            $scheme = $isHttps ? 'https' : 'http';
            $serverName = $_SERVER['SERVER_NAME'];
            $url = "{$scheme}://{$serverName}" . (($scheme === 'http' && $serverPort != '80') || ($scheme === 'https' && $serverPort != '443') ? ":{$serverPort}" : "");
            if ($request->hasFile($key) && $request->file($key)->isValid()) {
                $archivo = $request->file($key);
                $nombreArchivo = $archivo->getClientOriginalName();
                $nuevoNombreArchivo = date('Y-m-d_H-i-s') . '_' . $nombreArchivo;
                $archivo->move(public_path("IMM/{$idFiles->id}/"),$nuevoNombreArchivo);
                UserFiles::create([
                    'user_workshops_id' => $idFiles->id,
                    'url'=> "https://api.gomezpalacio.gob.mx"."/IMM/".$idFiles->id."/".$nuevoNombreArchivo,
                ]);

                $nombresArchivos[] = $nombreArchivo;

                // Puedes guardar la información de cada archivo en la base de datos si es necesario.
            }
        }

        if (count($nombresArchivos) > 0) {
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Archivos subidos exitosamente: ' . implode(', ', $nombresArchivos);
            $response->data["alert_text"] = "Archivos subidos";
        } else {
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'No se han seleccionado archivos.';
            $response->data["alert_text"] = "No se seleccionaron archivos";
        }

    } catch (\Exception $ex) {
        $response->data = ObjResponse::CatchResponse($ex->getMessage());
    }

    return response()->json($response, $response->data["status_code"]);
}
public function index(Response $response,int $id)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserFiles::where('user_files.user_workshops_id', $id)
            ->select('user_files.url'
            )
            ->orderBy('user_files.id', 'asc')
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
}
 function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}
