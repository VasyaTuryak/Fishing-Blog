<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post=DB::table('posts')->paginate(3);
//        $post=Post::paginate(2);
        return $post;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'method POST';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'method POST';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
