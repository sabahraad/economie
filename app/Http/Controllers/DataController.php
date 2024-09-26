<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\gerant_form;
use App\Models\SelfiUpload;
use App\Models\UploadFile;
use App\Models\User;
use App\Models\Userdata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\React;
use ZipArchive;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        // Fetch all unique UIDs
        $uids = Userdata::pluck('uid');

        $data = [];

        // Iterate over each UID and check if data exists in respective tables
        foreach ($uids as $uid) {
            $entreprise = Userdata::where('uid', $uid)->first();
            // Count the number of uploaded files
            $filesCount = 0;
            if ($entreprise->cniRecto) $filesCount++;
            if ($entreprise->cniVerso) $filesCount++;
            if ($entreprise->cniSupplementaire) $filesCount++;
            if ($entreprise->justifcatifDomicile) $filesCount++;
            if ($entreprise->selfie) $filesCount++;

            // Determine statuses
            $entrepriseStatus = $entreprise->raisonSociale ? 'Complete' : 'Incomplete';
            $gerantStatus = $entreprise->nom ? 'Complete' : 'Incomplete';
            $uploadStatus = $entreprise->cniRecto ? 'Complete' : 'Incomplete';
            $selfieStatus = $entreprise->selfie ? 'Complete' : 'Incomplete';

            // Count complete statuses
            $completeCount = 0;
            if ($entrepriseStatus === 'Complete') $completeCount++;
            if ($gerantStatus === 'Complete') $completeCount++;
            if ($uploadStatus === 'Complete') $completeCount++;
            if ($selfieStatus === 'Complete') $completeCount++;

            // Calculate percentage
            $percentage = ($completeCount / 4) * 100; // 4 fields to check

            $data[] = [
                'id' => $entreprise->id,
                'uid' => $uid,
                'email' => $entreprise->mail,
                'entreprise_status' => $entrepriseStatus,
                'gerant_status' => $gerantStatus,
                'upload_status' => $uploadStatus,
                'selfie_status' => $selfieStatus,
                'created_at' => $entreprise->created_at,
                'files_count' => $filesCount, // Add the files count field
                'percentage' => $percentage, // Add the percentage field
            ];
        }

        return view('admin.data_table', ['data' => $data]);
    }

    public function downloadSelected(Request $request)
    {
        $selectedUids = $request->input('uids');

        if (empty($selectedUids)) {
            return back()->with('error', 'No rows selected');
        }

        // Prepare a zip file for download
        $zip = new ZipArchive();
        $zipFileName = 'userdata_files_' . time() . '.zip';
        $zipPath = public_path($zipFileName);

        if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
            return back()->with('error', 'Unable to create zip file');
        }

        foreach ($selectedUids as $uid) {
            // Retrieve userdata for the UID
            $userdata = Userdata::where('uid', $uid)->first();
            if ($userdata) {
                // Check for completeness
                $isComplete = $userdata->raisonSociale && $userdata->nom && 
                              $userdata->cniRecto && $userdata->selfie;

                // Create folder name based on completeness
                $completionStatus = $isComplete ? 'Complete' : 'Incomplete';
                $folderName = "{$userdata->uid}_{$completionStatus}/"; // Folder name

                // Create a folder for each UID inside the zip
                $zip->addEmptyDir($folderName);

                // Save userdata to a text file
                $userdataFilePath = "{$folderName}userdata.txt";
                $zip->addFromString($userdataFilePath, json_encode($userdata->toArray(), JSON_PRETTY_PRINT));

                // Handle image uploads
                $imageFields = [
                    'cniRecto',
                    'cniVerso',
                    'cniSupplementaire',
                    'justifcatifDomicile',
                    'selfie'
                ];

                foreach ($imageFields as $imageField) {
                    $imagePath = $userdata->$imageField; // Get the image path from userdata
                    if ($imagePath && File::exists(public_path($imagePath))) {
                        $fileName = "{$folderName}{$imageField}.jpg"; // Save in folder
                        $zip->addFile(public_path($imagePath), $fileName);
                    }
                }
            }
        }

        // Close the zip file
        $zip->close();

        // Download the zip file and delete after sending
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function downloadALL(Request $request)
    {
        // Retrieve all userdata records
        $userdatas = Userdata::all();

        if ($userdatas->isEmpty()) {
            return back()->with('error', 'No user data available');
        }

        // Prepare a zip file for download
        $zip = new ZipArchive();
        $zipFileName = 'userdata_files_' . time() . '.zip';
        $zipPath = public_path($zipFileName);

        if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
            return back()->with('error', 'Unable to create zip file');
        }

        foreach ($userdatas as $userdata) {
            // Check for completeness
            $isComplete = $userdata->raisonSociale && $userdata->nom && 
                          $userdata->cniRecto && $userdata->selfie;

            // Create folder name based on completeness
            $completionStatus = $isComplete ? 'Complete' : 'Incomplete';
            $folderName = "{$userdata->uid}_{$completionStatus}/"; // Folder name

            // Create a folder for each user inside the zip
            $zip->addEmptyDir($folderName);

            // Save userdata to a text file
            $userdataFilePath = "{$folderName}userdata.txt";
            $zip->addFromString($userdataFilePath, json_encode($userdata->toArray(), JSON_PRETTY_PRINT));

            // Handle image uploads
            $imageFields = [
                'cniRecto',
                'cniVerso',
                'cniSupplementaire',
                'justifcatifDomicile',
                'selfie'
            ];

            foreach ($imageFields as $imageField) {
                $imagePath = $userdata->$imageField; // Get the image path from userdata
                if ($imagePath && File::exists(public_path($imagePath))) {
                    $fileName = "{$folderName}{$imageField}.jpg"; // Save in folder
                    $zip->addFile(public_path($imagePath), $fileName);
                }
            }
        }

        // Close the zip file
        $zip->close();

        // Download the zip file and delete after sending
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function details($id)
    {
        $data = Userdata::where('uid', $id)->first();
        
        return view('admin.details',compact('data'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function deleteData($id)
    {
        $data = Userdata::find($id);
        $data->delete();
        return response()->json(['success' => 'Data deleted successfully']);
    }

}
