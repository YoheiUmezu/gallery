<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Album;
use Image as IntervesionImage;

class ImageController extends Controller
{   
    public function __construct(){
        //$this->middleware('auth', ['only' => ['index', 'addImage']]);//authのままだとだれでもアルバムの編集ができちゃう
        $this->middleware('admin', ['only' => ['index', 'addImage', 'destroy', 'store', 'albumImage']]);//adinユーザーができる操作
    }


    public function index(){
    	return view('home');
    }

    public function album(){
        $albums = Album::with('images')->get();
        return view('welcome',compact('albums'));
    }
    public function show($id){
        $albums = Album::findOrFail($id);
        return view('gallery',compact('albums'));
    }


    public function store(Request $request){
        $this->validate($request,[
            'album'=>'required|min:3|max:50',
            'image'=>'required'
        ]);

    	$album = Album::create(['name'=>$request->get('album')]);
    	if($request->hasFile('image')){
    		foreach($request->file('image') as $image){
    			$path = $image->store('uploads','public');
    			Image::create([
    				'name'=> $path,
    				'album_id'=>$album->id
    			]);
    		}
    	}
        



       return "<div class='alert alert-success'>Album created successfully!</div>";

	}
    public function destroy(){
        $id = request('id');
        //dd($id);//idを拾う
        $image = Image::findOrFail($id);
        $filename = $image->name;//fileの名前をゲットする
        $image->delete();//laravelのメソッド
        \Storage::delete('public/'.$filename);//写真のファイル。上で名前になってる
        return redirect()->back()->with('message', 'Image deleted successfully !');
    }

    public function addImage(Request $request){
        $this->validate($request,[
            'image'=>'required'
        ]);
        $albumId= request('id');
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $path = $image->store('uploads','public');
                Image::create([
                    'name'=> $path,
                    'album_id'=>$albumId
                ]);
            }
        }
        return redirect()->back()->with('message','Images added successfully!');

    }


    public function albumImage(Request $request){
        $this->validate($request,['image'=>'required']);
            $albumId=request('id');
            if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('uploads','public');//imageを格納しておく場所
            Album::where('id',$albumId)->update([
                'image'=> $path,//宣言したpathに名前を入れる
                
            ]);
        }
    
    return redirect()->back()->with('message', 'Album image added successfully !');
        
    }

    public function upload(){
        $albums = Album::get();
        return view('upload', compact('albums'));
    }

    public function postUpload(Request $request){
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            IntervesionImage::make($file)->resize(300,300)->save('avatars/'.$filename);
            Album::create([
                'image'=>filename,
                'name'=>'resizing image']);
                return back();
            
        }
    }
    
}
