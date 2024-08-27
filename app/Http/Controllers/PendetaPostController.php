<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PendetaPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('pendeta.pengumuman.pendeta_pengumuman')->with('posts',$posts)->with('title','Dashboard Pengumuman');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendeta.pengumuman.buat_pengumuman')->with('title','Buat Pengumuman');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            // 'slug'=> 'required|unique:posts',
            'body' => 'required',
            'image' => 'mimes:jpeg,png,gif'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->body),150);
        
        // Account::create($request->all());
 
        // return redirect()->route('admin.akun.index')->with('Berhasil', 'Akun berhasil dibuat');
        $validatedData['user_id'] = Auth::user()->id;
        Post::create($validatedData);
        $this->sendBrowserPushNotification($request);
            // Post::create($request->all());
        return redirect()->route('pendeta.pengumuman.index')->with('success', 'Pengumuman berhasil dibuat');

    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        return view('pendeta.pengumuman.show_pengumuman', ['posts' => Post::where('id',$id)->first()])->with('title','Lihat Pengumuman');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        return view('pendeta.pengumuman.edit_pengumuman', ['posts' => Post::where('id',$id)->first()])->with('title','Edit Pengumuman');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('id',$id)->first();

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            // 'slug'=> 'required|unique:posts',
            'body' => 'required',
            'image' => 'mimes:jpeg,png,gif'
        ]);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // Post::where('id',$id)->update($request->only(['title','body']));
        Post::where('id',$id)->update($validatedData);
 
        return redirect()->route('pendeta.pengumuman.index')->with('success', 'Pengumuman berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        if($post->image){
            Storage::delete($post->image);
        }
        
        $post->delete();
 
        return redirect()->route('pendeta.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }

    public function sendBrowserPushNotification(Request $request)
{
    $url = "https://fcm.googleapis.com/fcm/send";
    $server_key = getenv('FIREBASE_CLOUD_MESSAGING_API_LEGACY');
    $registrationIds = DB::table('webpush_token')
        ->pluck('web_token')
        ->toArray();

    foreach ($registrationIds as $registrationId) {
        $message = [
            "data" => [
                "title" => $request->title,
                // "body" => $request->body,
                "image" => $request->image,
                "click_action" => "https://scbkemahrajawali.site/announcement"
            ],
            "to" => $registrationId
        ];

        $headers = [
            "Authorization: key=".$server_key,
            "Content-Type: application/json"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        $response = curl_exec($ch);

        if ($response === false) {
            echo "Error Sending Message to $registrationId: " . curl_error($ch);
        } else {
            echo "Message sent successfully to $registrationId";
        }

        curl_close($ch);
    }
}

}
