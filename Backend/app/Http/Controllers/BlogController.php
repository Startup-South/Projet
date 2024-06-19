<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index()
    {
        return response()->json(Blog::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'BlogTitle' => 'required|string|max:75',
            'BlogDescription' => 'required',
            'BlogAuthor' => 'required|string|max:60',
            'BlogVisibility' => 'required|boolean',
            'BlogDate' => 'required|date',
            'BlogImg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        Log::info('Request Data:', $request->all());// Validation et création du blog...


        $validatedData = $validator->validated();

        if ($request->hasFile('BlogImg') && $request->file('BlogImg')->isValid()) {
            $path = $request->file('BlogImg')->store('blog_images', 'public');
            $validatedData['BlogImg'] = $path;
        }

        $blog = Blog::create($validatedData);

        return response()->json($blog, 201);
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        return response()->json($blog, 200);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'BlogTitle' => 'required|string|max:75',
            'BlogDescription' => 'required',
            'BlogAuthor' => 'required|string|max:60',
            'BlogVisibility' => 'required|boolean',
            'BlogDate' => 'required|date',
            'BlogImg' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('BlogImg') && $request->file('BlogImg')->isValid()) {
            $path = $request->file('BlogImg')->store('blog_images', 'public');
            $validatedData['BlogImg'] = $path;
        }

        $blog->update($validatedData);

        return response()->json($blog, 200);
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->delete();

            return response()->json(['message' => 'Blog deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete blog: ' . $e->getMessage()], 500);
        }
    }
}
