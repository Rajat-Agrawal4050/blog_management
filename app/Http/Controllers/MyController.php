<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use DOMDocument;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    //

    public function processLogin(Request $req)
    {

        $admin = User::where('email', $req->email)->where('role', 'admin')->first();

        if ($admin) {
            $token = auth()->attempt(['email' => $req->email, 'password' => $req->password]);

            if (!$token) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials.',
                ], 401);
            }

           // setcookie('jwt_token', $token, time() + 3600, '/');
             $cookie = cookie(
        'jwt_token',   // name
        $token,        // value
        60,            // minutes (1 ghanta)
        '/',           // path
        null,          // domain
        true,          // secure - HTTPS only
        true,          // httpOnly - JS access nahi
        false,         // raw
        'strict'       // sameSite
    );

            return response()->json([
                'status' => true,
                'token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => Auth::factory()->getTTL() * 60,
                'user'         => Auth::user(),
                'message' => 'Successfully Logged in.'
            ], 200)->withCookie($cookie);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email.',
            ], 404);
        }
    }

    public function getBlogs(Request $req)
    {

        $all_posts = Post::with('category')->latest()->get();
        return $all_posts;
    }

    public function deletePost(Request $request)
    {

        $post = Post::where('id', $request->id)->first();
        if ($post == null) {
            return -2;
        }

        Post::where('id', $request->id)->delete();
        return 1;
    }

    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required|min:3|max:255',
            'category' => 'required',
            'short_description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/'), $imageName);
        }

        // upload content images
        $content = $request->content;
        $dom = new DOMDocument();

        libxml_use_internal_errors(true);

        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            $base_64 = $img->getAttribute('src');
            $extension = explode('/', explode(':', substr($base_64, 0, strpos($base_64, ';')))[1])[1];

            $replace = substr($base_64, 0, strpos($base_64, ',') + 1);
            $only_base64 = str_replace($replace, '', $base_64);
            $only_base64 = str_replace(' ', '+', $only_base64);

            $image_name = Str::random(10) . '.' . $extension;
            $path = public_path() . '/uploads/' . $image_name;

            file_put_contents($path, base64_decode($only_base64));
            $img->removeAttribute('src');
            $img->setAttribute('src', '/uploads/' . $image_name);
        }

        $desc = $dom->saveHTML();

        Post::create([
            'title' => $request->title,
            'category' => $request->category,
            'short_description' => $request->short_description,
            'image' => $imageName,
            'content' => $desc,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Blog created successfully'
        ]);
    }

    public function edit(Request $request)
    {

        $request->validate([

            'title' => 'required|min:3|max:255',
            'category' => 'required',
            'short_description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required',
        ]);

        $imageName = null;

        // dd($request->all());

        $post = Post::findOrFail($request->blog_id);

        if ($request->hasFile('image')) {

            if ($post->image && file_exists(public_path('uploads/' . $post->image))) {

                unlink(public_path('uploads/' . $post->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/'), $imageName);
        }

        // upload content images
        $content = $request->content;
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);

        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            $base_64 = $img->getAttribute('src');

            if (preg_match('/^data:image\/(\w+);base64,/', $base_64)) {
                $extension = explode('/', explode(':', substr($base_64, 0, strpos($base_64, ';')))[1])[1];

                $replace = substr($base_64, 0, strpos($base_64, ',') + 1);
                $only_base64 = str_replace($replace, '', $base_64);
                $only_base64 = str_replace(' ', '+', $only_base64);

                $image_name = Str::random(10) . '.' . $extension;
                $path = public_path() . '/uploads/' . $image_name;

                file_put_contents($path, base64_decode($only_base64));
                $img->removeAttribute('src');
                $img->setAttribute('src', '/uploads/' . $image_name);
            }
        }

        $desc = $dom->saveHTML();

        $post->title = $request->title;
        $post->category = $request->category;
        $post->short_description = $request->short_description;
        $post->content = $desc;
        if ($imageName != null) {
            $post->image = $imageName;
        }

        $post->save();

        return response()->json([
            'status' => true,
            'message' => 'Blog Edited successfully'
        ]);
    }
}
