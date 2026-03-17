<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Http\Resources\AnnonceResource;
use App\Http\Requests\StoreAnnonceRequest;
use App\Models\Category;

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

    
    public function categories()
{
    return response()->json(Category::select('id', 'name')->get(), 200);
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
        $annonce = Annonce::create([
            ...$request->validated(),
            'user_id' => $request->user()->id
        ]);

        return response()->json([
            'message' => 'Annonce créée avec succès',
            'data' => new AnnonceResource($annonce->load(['category', 'user']))
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $annonce = Annonce::find($id);

        if (!$annonce) {
            return response()->json([
                'message' => 'Annonce non trouvée'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'organisation_name' => 'required|string|max:255',
            'organisation_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|string|max:50',
            'user_id' => 'required|exists:users,id'
        ]);

        $annonce->update($validated);

        return response()->json([
            'message' => 'Annonce mise à jour avec succès',
            'data' => new AnnonceResource($annonce->load(['category', 'user']))
        ], 200);
    }

    public function destroy($id)
    {
        $annonce = Annonce::find($id);

        if (!$annonce) {
            return response()->json([
                'message' => 'Annonce non trouvée'
            ], 404);
        }

        $annonce->delete();

        return response()->json([
            'message' => 'Annonce supprimée avec succès'
        ], 200);
    }
}