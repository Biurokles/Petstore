<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PetByIdController extends Controller
{

    public function show($id, Request $request)
    {
        $status = [
            "available",
            "pending",
            "sold"
        ];
        $response = Http::get('https://petstore.swagger.io/v2/pet/'.$id);
        if($response->successful() && $response->json() != [])
        {
            return view('petById',['pet'=>$response->json()],['status'=>$status]);
        }
        else{
            return view('error/notFound');
        }

    }
    public function updatePet(Request $request)
    {
        $data = $request->all();
        $tags = array_filter($data, function ($key) {
            return preg_match('/^petTag/', $key);
        }, ARRAY_FILTER_USE_KEY);
        foreach ($tags as $key => $value) {
            $delKey = str_replace('petTag', 'petDelTag', $key);
            if (isset($data[$delKey])) {
                unset($tags[$key]);
            }
        }
        $formattedTags = [];
        foreach ($tags as $key => $value) {
            $tag = new \stdClass();
            $tag->id = 0;
            $tag->name = $value;
            $formattedTags[] = $tag;
        }
        if($request->addNewTag=="on" && $request->newTag!=null)
        {
            $tag = new \stdClass();
            $tag->id = 0;
            $tag->name = $request->newTag;
            $formattedTags[] = $tag;
        }

        $photos = array_filter($data, function ($key) {
            return preg_match('/^petPhoto/', $key);
        }, ARRAY_FILTER_USE_KEY);
        foreach ($photos as $key => $value) {
            $delKey = str_replace('petPhoto', 'petDelPhoto', $key);
            if (isset($data[$delKey])) {
                unset($photos[$key]);
            }
        }
        $photoUrls = array_values($photos);
        if($request->addNewPhoto=="on" && $request->newPhoto!=null)
        {
            array_push($photoUrls, $request->newPhoto);
        }


      $apiData = [
            'id' => $request->input('petId'),
            'category' => [
                'id' => '0',
                'name' =>$request->input('petCategory')
            ],
            'name' => $request->input('petName'),
            'photoUrls' => $photoUrls,
            'tags'=>$formattedTags,
            'status' => $request->input('petStatus'),
        ];
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->PUT('https://petstore.swagger.io/v2/pet', $apiData);

        if($response->successful() && $response->json() != [])
        {
            return redirect()->route('showPet', ['id' => $request->input('petId'),]);
        }
        else{
            return view('error/notUpdated');
        }

    }

    public function deletePet($id)
    {
        $response =  Http::DELETE('https://petstore.swagger.io/v2/pet/'.$id);
        if($response->successful())
        {
            return redirect('/');
        }
        else{
            return $response->status();
            return view('error.notDeleted');
        }

    }
}
