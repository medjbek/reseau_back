<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Http\Resources\AnnonceResource;
use App\Http\Requests\StoreAnnonceRequest;

class AnnonceController extends Controller
{
    public function index(Request $request)
    {
        $query = Annonce::with(['category', 'user']);

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $annonces = $query->paginate(10);

        return AnnonceResource::collection($annonces);
    }

    public function show($id)
    {
        $annonce = Annonce::with(['category', 'user'])->find($id);

        if (!$annonce) {
            return response()->json([
                'message' => 'Annonce non trouvée'
            ], 404);
        }

        return new AnnonceResource($annonce);
    }

    public function store(StoreAnnonceRequest $request)
    {
        $annonce = Annonce::create($request->validated());

   

        return response()->json([
            'message' => 'Annonce créée avec succès',
            'data' => new AnnonceResource($annonce->load(['category', 'user']))
        ], 201);
    }
}
