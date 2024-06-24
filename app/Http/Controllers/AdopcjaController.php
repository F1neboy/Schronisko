<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adopcja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Input;
use Carbon\Carbon;
include ("helpers.php");

class AdopcjaController extends Controller
{
    public function all(Request $request){
        if(is_int($request->input('p'))){
            $p=$request->input('p');
            $pages=ceil(Adopcja::get()->count()/6);
            if($p<=$pages)
                return redirect('/adopcja');
        }
        else
            $p=1;
        $start=($p*6)-1-5;
        if(!$request->input('cat'))
            $query=Adopcja::orderBy('id', 'desc')->skip($start)->take('6')->get();
        else{
            $cat=$request->input('cat');
            if($cat=='pp')
                $query=Adopcja::where('id_plec', 1)->orderBy('id', 'desc')->skip($start)->take('6')->get();
            else if($cat=='ps')
                $query=Adopcja::where('id_plec', 2)->orderBy('id', 'desc')->skip($start)->take('6')->get();
            else if($cat=='wm')
                $query=Adopcja::where('wielkosc','<=','37')->orderBy('id', 'desc')->skip($start)->take('6')->get();
            else if($cat=='ws')
                $query=Adopcja::where('wielkosc','>','37')->where('wielkosc','<=','70')->orderBy('id', 'desc')->skip($start)->take('6')->get();
            else if($cat=='wd')
                $query=Adopcja::where('wielkosc','>','70')->orderBy('id', 'desc')->skip($start)->take('6')->get();
            else if($cat=='om')
                $query=Adopcja::whereRaw('timestampdiff(year,wiek, now())>=0 and timestampdiff(year,wiek, now())<=3')->orderBy('id', 'desc')->skip($start)->take('6')->get();
            else if($cat=='os')
                $query=Adopcja::whereRaw('timestampdiff(year,wiek, now())>=4 and timestampdiff(year,wiek, now())<=9')->orderBy('id', 'desc')->skip($start)->take('6')->get();
            else if($cat=='oss')
                $query=Adopcja::whereRaw('timestampdiff(year,wiek, now())>=10')->orderBy('id', 'desc')->skip($start)->take('6')->get();
            else
                return redirect('/adopcja');
        }
        $pages=Adopcja::get();
        $pages=ceil($pages->count()/6);
        if($request->input('cat'))
            $url="/adopcja?cat=".$request->input('cat')."&p=";
        else
            $url="/adopcja"."?p=";
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
        return view('zwierzeta.adopcja.adopcja', ['dogs'=>$query, 'buttons'=>$buttons]);
    }
    public function show($id){
        $pies=Adopcja::join('zwierze_plec', 'adopcja.id_plec','=','zwierze_plec.id')->where('adopcja.id',[$id])->get();
        if(isset($pies[0]->id)){
            $path = 'img/adopcja/'.$id;
            $files=File::files($path);
            $to = Carbon::createFromFormat('Y-m-d', $pies[0]->wiek);
            $from = Carbon::now()->toDateTimeString();
            $wiek=$to->diffInMonths($from);
            function years($wiek){
                $wiek=floor($wiek/12);
                if($wiek==0)
                    return "";
                else if($wiek==1)
                    return "1 rok";
                else if($wiek%10==1)
                    return $wiek." lat";
                else
                    return $wiek." lata";
            }
            function months($wiek){
                
                $wiek=$wiek%12;
                if($wiek==0)
                    return "";
                else if($wiek==1)
                    return "1 miesiąc";
                else if($wiek>=2&&$wiek<=4)
                    return $wiek." miesiące";
                else
                    return $wiek." miesięcy";
            }
            $pies[0]->wiek=years($wiek)." ".months($wiek);
            return view('zwierzeta.adopcja.adopcja-pies', ['pies' => $pies, 'galeria' => $files]);
        }
        else
            return redirect('adopcja');
    }
}
