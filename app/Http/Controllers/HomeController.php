<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class HomeController extends Controller
{
public $status = [
    "available",
    "pending",
    "sold"
];

    public function index()
    {
        return view('welcome')->with('status', $this->status);
    }

    public function findPetByStatus(Request $request)
    {
        $status = $request->input('status');
        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status='.$status);
        if($response->successful() && $response->json() != [])
        {

            return view('petByStatus', ['pet' => $response->json()]);
        }
        else{

            return view('error/notFound');
        }
    }

    public function findPetById(Request $request)
    {
        $id = $request->input('id');


        $response = Http::get('https://petstore.swagger.io/v2/pet/'.$id);
        if($response->successful() && $response->json() != [])
        {

            return redirect()->route('showPet', ['id' => $id]);

        }
        else{
            return view('error/notFound');
        }
    }

    public function createPet(Request $request)
    {
        $petName = $request->input('petName');
        $petCategory = $request->input('petCategory');
        $petStatus = $request->input('status');
        $id = rand(1, 100000);

        $apiData = [
            'id'=>$id,
            'category' => [
                'id' => '0',
                'name' =>$petCategory
            ],
            'name' => $petName,
            'status' => $petStatus
        ];
        $response = Http::post('https://petstore.swagger.io/v2/pet',$apiData);
        return redirect('/id/'.$response->json()['id']);
    }
}
