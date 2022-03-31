<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        return response()->json(Article::orderBy('updated_at', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        // $faker = Faker::class;
        // $imageUrl = $faker->imageUrl();
        $imagePath = '';
        if ($request->hasFile('image')) {
            $imagePath =  $request->file('image')->store('images', ['disk' => 'public']);
        }

        $slug = Str::slug($request->title);
        $article = Article::create([
            'title' => $request->title,
            'slug' => $slug,
            'body' => $request->body,
            'image_url' => $imagePath,
            'user_id' => 1,
        ]);

        return response()->json(['message' => 'successfully create article']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Article::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $article = Article::find($id);

        // return response()->json($request->all());
        if ($request->title) {
            $article->title = $request->title;
            $article->slug = Str::slug($request->title);
        }

        if ($request->body) {
            $article->body = $request->body;
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', ['disk' => 'public']);
            $article->image_url = $imagePath;
        }
        $article->save();

        return response()->json([
            'message' => 'successfully update article'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return response()->json([
            'message' => 'successfully delete article'
        ]);
    }
}
