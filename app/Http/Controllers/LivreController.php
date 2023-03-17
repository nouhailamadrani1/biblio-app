<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateLivreRequest;
use App\Http\Requests\StoreLivreRequest;
use App\Models\Livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        $livres = Livre::orderBy('id')->get();

        return response()->json([
            'status' => 'success',
            'articles' => $livres
        ],201);
    }

    public function store(StoreLivreRequest $request)
    {
        $livre = Livre::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Livre Created successfully!",
            'livre' => $livre
        ], 201);
    }

    
    public function show(Livre $livre)
    {
        $livre->find($livre->id);
        if (!$livre) {
            return response()->json(['message' => 'Livre not found'], 404);
        }
        return response()->json($livre, 200);
    }

    
    public function update(UpdateLivreRequest $request, Livre $livre)
    {
        $livre->update($request->all());

        if (!$livre) {
            return response()->json(['message' => 'Livre not found'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "Livre Updated successfully!",
            'livre' => $livre
        ], 200);
    }

    
    public function destroy(Livre $livre)
    {
        
        $livre->delete();

        if (!$livre) {
            return response()->json([
                'message' => 'Livre not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Livre deleted successfully'
        ], 200);
    }
}