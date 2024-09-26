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

    public function newForm(Request $request){

        $exists = Userdata::where('uid', $request->uid)->exists();
        if($exists){
            $data = Userdata::where('uid', $request->uid)->first();
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

            //image upload
            $filePath = 'uploads/images/' . $uid . '/';
            if (!file_exists(public_path($filePath))) {
                mkdir(public_path($filePath), 0777, true);
            }
            if ($request->hasFile('cniRecto')) {
                $file = $request->file('cniRecto');
                $filename = $uid . '_' .time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->cniRecto = $filePath . $filename;
            }
            if ($request->hasFile('cniVerso')) {
                $file = $request->file('cniVerso');
                $filename = $uid . '_' .time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->cniVerso = $filePath . $filename;
            }
            if ($request->hasFile('cniSupplementaire')) {
                $file = $request->file('cniSupplementaire');
                $filename = $uid . '_' .time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->cniSupplementaire = $filePath . $filename;
            }
            if ($request->hasFile('justifcatifDomicile')) {
                $file = $request->file('justifcatifDomicile');
                $filename = $uid . '_' .time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->justifcatifDomicile = $filePath . $filename;
            }

            if ($request->hasFile('selfie')) {
                $file = $request->file('selfie');
                $filename = $uid . '_' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->selfie = $filePath . $filename;
            }

            $data->save();

        }else{

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
            //image upload
            $filePath = 'uploads/images/' . $uid . '/';
            if (!file_exists(public_path($filePath))) {
                mkdir(public_path($filePath), 0777, true);
            }

            if ($request->hasFile('cniRecto')) {
                $file = $request->file('cniRecto');
                $filename = $uid . '_' .time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->cniRecto = $filePath . $filename;
            }
            if ($request->hasFile('cniVerso')) {
                $file = $request->file('cniVerso');
                $filename = $uid . '_' .time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->cniVerso = $filePath . $filename;
            }
            if ($request->hasFile('cniSupplementaire')) {
                $file = $request->file('cniSupplementaire');
                $filename = $uid . '_' .time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->cniSupplementaire = $filePath . $filename;
            }
            if ($request->hasFile('justifcatifDomicile')) {
                $file = $request->file('justifcatifDomicile');
                $filename = $uid . '_' .time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->justifcatifDomicile = $filePath . $filename;
            }

            if ($request->hasFile('selfie')) {
                $file = $request->file('selfie');
                $filename = $uid . '_' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $data->selfie = $filePath . $filename;
            }

            $data->save();
        }

    }

    public function deleteData($id)
    {
        $data = Userdata::find($id);
        $data->delete();
        return response()->json(['success' => 'Data deleted successfully']);
    }
}
