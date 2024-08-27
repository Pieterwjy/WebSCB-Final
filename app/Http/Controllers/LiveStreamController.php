<?php

namespace App\Http\Controllers;

use App\Models\LiveStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class LiveStreamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liveStreams = LiveStream::all();
        return view('multimedia.livestream.multimedia_livestream')->with('livestreams', $liveStreams)->with('title','Livestream');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('multimedia.livestream.buat_livestream')->with('title','Buat Jadwal Siaran');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validate = [
        //     'title' => 'required',
        //      'scheduled_at' => 'required|date',
        //      'scheduled_end' => 'required|date|after:scheduled_at',
        //       'youtube_embed_url' => 'required'
        // ];
        // $message = ['scheduled_end.after' => 'Waktu berakhir yang dijadwalkan harus setelah waktu mulai yang dijadwalkan.'];
        // $validated = $request->validate($validate,$message);




        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'scheduled_at' => 'required|date',
            'scheduled_end' => 'required|date|after:scheduled_at',
             'youtube_embed_url' => 'required'
        ]);
        
        $validator->after(function ($validator) use ($request) {
            $validator->getData()['user_id'] = Auth::user()->id;
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $request->merge(['user_id' => Auth::user()->id]);
        LiveStream::create($request->only(['title','scheduled_at','scheduled_end','youtube_embed_url','user_id']));
        $this->sendBrowserPushNotification($request);
        return redirect()->route('multimedia.livestream.index')->with('success', 'Jadwal siaran berhasil dibuat.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $now = now();
        $liveStream = LiveStream::where('scheduled_at', '<=', $now)
            ->where('scheduled_end', '>', $now)
            ->first();

    if ($liveStream) {
        // Siaran Ibadah sudah dimulai, arahkan ke halaman "Siaran Ibadah"
        return view('multimedia.livestream.show_livestream', ['livestreams' => LiveStream::where('id',$liveStream->id)->first()])->with('title','Lihat Siaran Ibadah');
    }
    $scheduledLiveStream = LiveStream::orderBy('scheduled_at')->where('status','scheduled')->first();
    if($scheduledLiveStream){
         //   Jadwal Ibadah masih belum terpenuhi, tampilkan halaman "Jadwal Ibadah"
        
        return view('multimedia.livestream.jadwal_livestream', ['livestreams' => LiveStream::where('id',$scheduledLiveStream->id)->first()])->with('title','Jadwal Siaran Ibadah'); 
         
    }
    return view('multimedia.livestream.jadwal_livestream', ['livestreams' => LiveStream::where('id','none')->first()])->with('title','Jadwal Siaran Ibadah');
    }

    public function showGuest()
    {
        $now = now();
        $liveStream = LiveStream::where('scheduled_at', '<=', $now)
            ->where('scheduled_end', '>', $now)
            ->first();

    if ($liveStream) {
        // Siaran Ibadah sudah dimulai, arahkan ke halaman "Siaran Ibadah"
        return view('main.live.show_livestream', ['livestreams' => LiveStream::where('id',$liveStream->id)->first()])->with('title','Lihat Siaran Ibadah');
    }
    $scheduledLiveStream = LiveStream::orderBy('scheduled_at')->where('status','scheduled')->first();
    if($scheduledLiveStream){
         //   Jadwal Ibadah masih belum terpenuhi, tampilkan halaman "Jadwal Ibadah"
        
        return view('main.live.jadwal_livestream', ['livestreams' => LiveStream::where('id',$scheduledLiveStream->id)->first()])->with('title','Jadwal Siaran Ibadah'); 
         
    }
    return view('main.live.jadwal_livestream', ['livestreams' => LiveStream::where('id','none')->first()])->with('title','Jadwal Siaran Ibadah');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        return view('multimedia.livestream.edit_livestream', ['livestreams' => LiveStream::where('id',$id)->first()])->with('title','Edit Livestream');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $livestream = LiveStream::where('id',$id)->first();

        // $validate = [
        //     'title' => 'required',
        //      'scheduled_at' => 'required|date',
        //      'scheduled_end' => 'required|date|after:scheduled_at',
        //       'youtube_embed_url' => 'required'
        // ];
        // $message = ['scheduled_end.after' => 'Waktu berakhir yang dijadwalkan harus setelah waktu mulai yang dijadwalkan.'];
        // $validated = $request->validate($validate,$message);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'scheduled_at' => 'required|date',
            'scheduled_end' => 'required|date|after:scheduled_at',
             'youtube_embed_url' => 'required',
             'status' => 'required'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        LiveStream::where('id',$id)->update($request->only(['title','scheduled_at','scheduled_end','youtube_embed_url','status'])); //->only(['name','email','phone','role'])
 
        return redirect()->route('multimedia.livestream.index')->with('success', 'Jadwal siaran berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $livestream = Livestream::findOrFail($id);
        
        $livestream->delete();
 
        // return redirect()->route('product.index')->with('success', 'product deleted successfully');
        return redirect()->route('multimedia.livestream.index')->with('success', 'Jadwal siaran berhasil dihapus');
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
                    "body" => "Ibadah akan dimulai pada ". $request->scheduled_at,
                    // "image" => $request->image,
                    "click_action" => "https://scbkemahrajawali.site/live"
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
