<?php

namespace App\Http\Controllers;

use App\Models\Anunci;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnunciController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anunci = Anunci::with('category')->get();
        $category = Category::all();

        return Inertia::render('Anunci',[
        'anuncis' => $anunci,
        'category' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return Inertia::render('AddAnunci', [
            "categories" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "title" => "required|max:255",
            "description" => "required|max:255",
            "date" => "required|max:255",
            "hour" => "required|max:255",
            "email" => "required|max:255",
            "category_id" => "required|max:255",
        ]);

        Anunci::create($validate);
        return redirect()->route('anuncis.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anunci $anunci)
    {
        return Inertia::render('ShowAnunci',[
            'anuncis' => $anunci->load('category'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anunci $anunci)
    {
        $categories = Category::all();

        return Inertia::render('UpdateAnunci', ['anunci' => $anunci, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anunci $anunci)
    {
        $validate = $request->validate([
            "title" => "required|max:255",
            "description" => "required|max:255",
            "date" => "required|max:255",
            "hour" => "required|max:255",
            "email" => "required|max:255",
            "category_id" => "required|max:255",
        ]);

        $anunci->update($validate);
        return redirect()->route('anuncis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anunci $anunci)
    {
        $anunci->delete();

        return redirect()->route("anuncis.index");
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->query('category');
        
        $anuncis = Anunci::with('category')
            ->whereHas('category', function($query) use ($category) {
                $query->where('name', $category);
            })
            ->get();
            
        return response()->json($anuncis);
    }

    /*public function getTrendingCategories()
    {
        $categories = Category::get() //Get the categories except one with id
            ->map(function($category) { //Map the categories
                return [
                    'id' => $category->id, //Get the id of the category
                    'name' => $category->name, //Get the name of the category
                ];
            });
        return response()->json($categories); //Return the categories
    }*/
}
