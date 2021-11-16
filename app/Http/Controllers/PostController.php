<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Websites;
use Illuminate\Http\Request;
use League\CommonMark\Normalizer\SlugNormalizer;

// use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller {
    public function index() {
        return Posts::all();
    }
 
    public function show($id) {
        return Posts::find($id);
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'title' => ['required'],
            'website' => ['required']
        ]);

        $website_existed = Websites::where(['id' => $request->website])->first();
        
        if(!$website_existed) {
            return response()->json(
                [
                'errors' => [
                    'message' => ["Website does not exist"],
                    ]
                ], 403
            );
        }

        $request->website_id = $request->website;
        // unset($request->website);

        return Posts::create([
            // 'slug' => SlugNormalizer::createSlug(Posts::class, 'slug', $request->title),
            'title' => $request->title,
            'website_id' => $request->website,
            'title' => $request->title,
            'description' => $request->description
        ]);
    }

    public function update(Request $request, $id) {
        $credentials = $request->validate([
            'name' => ['required'],
        ]);

        $posts = Posts::findOrFail($id);
        $posts->update($request->all());

        return $posts;
    }

    public function delete(Request $request, $id)
    {
        $posts = Posts::findOrFail($id);
        $posts->delete();

        return 204;
    }
}
