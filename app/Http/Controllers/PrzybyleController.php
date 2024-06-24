<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Przybyle;
include ("helpers.php");

class PrzybyleController extends Controller
{
    public function all(Request $request){
        if(is_int($request->input('p'))){
            $p=$request->input('p');
            $pages=ceil(Przybyle::get()->count()/6);
            if($p<=$pages)
                return redirect('/przybyle');
        }
        else
            $p=1;
        $start=($p*6)-1-5;
        $query=Przybyle::select('*','przybyle.id as id')->join('zwierze_plec','przybyle.id_plec','=','zwierze_plec.id')
        ->orderBy('przybyle.id','desc')->skip($start)->take(6)->get();
        foreach($query as $element){
            if($element->plec=="0")
                $element->plec="Pies";
            else if($element->plec=="1")
                $element->plec="Suczka";
            $element->data=Carbon::parse($element->data)->format('d.m.Y');
        }
        $pages=Przybyle::get()->count();
        $pages=ceil($pages/6);
        $url="/przybyle"."?p=";
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
        return view('zwierzeta.przybyle.przybyle', ['dogs'=>$query, 'buttons'=>$buttons]);
    }
    public function show($id){
        $pies=Przybyle::join('zwierze_plec','przybyle.id_plec','=','zwierze_plec.id')->where('przybyle.id',$id)->get();
        if(isset($pies[0]->id)){
            if($pies[0]->plec=="0")
                $pies[0]->plec="Pies";
            else if($pies[0]->plec=="1")
                $pies[0]->plec="Suczka";
                $pies[0]->data=Carbon::parse($pies[0]->data)->format('d.m.Y');
            return view('zwierzeta.przybyle.przybyle-pies', ['pies'=>$pies]);
        }
        else
            return redirect('przybyle');
    }
}