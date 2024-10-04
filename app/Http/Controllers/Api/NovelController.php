<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Novel;

class NovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    return Novel::all();
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

    return Novel::create($request->all());
}

    /**
     * Display the specified resource.
     */
    public function show(Novel $novel)
    {
        return $novel;
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
    return $novel;
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel)
{
    $novel->delete();
    return response()->noContent();
}
}
