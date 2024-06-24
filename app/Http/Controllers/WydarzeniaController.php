<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\Wydarzenia;
use App\Models\Wydarzenia_psy;
use App\Models\Adopcja;
include ("helpers.php");

class WydarzeniaController extends Controller
{
    public function all(){
        $query=Wydarzenia::where('id_stan',2)->get();
        foreach($query as $element){
            $element->start_data=Carbon::parse($element->start_data)->format('d.m.Y');
            $element->end_data=Carbon::parse($element->end_data)->format('d.m.Y');  
        }
        $query2=Wydarzenia::where('id_stan',3)->get();
        foreach($query2 as $element){
            $element->start_data=Carbon::parse($element->start_data)->format('d.m.Y');
            $element->end_data=Carbon::parse($element->end_data)->format('d.m.Y');  
        }
        return view('wydarzenia.wydarzenia', ['currentEvents'=>$query, 'prevEvents'=>$query2]);
    }
    public function show($id, Request $request){
        $wydarzenie=Wydarzenia::where('id',$id)->where('id_stan',2)->get();
        if(isset($wydarzenie[0]->id)){
            if(is_int($request->input('p'))){
                $p=$request->input('p');
                $pages=ceil(Wydarzenia_psy::get()->count()/9);
                if($p<=$pages)
                    return redirect('/aktualnosci');
            }
            else
                $p=1;
            $start=($p*9)-1-8;
            $psy=Wydarzenia_psy::join('adopcja','wydarzenia_psy.id_psa','=','adopcja.id')
            ->where('id_wydarzenia',$id)->where('id_status',1)->skip($start)->take('9')->get();
            $pages=Wydarzenia_psy::where('id_wydarzenia',$id)->where('id_status',1)->get()->count();
            $pages=ceil($pages/9);
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
                return view('wydarzenia.wydarzenie', ['event'=>$wydarzenie, 'dogs'=>$psy, 'buttons'=>$buttons]);
            }
        else
            return redirect('wydarzenia');
    }
    public function formWyd(){
        $data=Adopcja::get();
        return view('admin.wydarzenia.add-evt',['dogs'=>$data]);
    }
    public function addWydarzenie(Request $req){
        DB::insert("insert into wydarzenia (tytul, start_data, end_data, skrocony, opis, id_stan) VALUES ('$req->tytul', '$req->data_st', '$req->data_end', '$req->shopis', '$req->opis', 1);");
        $wydarzenie=new Wydarzenie;
        $wydarzenie->tytul=$req->tytul;
        $wydarzenie->start_data=$req->data_st;
        $wydarzenie->end_data=$req->data_end;
        $wydarzenie->skrocony=$req->shopis;
        $wydarzenie->opis=$req->opis;
        $wydarzenie->id_stan=1;
        $wydarzenie_>save();
        $id=$wydarzenie->id;
        $file=$req->file('imgGlowne');
        $file->move(base_path('public/img/wydarzenia/'.$id), $file->getClientOriginalName());
        $dir_name='img/wydarzenia/'.$id.'/'.$file->getClientOriginalName();
        $wydarzenie->zdjecie=$dir_name;
        $wydarzenie->save();
        $data=Adopcja::get();
        foreach($data as $elem){
            if($req->input('d'.$elem->id))
            $pies=new Wydarzenia_psy;
            $pies->id_wydarzenia=$id;
            $pies->id_psa=$elem->$id;
            $pies->save;
        }
        return redirect('/adminPanel')->with('success', 'Wydarzenie zostało <b>utworzone</b>!');
    }
    public function panelWydarzenia(){
        $data=Wydarzenia::select('*','wydarzenia.id as id')->join('wydarzenia_stan','wydarzenia.id_stan','=','wydarzenia_stan.id')->orderBy('wydarzenia.id','desc')->get();
        foreach($data as $element){
            $element->start_data=Carbon::parse($element->start_data)->format('d.m.Y');
            $element->end_data=Carbon::parse($element->end_data)->format('d.m.Y');
        }
        return view('admin.wydarzenia.panel-wyd', ['events'=>$data]);
    }
    public function editWydarzenia($id, Request $req){
        $data=Wydarzenia::where('id', $id)->get();
        if(isset($data[0]->id)){
            if($req->input('del')==true){
                Wydarzenia_psy::where('id_wydarzenia', $id)->delete();
                Wydarzenia::where('id', $id)->delete();
                File::deleteDirectory(base_path('/public/img/wydarzenia/'.$id));
                return redirect('adminPanel/panel-wydarzenia')->with('success', 'Wydarzenie zostało <b>pomyślnie</b> usunięte!');
            }
            $data[0]->start_data=Carbon::parse($data[0]->start_data)->format('Y-m-d');
            $data[0]->end_data=Carbon::parse($data[0]->end_data)->format('Y-m-d');
            $dogs=Wydarzenia_psy::select('wydarzenia_psy.*', 'adopcja.imie', 'adopcja.zdjecie', 'status')
            ->join('adopcja', 'wydarzenia_psy.id_psa','=','adopcja.id')
            ->join('wydarzenia_status_psa', 'wydarzenia_psy.id_status','=','wydarzenia_status_psa.id')
            ->where('id_wydarzenia', $id)->get();
            $suma=Wydarzenia_psy::select('wydarzenia_psy.id')->where('id_wydarzenia', $id)->get()->count();
            $suma2=Wydarzenia_psy::select('wydarzenia_psy.id')->where('id_wydarzenia', $id)->where('id_status',2)->get()->count();
            $stats=array('suma'=>$suma, 'sumaZ'=>$suma2);
            return view('admin.wydarzenia.edit-wyd', ['event'=>$data, 'dogs'=>$dogs, 'stats'=>$stats]);
        }
        else
            return redirect('/adminPanel/panel-wydarzenia');

    }
    public function saveWydarzenia($id, Request $req){
        $wydarzenie=Wydarzenia::find($id);
        $wydarzenie->tytul=$req->tytul;
        $wydarzenie->start_data=$req->dataS;
        $wydarzenie->end_data=$req->dataE;
        $wydarzenie->skrocony=$req->shopis;
        $wydarzenie->opis=$req->opis;
        $wydarzenie->id_stan=$req->status;
        $wydarzenie->save();
        if($req->file('imgGlowne'))
        {
            $data=DB::select("select zdjecie from wydarzenia where id=$id");
            File::delete(base_path('public/'.$data[0]->zdjecie));
            $file=$req->file('imgGlowne');
            $file->move(base_path('public/img/wydarzenia/'.$id), $file->getClientOriginalName());
            $dir_name='img/wydarzenia/'.$id.'/'.$file->getClientOriginalName();
            $wydarzenie->zdjecie=$dir_name;
            $wydarzenie->save();
        }
        return redirect('adminPanel/panel-wydarzenia/'.$id)->with('success', 'Zmiany zostały <b>pomyślnie</b> zapisane!');
    }
    public function editDog($id, $idDog){
        $dog=Wydarzenia_psy::where('id_wydarzenia',$id)->where('id_psa',$idDog)->get();
        $data=Wydarzenia_psy::find($dog[0]->id);
        if($data->id_status==1)
            $data->id_status=2;
        else if($data->id_status==2){
            $data->id_status=1;
            $data->kod_pin=NULL;
            $data->email=NULL;
        }
        $data->save();
        return redirect('adminPanel/panel-wydarzenia/'.$id)->with('success', '<b>Status</b> psa został zmieniony!');
    }
    public function showDog($id, $idDog){
        $data=Wydarzenia_psy::where('id_psa',$idDog)->where('id_wydarzenia', $id)->get();
        if($data[0]->id_status==1){
            $data=Adopcja::select('*', 'adopcja.id as id')
            ->join('zwierze_plec','adopcja.id_plec','=','zwierze_plec.id')->where('adopcja.id',$idDog)->get();
            $wydName=Wydarzenia::where('id',$id)->get();
            $path = 'img/adopcja/'.$idDog;
            $files=File::files($path);
            $to = Carbon::createFromFormat('Y-m-d', $data[0]->wiek);
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
            $data[0]->wiek=years($wiek)." ".months($wiek);
            return view('wydarzenia.wydarzenia-pies', ['pies'=>$data, 'galeria'=>$files, 'status'=>1, 'tytul'=>$wydName[0]->tytul]);
        }else
            return redirect('wydarzenia/'.$id);
    }
    public function reserveDog($id, $idDog, Request $req){
        $dog=Wydarzenia_psy::where('id_wydarzenia',$id)->where('id_psa',$idDog)->get();
        $data=Wydarzenia_psy::find($dog[0]->id);
        if($data->kod_pin==NULL&&$data->email==NULL&&$data->id_status==1){
            $mail=$req->email;
            $pin=sprintf("%05s", rand(0,99999));
            $dog=Adopcja::where('id',$idDog)->get();
            $event=Wydarzenia::where('id',$id)->get();
            $data->email=$mail;
            $data->kod_pin=$pin;
            $data->id_status=2;
            $data->save();
            return view('wydarzenia.wydarzenie-status', ['mail'=>$mail, 'pin'=>$pin, 'event'=>$event, 'dog'=>$dog]);
        }
        else
            return redirect('wydarzenia/'.$id);
    }
    public function checkDog(Request $req){
        $data2=Wydarzenia_psy::where('kod_pin',$req->pin)->where('email', $req->email)->get();
        if(!$data2->isEmpty()){
            $idDog=$data2[0]->id_psa;
            $data=Adopcja::select('*', 'adopcja.id as id')
            ->join('zwierze_plec','adopcja.id_plec','=','zwierze_plec.id')->where('adopcja.id',$idDog)->get();
            $path = 'img/adopcja/'.$idDog;
            $wydName=Wydarzenia::where('id',$data2[0]->id_wydarzenia)->get();
            $files=File::files($path);
            $to = Carbon::createFromFormat('Y-m-d', $data[0]->wiek);
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
            $data[0]->wiek=years($wiek)." ".months($wiek);
            return view('wydarzenia.wydarzenia-pies', ['pies'=>$data, 'galeria'=>$files, 'status'=>0, 'tytul'=>$wydName[0]->tytul]);

        }
        else
            return redirect('wydarzenia')->with('failure', 'Wprowadzono <b>błędne</b> dane!');
    }
}