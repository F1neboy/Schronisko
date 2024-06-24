<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Adopcja;
use App\Models\Poszukiwane;
use App\Models\Przybyle;
use App\Models\Wydarzenia;
use Illuminate\Support\Facades\DB;

class PoszukiwaneTest extends TestCase
{
    /** @test */
    public function poszukiwane_list_show_test()
    {
        $response = $this->get('/poszukiwane'); 
        $response->isOk();
        $response->assertViewIs('zwierzeta.poszukiwane.poszukiwane');
        $response->assertSee('Znaleziony/Poszukiwany');
    }
    /** @test */
    public function przybyle_one_show_test()
    {
        $poszukiwane=Poszukiwane::find(1);
        $response = $this->get('/poszukiwane/'.$poszukiwane->id);
        $response->assertViewIs('zwierzeta.poszukiwane.poszukiwane-pies'); 
        $response->assertSee('Poszukiwany'); 
        $response->assertSee('Pies'); 
    }
    /** @test */
    public function przybyle_one_failure_show_test(){
        $response = $this->get('/poszukiwane/'.'abc');
        $response->assertSee('Redirecting to ');
    }
    
    /** @test */
    public function przybyle_subpage_failure_show_test(){
        $response = $this->get('/poszukiwane?p='.'abc');
        $response->assertSee('Znaleziony/Poszukiwany');
    }
    /** @test */
    public function poszukiwane_create_dog(){
        $dog=new Poszukiwane;
        $dog->opis='Opis testowy poszukiwane Laravel';
        $dog->id_rodzaj=1;
        $dog->id_stan=2;
        $dog->id_typ=1;
        $dog->save();
        $response = $this->get('poszukiwane/'.$dog->id);
        $response->assertSee('Opis testowy poszukiwane Laravel'); 
        $response->assertSee('Pies'); 
        $response->assertSee('Poszukiwany'); 
    }
    /** @test */
    public function przybyle_update_dog(){
        $poszukiwane=Poszukiwane::where('opis','Opis testowy poszukiwane Laravel')->get();
        $dog=Poszukiwane::find($poszukiwane[0]->id);
        $dog->opis='Zmieniony opis Laravel';
        $dog->id_rodzaj=2;
        $dog->save();
        $response = $this->get('poszukiwane/'.$dog->id);
        $response->assertSee('Zmieniony opis Laravel'); 
        $response->assertSee('Kot'); 
        $response->assertSee('Znaleziony'); 
    }
    /** @test */
    public function przybyle_remove_dog(){
        $poszukiwane=Poszukiwane::where('opis','Zmieniony opis Laravel')->get();
        $id=$poszukiwane[0]->id;
        Poszukiwane::find($id)->delete();
        DB::statement("alter table poszukiwane auto_increment=$id");
        $response = $this->get('/poszukiwane/'.$id);
        $response->assertSee('Redirecting to ');
    }
    

}
