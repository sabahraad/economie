<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;

class adminController extends Controller
{
    public function dashboard(){
        $data = Entreprise::all();
        return view('admin.dashboard',compact('data'));
    }

    public function entrepriseList(Request $request){
        $date = $request->date_range;
        $dateParts = explode(' - ', $date);
        $startDate = $dateParts[0];
        $endDate = $dateParts[1];
        $data = Entreprise::whereDate('entreprises.created_at', '>=', $startDate)
                        ->whereDate('entreprises.created_at', '<=', $endDate)->get();
        if($data->isEmpty()){
            return response()->json([
                'message' => 'No entreprise data found',
                'data' => []
            ],404);
        }

        return response()->json([
            'message' => 'Entreprise data fetched successfully',
            'data' => $data
        ],200);
    }

    public function deleteEntreprise(Request $request){
        $id = $request->id;
        $data = Entreprise::find($id);
        if($data){
            $data->delete();
            return response()->json([
                'message' => 'Entreprise data deleted successfully',
                'data' => $data
            ],200);
        }

        return response()->json([
            'message' => 'No entreprise data found',
            'data' => []
        ],404);
    }
}
