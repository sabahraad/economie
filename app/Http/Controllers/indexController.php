<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\gerant_form;

class indexController extends Controller
{
    public function index()
    {
        return view('index');
    }  

    public function form1(Request $request){
        $data = new Entreprise();
        $data->raisonSociale = $request->raisonSociale;
        $data->formeJuridique = $request->formeJuridique;
        $data->dateCreation = $request->dateCreation;
        $data->effectif = $request->effectif;
        $data->siret = $request->siret;
        $data->adresse = $request->adresse;
        $data->ville = $request->ville;
        $data->codePostal = $request->codePostal;
        $data->uid = $request->uid;
        $data->save();

        return response()->json([
            'message' => 'Entreprise data saved successfully',
            'data' => $data
        ],201);

    }

    public function form2(Request $request){
        $data = new gerant_form();
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
        $data->uid = $request->uid;
        $data->save();

        return response()->json([
            'message' => 'Gerant data saved successfully',
            'data' => $data
        ],201);
    }

    public function form3(Request $request){
        $uid = $request->uid;
        // Save file information to the database
        $data = new gerant_form();
        $data->uid = $uid;

        if ($request->hasFile('cniRecto')) {
            $file = $request->file('cniRecto');
            $filename = $uid . '_' . time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/images/';
            $file->move(public_path($filePath), $filename);
            $data->cniRecto = $filePath . $filename;
        }
        if ($request->hasFile('cniVerso')) {
            $file = $request->file('cniVerso');
            $filename = $uid . '_' . time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/images/';
            $file->move(public_path($filePath), $filename);
            $data->cniVerso = $filePath . $filename;
        }
        if ($request->hasFile('cniSupplementaire')) {
            $file = $request->file('cniSupplementaire');
            $filename = $uid . '_' . time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/images/';
            $file->move(public_path($filePath), $filename);
            $data->cniSupplementaire = $filePath . $filename;
        }
        if ($request->hasFile('justifcatifDomicile')) {
            $file = $request->file('justifcatifDomicile');
            $filename = $uid . '_' . time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/images/';
            $file->move(public_path($filePath), $filename);
            $data->justifcatifDomicile = $filePath . $filename;
        }

        $data->save();

        return response()->json([
            'message' => 'File uploaded successfully',
            'data' => $data
        ],201);

    }
}
