<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Wpisy;
include ("helpers.php");

class AktualnosciController extends Controller
{
    public function all(Request $request){
        if(is_int($request->input('p'))){
            $p=$request->input('p');
            $pages=ceil(Wpisy::get()->count()/6);
            if($p<=$pages)
                return redirect('/aktualnosci');
        }
        else
            $p=1;
        $start=($p*6)-1-5;
        $query=Wpisy::orderBy('id', 'desc')->skip($start)->take('6')->get();
        foreach($query as $element){
            $element->tresc=Str::replace('<p>', "", $element->tresc);
            $element->tresc=Str::replace('</p>', "", $element->tresc);
            for($i=1;$i<=6;$i++){
                $element->tresc=Str::replace("<h'$i'>"," ",$element->tresc);
                $element->tresc=Str::replace("</h'$i'>"," ",$element->tresc);
            }
            if(Str::length($element->tresc)<=266)
                $element->tresc=$element->tresc;
            else
                $element->tresc=Str::substr($element->tresc, 0, 263)."...";
        }
        $pages=Wpisy::get();
        $pages=ceil($pages->count()/6);
        if($request->input('cat'))
            $url="/aktualnosci?cat=".$request->input('cat')."&p=";
        else
            $url="/aktualnosci"."?p=";
        $buttons=[];
        if($p>1)
            $buttons[]='<a href="'.asset($url.($p-1)).'" class="btn ud btn-outline-link">&lt;&lt;</a>';
        if($p<5){
            for($i=1;$i<=$pages&&$i<=5;$i++)
                $buttons[]=buttonGenerate($p, $i, $url);
        }
        else{
            if($pages<=7)
                for($i=1;$i<=$pages&&$i<=7;$i++)
                    $buttons[]=buttonGenerate($p, $i, $url);
            else{
                $buttons[]='<a href="'.asset($url.'1').'" class="btn ud btn-outline-link">1</a> <div class="btn btn-outline-link no-point">...</div>';
                if($p+2<$pages)
                for($i=$p-2;$i<=$pages&&$i<=$p+2;$i++)
                    $buttons[]=buttonGenerate($p, $i, $url);
                else
                    for($i=$pages-4;$i<=$pages;$i++)
                        $buttons[]=buttonGenerate($p, $i, $url);
            }
        }
        $buttons[]='<div class="btn btn-outline-link no-point">z &nbsp;'.$pages.'</div>';
        if($p<$pages)
            $buttons[]='<a href="'.asset($url.($p+1)).'" class="btn ud btn-outline-link">&gt;&gt;</a>';
        return view('aktualnosci.aktualnosci', ['posts'=>$query, 'buttons'=>$buttons]);
    }
    public function show($id, Request $request){
        $post=Wpisy::where('id', $id)->get();
        if(isset($post[0]->id)){
            $post[0]->data_dodania=Carbon::parse($post[0]->data_dodania)->format('d.m.Y H:i');
            $path = 'img/wpisy/'.$id;
            $files=File::files($path);
            $posts=Wpisy::select('tytul','id')->orderBy('id','desc')->take('6')->get();
            return view('aktualnosci.post', ['post'=>$post, 'files'=>$files,'lastPosts'=>$posts]);
        }
        else
            return redirect('aktualnosci');
    }
    public function addWpis(Request $req){
        $wpis=new Wpisy;
        $wpis->tytul=$req->tytul;
        $wpis->tresc=$req->opis;
        $wpis->save();
        $id=$wpis->id;
        $file = $req->file('imgGlowne');
        $dir_name='public/img/wpisy/'.$id.'/main';
        $file->move(base_path($dir_name), $file->getClientOriginalName());
        $dir_name='img/wpisy/'.$id.'/main/'.$file->getClientOriginalName();
        $wpis->zdjecie=$dir_name;
        $wpis->save();
        $files = $req->file('imgReszta');
        $dir_name='public/img/wpisy/'.$id;
        foreach($files as $file){ 
            $file->move(base_path($dir_name), $file->getClientOriginalName());
        }
        return redirect('adminPanel')->with('success', 'Wpis został <b>pomyślnie</b> dodany!');
    }
    public function panelWpisy(){
        $data=Wpisy::orderBy('id','desc')->get();
        foreach($data as $elem)
            $elem->data_dodania=Carbon::parse($elem->data_dodania)->format('d.m.Y H:i');
        return view('admin.wpisy.panel-wpisy', ['posts'=>$data]);
    }
    public function editWpisy($id, Request $req){
        $data=Wpisy::where('id',$id)->get();
        if(isset($data[0]->id)){
            if($req->input('del')==true){
                $wpis=Wpisy::find($id);
                $wpis->delete();
                File::deleteDirectory(base_path('/public/img/wpisy/'.$id));
                return redirect('adminPanel/panel-wpisy')->with('success', 'Wpis został <b>pomyślnie</b> usunięty!');
            }
            $data[0]->data_dodania=Carbon::parse($data[0]->data_dodania)->format('Y-m-d H:i');
            $path = 'img/wpisy/'.$id;
            $files=File::files($path);
            if($req->input('f')){
                File::delete(base_path('public/'.$req->input('f')));
                return redirect('adminPanel/panel-wpisy/'.$id)->with('success', 'Zdjęcie zostało <b>pomyślnie</b> usunięte!');
            }
            return view('admin.wpisy.edit-wpis', ['post'=>$data, 'files'=>$files]);
        }else
            return redirect('/adminPanel/panel-wpisy');
    }
    public function saveWpisy($id, Request $req){
        if($req->file('imgReszta')){
            $files = $req->file('imgReszta');
            $dir_name='public/img/wpisy/'.$id;
            foreach($files as $file)
                $file->move(base_path($dir_name), $file->getClientOriginalName());
        }
        else{
            $wpis=Wpisy::find($id);
            $wpis->tytul=$req->tytul;
            $wpis->tresc=$req->opis;
            $wpis->data_dodania=$req->data;
            $wpis->save();
            if($req->file('imgGlowne')){
                $data=DB::select("select zdjecie from wpisy where id=$id");
                $dir_name='img/wpisy/'.$id.'/';
                if($req->act_mp==1){
                    $lng=Str::length('img/wpisy/'.$id.'/main/');
                    $fileName=Str::substr($wpis->zdjecie, $lng);
                    File::move(base_path('public/'.$wpis->zdjecie), base_path('public/'.$dir_name.$fileName));
                }
                else
                    File::delete(base_path('public/'.$data[0]->zdjecie));
                $file=$req->file('imgGlowne');
                $file->move(base_path('public/'.$dir_name.'main'), $file->getClientOriginalName());
                $dir_name.="main/".$file->getClientOriginalName();
                $wpis->zdjecie=$dir_name;
                $wpis->save();
            }
        }
        return redirect('adminPanel/panel-wpisy/'.$id)->with('success', 'Zmiant zostały <b>pomyślnie</b> zapisane!');
    }
}