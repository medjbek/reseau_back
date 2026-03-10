<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annonce;

class AnnonceController extends Controller
{

    public function index()
    {
        $annonces = Annonce::with(['category','user'])->get();

        return response()->json($annonces);
    }

    public function show($id)
    {
        $annonce = Annonce::with(['category','user'])->find($id);

        if (!$annonce) {
            return response()->json([
                'message' => 'Annonce non trouvée'
            ], 404);
        }

        return response()->json($annonce);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'organisation_name' => 'required|string|max:255',
            'organisation_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'user_id' => 'required|exists:users,id'
        ]);

        $annonce = Annonce::create($validated);

        return response()->json([
            'message' => 'Annonce créée avec succès',
            'data' => $annonce
        ], 201);
    }

}
