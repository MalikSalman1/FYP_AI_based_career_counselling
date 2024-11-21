<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LivestreamsModel as Livestream;
use App\Models\User;

class LivestreamController extends Controller
{
    public function streampage(){
        return view('livestream.streampage');
    }
    public function create_livestream(Request $request){
        // formData object
        $formData = $request->all();
       
        // save the image
        $image = $formData['image'];
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('livestream_images/'), $imageName);
        
        // save the live stream
        $livestream = new Livestream;
        $livestream->title = $formData['room'];
        $livestream->description = $formData['description'];
        $livestream->image = $imageName;
        // mentor_id
        $livestream->mentor_id = $formData['mentor_id'];
        $livestream->stream_key = $formData['stream_key'];
        $livestream->save();

        return response()->json(['success'=>'You have successfully created a live stream.', 'data'=>$formData]);
        
        
    }
    public function get_livestreams(){
        $streams = Livestream::all();
        // include image path of mentor
        foreach($streams as $stream){
            $mentor = User::find($stream->mentor_id);
            $stream->mentor_image = $mentor->image;
            $stream->mentor_name = $mentor->name;
        }
        //return view
        return view('Parent.liststreams', compact('streams'));
    }
    public function stream($streamkey){
        $livestream = Livestream::where('stream_key', $streamkey)->first();
        if(!$livestream){
            // return default 404 page
            return view('errors.404');
        }
        return view('livestream.stream', compact('livestream'));
    }
    public function delete_livestream($id){
        $livestream = Livestream::find($id);
        if(!$livestream){
            // return default 404 page
            return view('errors.404');
        }
        $livestream->delete();
        //redirect to /
        return redirect('/');
        
    }
    
}
