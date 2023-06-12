<?php

namespace App\Http\Controllers;

use App\Models\AdministrationTravel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdministrationController extends Controller
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function insertNewTransactionOnAdminPanel(Request $request)
    {
        $user = new User;

        $validatedData = $request->validate([
            'transaction_name' => 'required',
            'passport' => 'required',
            'travel_code' => 'required',
            'user_id' => 'required',
            'covid_data' => 'required',
            'price_values' => 'required',
            'warning_annotation' => 'required',
        ]);

        $administrationTravel = new AdministrationTravel();

        $administrationTravel->transaction_name = $validatedData['transaction_name'];
        $administrationTravel->user_id = $validatedData['user_id'];
        $administrationTravel->passport = $validatedData['passport'];
        $administrationTravel->travel_code = $validatedData['travel_code'];
        $administrationTravel->covid_data = $validatedData['covid_data'];
        $administrationTravel->price_values = $validatedData['price_values'];
        $administrationTravel->warning_annotation = $validatedData['warning_annotation'];

        $findUserById = User::find($administrationTravel->user_id);

        if ($findUserById) {
            $findUserById->administrationTravels()->save($administrationTravel);
        }

        return $administrationTravel;
    }

    public function getValuesByUserId($id)
    {
        $requestIgByGetAllTransaction = AdministrationTravel::where('user_id', $id)->get();
        return response()->json($requestIgByGetAllTransaction);
    }

    public function uploadFile(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'file' => 'required|mimes:jpeg,png,pdf|max:2048',
            'name' => 'required'
        ]);

        $userId = $validatedData['id'];
        $file = $validatedData['file'];
        $userName = $validatedData['name'];

        $directory = storage_path("app\\files_private\\{$userName}_{$userId}");

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        $filename = $file->getClientOriginalName();
        $file->move($directory, $filename);

        DB::table('user_files')->insert([
            'user_id' => $userId,
            'file_path' => "{$directory}\{$filename}",
        ]);

        return response()->json(['file' => "{$directory}\{$filename}"]);
    }



    public function getUserFiles(Request $request)
    {
        $userID = $request->route('id');

        $userFiles = DB::table('user_files')
            ->join('users', 'user_files.user_id', '=', 'users.id')
            ->select('user_files.*', 'users.name as user_name')
            ->where('users.id', $userID)
            ->get();

        $filePayload = [];

        foreach ($userFiles as $file) {
            $filePath = storage_path('app/files_private/' . $file->user_name . '_' . $file->user_id);

            if (File::exists($filePath)) {
                $files = File::allFiles($filePath);
                foreach ($files as $fileInfo) {

                    
                    $fileSize = $fileInfo->getSize();
                    $fileSizeMB = round($fileSize / 1024 / 1024, 2);

                    $filePayload[] = [
                        'file_name' => $fileInfo->getFilename(),
                        'file_size_mb' => $fileSizeMB,
                        'user_name' => $file->user_name,
                    ];
                }
            }
            return response()->json(['file_payload' => $filePayload]);
        }

    }
}
