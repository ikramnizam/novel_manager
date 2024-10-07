<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Novel;

class NovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Novel::query();

        // Cek kalau ada search query
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where('title', 'like', "%{$searchTerm}%")
                ->orWhere('author', 'like', "%{$searchTerm}%");
        }

        // Check if there's a sort query
        if ($request->has('sort')) {
            $sortBy = $request->input('sort');
            $direction = $request->input('direction', 'asc'); // Default to ascending
            $query->orderBy($sortBy, $direction);
        } else {
            // Default sorting
            $query->orderBy('published_at', 'desc'); // Default sort by latest published
        }

        // pagination 3 novel per page
        $novels = $query->paginate(3);

        return view('novels.index', compact('novels'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('novels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'synopsis' => 'required',
        ]);

        Novel::create($request->all());
        return redirect()->route('novels.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Novel $novel)
    {
        // dd($novel);
        return view('novels.show', compact('novel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Novel $novel)
    {
        return view('novels.edit', compact('novel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Novel $novel)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'synopsis' => 'required',
        ]);

        $novel->update($request->all());
        return redirect()->route('novels.index')->with('success', 'Novel updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel)
    {
        $novel->delete();
        return redirect()->route('novels.index');
    }
}
