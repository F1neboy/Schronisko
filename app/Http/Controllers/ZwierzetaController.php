<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Input;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Adopcja;
use App\Models\Przybyle;
use App\Models\Poszukiwane;

class ZwierzetaController extends Controller
{
    public function getDataAdopcja(Request $request){
        $dog=new Adopcja;
        $dog->numer=$request->numer;
        $dog->imie=$request->imie;
        $dog->wiek=$request->wiek;
        $dog->rasa=$request->rasa;
        $dog->wielkosc=$request->wielkosc;
        $dog->id_plec=$request->plec;
        $dog->prezent=$request->prezent;
        $dog->opis=$request->opis;
        $dog->save();
        $id=$dog->id;
        $file = $request->file('imgGlowne');
        $dir_name='public/img/adopcja/'.$id.'/main/';
        $file->move(base_path($dir_name), $file->getClientOriginalName());
        $dir_name='img/adopcja/'.$id.'/main/'.$file->getClientOriginalName();
        $dog->zdjecie=$dir_name;
        $dog->save();
        $files = $request->file('imgReszta');
        $dir_name='public/img/adopcja/'.$id;
        foreach($files as $file){ 
            $file->move(base_path($dir_name), $file->getClientOriginalName());
        }
        return redirect('adminPanel')->with('success', 'Pies został <b>poprawnie</b> dodany do zakładki adopcja!');
    }
    public function getDataPrzybyle(Request $request){
        $dog=new Przybyle;
        $dog->id_plec=$request->$plec;
        $dog->data=$request->data;
        $dog->opis=$request->opis;
        $dog->save();
        $id=$dog->id;
        $file = $request->file('imgGlowne');
        $dir_name='public/img/przybyle/'.$id;
        $file->move(base_path($dir_name), $file->getClientOriginalName());
        $dir_name='img/przybyle/'.$id.'/'.$file->getClientOriginalName();
        $dog->zdjecie=$dir_name;
        $dog->save();
        return redirect('adminPanel')->with('success', 'Pies został <b>poprawnie</b> dodany do zakładki przybyłe!');
    }
    public function getDataPoszukiwane(Request $request){
        $data=DB::insert("insert into poszukiwane (id_typ, id_rodzaj, data, opis, id_stan) values ('$request->typ', '$request->rodzaj', '$request->data', '$request->opis', 1);");
        $dog=new Poszukiwane;
        $dog->id_typ=$request->typ;
        $dog->id_rodzaj=$request->rodzaj;
        $dog->data=$request->data;
        $dog->opis=$request->opis;
        $dog->id_stan=1;
        $dog->save();
        $id=$dog->id;
        $file = $request->file('imgGlowne');
        $dir_name='public/img/poszukiwane/'.$id;
        $file->move(base_path($dir_name), $file->getClientOriginalName());
        $dir_name='img/poszukiwane/'.$id.'/'.$file->getClientOriginalName();
        $dog->zdjecie=$dir_name;
        $dog->save();
        return redirect('adminPanel')->with('success', 'Zwierzę zostało <b>poprawnie</b> dodane do zakładki zaginione/poszukiwane!');
    }
    public function listPoszukiwane(){
        $data=Poszukiwane::select('poszukiwane.id', 'data', 'opis', 'zdjecie', 'rodzaj', 'stan', 'typ')
        ->join('poszukiwane_rodzaj','poszukiwane.id_rodzaj','=','poszukiwane_rodzaj.id')
        ->join('poszukiwane_stan','poszukiwane.id_stan','=','poszukiwane_stan.id')
        ->join('poszukiwane_typ_ogl','poszukiwane.id_typ','=','poszukiwane_typ_ogl.id')
        ->where('id_stan', 1)->orderBy('poszukiwane.id','desc')->get();
        foreach($data as $element){
            $element->opis=Str::replace('<p>', "", $element->opis);
            $element->opis=Str::replace('</p>', "", $element->opis);
            for($i=1;$i<=6;$i++){
                $element->opis=Str::replace("<h'$i'>"," ",$element->opis);
                $element->opis=Str::replace("</h'$i'>"," ",$element->opis);
            }
            if(Str::length($element->opis)<=150)
                $element->opis=$element->opis;
            else
                $element->opis=Str::substr($element->opis, 0, 150)."...";
            $element->data=Carbon::parse($element->data)->format('d.m.Y');
        }
        return view('admin.zwierzeta.list-posz', ['dogs'=>$data]);
    }
    public function detPoszukiwane($id, Request $req){
        $data=DB::select("Select poszukiwane.id, data, opis, zdjecie, rodzaj, stan, typ from poszukiwane, poszukiwane_rodzaj, poszukiwane_stan, poszukiwane_typ_ogl 
        where poszukiwane.id_rodzaj=poszukiwane_rodzaj.id and poszukiwane.id_typ=poszukiwane_typ_ogl.id and poszukiwane.id_stan=poszukiwane_stan.id and poszukiwane.id='$id'");
        $data=Poszukiwane::select('poszukiwane.id', 'data', 'opis', 'zdjecie', 'rodzaj', 'stan', 'typ')
        ->join('poszukiwane_rodzaj','poszukiwane.id_rodzaj','=','poszukiwane_rodzaj.id')
        ->join('poszukiwane_stan','poszukiwane.id_stan','=','poszukiwane_stan.id')
        ->join('poszukiwane_typ_ogl','poszukiwane.id_typ','=','poszukiwane_typ_ogl.id')
        ->where('poszukiwane.id', $id)->get();

        if(isset($data[0]->id)){
            $det=Poszukiwane::find($data[0]->id);
            if($req->input('stat')){
                if($req->input('stat')==1)
                    $det->id_stan=2;
                if($req->input('stat')==2)
                    $det->id_stan=3;
                $det->save();
                return redirect('adminPanel/list-posz')->with('success', 'Status zgłoszenia został zmieniony!');
            }
            else{
                $data[0]->data=Carbon::parse($data[0]->data)->format('d.m.Y');
                return view('admin.zwierzeta.det-posz', ['dog'=>$data]);
            }
        }
        else{
            return redirect('adminPanel/list-posz');
        }

    }
    public function panelAdopcja(){
        $data=Adopcja::select('*','adopcja.id as id')->join('zwierze_plec', 'adopcja.id_plec','=','zwierze_plec.id')->orderBy('adopcja.id','desc')->get();
        foreach($data as $elem)
            $elem->data_dodania=Carbon::parse($elem->data_dodania)->format('d.m.Y');
        return view('admin.zwierzeta.panel-adopcja', ['dogs'=>$data]);
    }
    public function editDog($id, Request $req){
        $data=Adopcja::where('id',$id)->get();
        if(isset($data[0]->id)){
            if($req->input('del')==true){
                Adopcja::find($id)->delete();
                File::deleteDirectory(base_path('/public/img/adopcja/'.$id));
                return redirect('adminPanel/panel-adopcja')->with('success', 'Pies został <b>poprawnie</b> usunięty');
            }
            $data[0]->data_dodania=Carbon::parse($data[0]->data_dodania)->format('d.m.Y H:i');
            $path = 'img/adopcja/'.$id;
            $files=File::files($path);
            if($req->input('f')){
                File::delete(base_path('public/'.$req->input('f')));
                return redirect('adminPanel/panel-adopcja/'.$id)->with('success', 'Zdjęcie zostało <b>pomyślnie</b> usunięte!');
            }
            return view('admin.zwierzeta.edit-dog', ['dog'=>$data, 'files'=>$files]);
        }
        else{
            return redirect('/adminPanel/panel-adopcja');
        }
    }
    public function saveAdopcja($id, Request $req){
        if($req->file('imgReszta')){
            $files = $req->file('imgReszta');
            $dir_name='public/img/adopcja/'.$id;
            foreach($files as $file)
                $file->move(base_path($dir_name), $file->getClientOriginalName());
        }
        else{
            $dog=Adopcja::find($id);
            $dog->numer=$req->numer;
            $dog->imie=$req->imie;
            $dog->wiek=$req->wiek;
            $dog->rasa=$req->rasa;
            $dog->wielkosc=$req->wielkosc;
            $dog->id_plec=$req->plec;
            $dog->prezent=$req->prezent;
            $dog->opis=$req->opis;
            $dog->save();
            if($req->file('imgGlowne')){
                $dir_name='img/adopcja/'.$id.'/';
                if($req->act_mp==1){
                    $lng=Str::length('img/adopcja/'.$id.'/main/');
                    $fileName=Str::substr($dog->zdjecie, $lng);
                    File::move(base_path('public/'.$dog->zdjecie), base_path('public/'.$dir_name.$fileName));
                }
                else
                    File::delete(base_path('public/'.$dog->zdjecie));
                $file=$req->file('imgGlowne');
                $file->move(base_path('public/'.$dir_name.'main'), $file->getClientOriginalName());
                $dir_name.="main/".$file->getClientOriginalName();
                $dog->zdjecie=$dir_name;
                $dog->save();
            }
        }
        return redirect('adminPanel/panel-adopcja/'.$id)->with('success', 'Zmiany zostały <b>poprawnie</b> zapisane');
    }
    public function panelPrzybyle(){
        $data=Przybyle::select('*','przybyle.id as id')->join('zwierze_plec','przybyle.id_plec','=','zwierze_plec.id')->orderBy('przybyle.id','desc')->get();
        foreach($data as $elem){
            $elem->data=Carbon::parse($elem->data)->format('d.m.Y');
        }
        return view('admin.zwierzeta.panel-przyb', ['dogs'=>$data]);
    }
    public function editPrzybyle($id, Request $req){
        $data=Przybyle::where('id',$id)->get();
        if(isset($data[0]->id)){
            if($req->input('del')==true){
                Przybyle::find($id)->delete();
                File::deleteDirectory(base_path('/public/img/przybyle/'.$id));
                return redirect('adminPanel/panel-przybyle')->with('success', 'Pies został <b>poprawnie</b> usunięty');
            }
            $data[0]->data=Carbon::parse($data[0]->data)->format('Y-m-d');
            return view('admin.zwierzeta.edit-przyb', ['dog'=>$data]);
        }
        else
            return redirect('/adminPanel/panel-przybyle');
    }
    public function savePrzybyle($id, Request $req){
        $dog=Przybyle::find($id);
        $dog->id_plec=$req->plec;
        $dog->data=$req->data;
        $dog->opis=$req->opis;
        $dog->save();
        if($req->file('imgGlowne'))
        {
            File::delete(base_path('public/'.$dog->zdjecie));
            $file=$req->file('imgGlowne');
            $file->move(base_path('public/img/przybyle/'.$id), $file->getClientOriginalName());
            $dir_name='img/przybyle/'.$id.'/'.$file->getClientOriginalName();
            $dog->zdjecie=$dir_name;
            $dog->save();

        }
        return redirect('/adminPanel/panel-przybyle/'.$id)->with('success', 'Zmiany zostały <b>poprawnie</b> zapisane');
    }
    public function panelPoszukiwane(){
        $data=Poszukiwane::select('poszukiwane.id', 'data', 'opis', 'zdjecie', 'rodzaj', 'stan', 'typ')
        ->join('poszukiwane_rodzaj','poszukiwane.id_rodzaj','=','poszukiwane_rodzaj.id')
        ->join('poszukiwane_stan','poszukiwane.id_stan','=','poszukiwane_stan.id')
        ->join('poszukiwane_typ_ogl','poszukiwane.id_typ','=','poszukiwane_typ_ogl.id')
        ->orderBy('poszukiwane.id','desc')->get();
        foreach($data as $elem){
            $elem->data=Carbon::parse($elem->data)->format('d.m.Y');
        }
        return view('admin.zwierzeta.panel-posz', ['dogs'=>$data]);
    }
    public function editPoszukiwane($id, Request $req){
        $data=Poszukiwane::where('id',$id)->get();
        if(isset($data[0]->id)){
            if($req->input('del')==true){
                Poszukiwane::find($id)->delete();
                File::deleteDirectory(base_path('/public/img/poszukiwane/'.$id));
                return redirect('adminPanel/panel-poszukiwane')->with('success', 'Zgłoszenie zostało usunięte');
            }
            $data[0]->data=Carbon::parse($data[0]->data)->format('Y-m-d');
            return view('admin.zwierzeta.edit-posz', ['dog'=>$data]);
        }
        else
            return redirect('/adminPanel/panel-poszukiwane');
    }
    public function savePoszukiwane($id, Request $req){
        $dog=Poszukiwane::find($id);
        $dog->id_typ=$req->rodzaj;
        $dog->id_rodzaj=$req->zwierz;
        $dog->data=$req->data;
        $dog->opis=$req->opis;
        $dog->id_stan=$req->stan;
        $dog->save();
        if($req->file('imgGlowne'))
        {
            File::delete(base_path('public/'.$dog->zdjecie));
            $file=$req->file('imgGlowne');
            $file->move(base_path('public/img/poszukiwane/'.$id), $file->getClientOriginalName());
            $dir_name='img/poszukiwane/'.$id.'/'.$file->getClientOriginalName();
            $dog->zdjecie=$dir_name;
            $dog->save();

        }
        return redirect('/adminPanel/panel-poszukiwane/'.$id)->with('success', 'Zmiany zostały <b>poprawnie</b> zapisane');
    }
}