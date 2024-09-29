<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdata;

class indexController extends Controller
{
    public function index()
    {
        // Check if the cookie is already set
        if(!isset($_COOKIE['random_number'])) {
            // Generate a random number only if the cookie doesn't exist
            $min = 10000;
            $max = 99999;
            $randomNumber = rand($min, $max);

            // Set the random number in a cookie (expires in 5 years)
            $cookieName = 'random_number';
            $cookieValue = $randomNumber;
            $cookieExpire = time() + (5 * 365 * 24 * 60 * 60); // 5 years from now

            // Set the cookie
            setcookie($cookieName, $cookieValue, $cookieExpire, "/"); // "/" means cookie is available in the entire domain
        } else {
            // If the cookie exists, use the existing value
            $randomNumber = $_COOKIE['random_number'];
        }
        return view('index');
    }  

    public function newForm(Request $request)
    {
        $exists = Userdata::where('uid', $request->uid)->exists();
        
        if($exists) {
            $data = Userdata::where('uid', $request->uid)->first();
            // Update existing fields
            $data->raisonSociale = $request->raisonSociale ?? $data->raisonSociale;
            $data->formeJuridique = $request->formeJuridique ?? $data->formeJuridique;
            $data->dateCreation = $request->dateCreation ?? $data->dateCreation;
            $data->effectif = $request->effectif ?? $data->effectif;
            $data->siret = $request->siret ?? $data->siret;
            $data->adresse = $request->adresse ?? $data->adresse;
            $data->ville = $request->ville ?? $data->ville;
            $data->codePostal = $request->codePostal ?? $data->codePostal;
            $data->genre = $request->genre ?? $data->genre;
            $data->prenom = $request->prenom ?? $data->prenom;
            $data->nom = $request->nom ?? $data->nom;
            $data->paysNaissance = $request->paysNaissance ?? $data->paysNaissance;
            $data->villeNaissance = $request->villeNaissance ?? $data->villeNaissance;
            $data->codePostalNaissance = $request->codePostalNaissance ?? $data->codePostalNaissance;
            $data->dateNaissance = $request->dateNaissance ?? $data->dateNaissance;
            $data->nationaliteNaissance = $request->nationaliteNaissance ?? $data->nationaliteNaissance;
            $data->phone = $request->phone ?? $data->phone;
            $data->mail = $request->mail ?? $data->mail;

            $uid = $data->uid;

            // Handle file upload for multiple fields
            $filePath = 'uploads/files/' . $uid . '/';
            if (!file_exists(public_path($filePath))) {
                mkdir(public_path($filePath), 0777, true);
            }

            // Function to save image or pdf
            $this->saveFile($request, 'cniRecto', $data, $filePath);
            $this->saveFile($request, 'cniVerso', $data, $filePath);
            $this->saveFile($request, 'cniSupplementaire', $data, $filePath);
            $this->saveFile($request, 'justifcatifDomicile', $data, $filePath);
            $this->saveFile($request, 'selfie', $data, $filePath);

            $data->save();

        } else {
            $data = new Userdata();
            $data->uid = $request->uid;
            $data->raisonSociale = $request->raisonSociale;
            $data->formeJuridique = $request->formeJuridique;
            $data->dateCreation = $request->dateCreation;
            $data->effectif = $request->effectif;
            $data->siret = $request->siret;
            $data->adresse = $request->adresse;
            $data->ville = $request->ville;
            $data->codePostal = $request->codePostal;
            $data->genre = $request->genre;
            $data->prenom = $request->prenom;
            $data->nom = $request->nom;
            $data->paysNaissance = $request->paysNaissance;
            $data->villeNaissance = $request->villeNaissance;
            $data->codePostalNaissance = $request->codePostalNaissance;
            $data->dateNaissance = $request->dateNaissance;
            $data->nationaliteNaissance = $request->nationaliteNaissance;
            $data->phone = $request->phone;
            $data->mail = $request->mail;

            $uid = $data->uid;

            // Handle file upload for multiple fields
            $filePath = 'uploads/files/' . $uid . '/';
            if (!file_exists(public_path($filePath))) {
                mkdir(public_path($filePath), 0777, true);
            }

            // Function to save image or pdf
            $this->saveFile($request, 'cniRecto', $data, $filePath);
            $this->saveFile($request, 'cniVerso', $data, $filePath);
            $this->saveFile($request, 'cniSupplementaire', $data, $filePath);
            $this->saveFile($request, 'justifcatifDomicile', $data, $filePath);
            $this->saveFile($request, 'selfie', $data, $filePath);

            $data->save();
        }
    }

    // Function to handle file uploads (Image or PDF)
    private function saveFile($request, $fieldName, $data, $filePath)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $mimeType = $file->getMimeType();
            
            // Define allowed MIME types for image and pdf
            $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $allowedPdfTypes = ['application/pdf'];

            if (in_array($mimeType, $allowedImageTypes)) {
                $fileType = 'image';
            } elseif (in_array($mimeType, $allowedPdfTypes)) {
                $fileType = 'pdf';
            } else {
                return; // Invalid file type, skip
            }

            // Build filename with time and original name
            $filename = $data->uid . '_' . time() . '_' . $file->getClientOriginalName();
            
            // Move the file to the public path
            $file->move(public_path($filePath), $filename);
            
            // Set the file path for the respective field
            $data->{$fieldName} = $filePath . $filename;
        }
    }

    public function deleteData($id)
    {
        $data = Userdata::find($id);
        $data->delete();
        return response()->json(['success' => 'Data deleted successfully']);
    }
}
