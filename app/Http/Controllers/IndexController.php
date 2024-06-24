<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Adopcja;
use App\Models\Wpisy;
use App\Models\Slider;
use App\Models\Poszukiwane;
use App\Models\Uzytkownicy;
use App\Models\Statystyki;
use App\Models\Wydarzenia;
use App\Models\Wydarzenia_psy;
use Illuminate\Support\Arr;

class IndexController extends Controller
{
    public function index(){
        $data=Slider::get();
        $count=$data->count();
        $posts=Wpisy::orderBy('id','desc')->take('3')->get();
        $dogs=Adopcja::orderBy('id','desc')->take('3')->get();
        foreach($posts as $element){
            $element->tresc=Str::replace('<p>', "", $element->tresc);
            $element->tresc=Str::replace('</p>', "", $element->tresc);
            for($i=1;$i<=6;$i++){
                $element->tresc=Str::replace("<h'$i'>"," ",$element->tresc);
                $element->tresc=Str::replace("</h'$i'>"," ",$element->tresc);
            }
            if(Str::length($element->tresc)<=196)
                $element->tresc=$element->tresc;
            else
                $element->tresc=Str::substr($element->tresc, 0, 193)."...";
        }
        return view('index', ['slides'=>$data, 'count'=>$count, 'posts'=>$posts, 'dogs'=>$dogs]);
    }
    public function addPosz(Request $request){
        $data=new Poszukiwane;
        $data->id_typ=$request->typ;
        $data->id_rodzaj=$request->rodzaj;
        $data->data=$request->data;
        $data->opis=$request->opis;
        $data->id_stan=1;
        $data->save();$id=$data->id;
        $file = $request->file('imgGlowne');
        $dir_name='public/img/poszukiwane/'.$id;
        $file->move(base_path($dir_name), $file->getClientOriginalName());
        $dir_name='img/poszukiwane/'.$id.'/'.$file->getClientOriginalName();
        $data->zdjecie=$dir_name;
        $data->save();
        return redirect('/')->with('success','Twoje zgłoszenie zostało <b>utworzone</b> i czeka na akceptację administratora');
    }
    public function editSite(){
        $data=Slider::get();
        $count=$data->count();
        return view('admin.strona.edit-site', ['slides'=>$data, 'count'=>$count]);
    }
    public function saveSite(Request $req){
        $query=Slider::get();
        $count=$query->count();
        $noPools=$req->noPools;
        for($i=1;$i<=$noPools;$i++){
            $opis=$req->input('desc-ban'.$i);
            if($req->file('img-ban'.$i)){
                $file=$req->file('img-ban'.$i);
                $dir_name="img/slidery/".$file->getClientOriginalName();
                if(isset($query[$i-1]->zdjecie)){
                    File::delete(base_path('public/'.$query[$i-1]->zdjecie));
                    $slider=Slider::find($i);
                    $slider->opis=$opis;
                    $slider->zdjecie=$dir_name;
                    $slider->save();
                }
                else{
                    $slider=new Slider;
                    $slider->opis=$opis;
                    $slider->zdjecie=$dir_name;
                    $slider->save();
                }
                $file->move(base_path('public/img/slidery'), $file->getClientOriginalName());

            }
            else{
                $slider=Slider::find($i);
                $slider->opis=$opis;
                $slider->save();
            }
        }
        if($count>$noPools){
            for($i=$noPools+1;$i<=$count;$i++)
                File::delete(base_path('public/'.$query[$i-1]->zdjecie));
            $i=$noPools+1;
            $slidery=Slider::where('id','>',$noPools);
            $slidery->delete();
            DB::statement("alter table slider auto_increment=$i");
        }
        return redirect('/adminPanel/edit-site')->with('success', 'Zmiany zostały poprawnie zapisane!');
    }
    public function adminLogin(Request $req){
        //return $req->input();
        /*$login=$req->login;
        $password=Crypt::encrypt($req->password);
        DB::insert("insert into users values (0, '$login', '$password')");*/
        //$query=DB::select("select * from uzytkownicy where login='$req->login'");
        $query=Uzytkownicy::where('login',$req->login)->get();
        if(isset($query[0])){
            if($req->password==Crypt::decrypt($query[0]->haslo)){
                $req->session()->put('user', $req->login);
                return redirect('/adminPanel');
            }
            else
                return redirect('/login')->with('denied', 'Błędny login i/lub hasło');
        }
        else
            return redirect('/login')->with('denied', 'Błędny login i/lub hasło');
    }
    public function logout(Request $req){
        $req->session()->pull('user');
        return redirect('/')->with('success','Zostałeś wylogowany!');
    }
    public function stats(Request $req){
        $currentDay=Statystyki::whereRaw('date(data)=date(current_date())')->get()->count();
        $currentWeek=Statystyki::whereRaw('week(data)=week(current_date())')->get()->count();
        $currentMonth=Statystyki::whereRaw('month(data)=month(current_date())')->get()->count();
        $currentYear=Statystyki::whereRaw('year(data)=year(current_date())')->get()->count();
        $current=collect([$currentDay, $currentWeek, $currentMonth, $currentYear]);
        $yearDet=collect();
        $year=Carbon::now()->year;
        $all=Wydarzenia::get()->count();
        $before=Wydarzenia::where('id_stan', '1')->get()->count();
        $now=Wydarzenia::where('id_stan', '2')->get()->count();
        $after=Wydarzenia::where('id_stan', '3')->get()->count();
        $events=collect([$all, $before, $now, $after]);
        $years=Statystyki::selectRaw('distinct year(data) as rok')->orderBy('rok', 'desc')->get();
        $evNames=Wydarzenia::select('id', 'tytul')->orderBy('id', 'desc')->get();
        if($req->input('event'))
            $event=Wydarzenia_psy::where('id_wydarzenia', $req->input('event'))->get();
        else
            $event=Wydarzenia_psy::where('id_wydarzenia', $evNames[0]->id)->get();
        $dogs=collect([$event[0]->id ,$event->where('id_status', 1)->count(), $event->where('id_status', 2)->count(), $event->count()]);
        if($req->input('year'))
            $year=$req->input('year');
        else
            $year=Carbon::now()->year;
        for($i=1;$i<13;$i++){
            $tmp=Statystyki::whereRaw('month(data)='.$i.' and year(data)='.$year)->get()->count();
            $yearDet->put($i,$tmp);
        }
        return view('admin.stats', ['current'=>$current, 'yearDet'=>$yearDet, 'year'=>$year, 'events'=>$events, 'years'=>$years, 'evNames'=>$evNames, 'dogs'=>$dogs]);
    }
}