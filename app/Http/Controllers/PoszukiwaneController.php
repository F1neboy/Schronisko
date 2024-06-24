<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Poszukiwane;
include ("helpers.php");

class PoszukiwaneController extends Controller
{
    public function all(Request $request){
        if(is_int($request->input('p'))){
            $p=$request->input('p');
            $pages=ceil(Poszukiwane::get()->count()/6);
            if($p<=$pages)
                return redirect('/poszukiwane');
        }
        else
            $p=1;
        $start=($p*6)-1-5;
        if(!$request->input('cat'))
            $query=Poszukiwane::select('poszukiwane.id', 'data', 'opis', 'zdjecie', 'rodzaj', 'stan', 'typ')
            ->join('poszukiwane_rodzaj','poszukiwane.id_rodzaj','=','poszukiwane_rodzaj.id')
            ->join('poszukiwane_stan','poszukiwane.id_stan','=','poszukiwane_stan.id')
            ->join('poszukiwane_typ_ogl','poszukiwane.id_typ','=','poszukiwane_typ_ogl.id')
            ->where('id_stan', 2)->orderBy('poszukiwane.id','desc')->skip($start)->take('6')->get();
        else{
            $cat=$request->input('cat');
            if($cat=='znal')
                $query=Poszukiwane::select('poszukiwane.id', 'data', 'opis', 'zdjecie', 'rodzaj', 'stan', 'typ')
                ->join('poszukiwane_rodzaj','poszukiwane.id_rodzaj','=','poszukiwane_rodzaj.id')
                ->join('poszukiwane_stan','poszukiwane.id_stan','=','poszukiwane_stan.id')
                ->join('poszukiwane_typ_ogl','poszukiwane.id_typ','=','poszukiwane_typ_ogl.id')
                ->where('id_stan', 2)->where('id_typ',2)->orderBy('poszukiwane.id','desc')->skip($start)->take('6')->get();
            else if($cat=='posz')
                $query=Poszukiwane::select('poszukiwane.id', 'data', 'opis', 'zdjecie', 'rodzaj', 'stan', 'typ')
                ->join('poszukiwane_rodzaj','poszukiwane.id_rodzaj','=','poszukiwane_rodzaj.id')
                ->join('poszukiwane_stan','poszukiwane.id_stan','=','poszukiwane_stan.id')
                ->join('poszukiwane_typ_ogl','poszukiwane.id_typ','=','poszukiwane_typ_ogl.id')
                ->where('id_stan', 2)->where('id_typ',1)->orderBy('poszukiwane.id','desc')->skip($start)->take('6')->get();
            else
                return redirect('/poszukiwane');
        }
        foreach($query as $element)
            $element->data=Carbon::parse($element->data)->format('d.m.Y');
        $pages=Poszukiwane::get()->count();
        $pages=ceil($pages/6);
        if($request->input('cat'))
            $url="/poszukiwane?cat=".$request->input('cat')."&p=";
        else
            $url="/poszukiwane"."?p=";
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
        return view('zwierzeta.poszukiwane.poszukiwane', ['dogs'=>$query, 'buttons'=>$buttons]);
    }
    public function show($id){
        $pies=Poszukiwane::select('poszukiwane.id', 'data', 'opis', 'zdjecie', 'rodzaj', 'stan', 'typ')
        ->join('poszukiwane_rodzaj','poszukiwane.id_rodzaj','=','poszukiwane_rodzaj.id')
        ->join('poszukiwane_stan','poszukiwane.id_stan','=','poszukiwane_stan.id')
        ->join('poszukiwane_typ_ogl','poszukiwane.id_typ','=','poszukiwane_typ_ogl.id')
        ->where('poszukiwane.id',$id)->where('id_stan', 2)->get();
        
        if(isset($pies[0]->id)){
            $pies[0]->data=Carbon::parse($pies[0]->data)->format('d.m.Y');
            return view('zwierzeta.poszukiwane.poszukiwane-pies', ['pies'=>$pies]);
        }
        else
            return redirect('poszukiwane');
    }
}