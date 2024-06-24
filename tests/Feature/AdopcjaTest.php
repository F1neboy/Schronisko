<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Adopcja;
use App\Models\Poszukiwane;
use App\Models\Przybyle;
use App\Models\Wydarzenia;
use Illuminate\Support\Facades\DB;

class AdopcjaTest extends TestCase
{
    /** @test */
    public function adopcja_list_show_test()
    {
        $response = $this->get('/adopcja'); 
        $response->isOk();
        $response->assertViewIs('zwierzeta.adopcja.adopcja');
        $response->assertSee('Psy do adopcji');
    }
    /** @test */
    public function adopcja_one_show_test()
    {
        $adopcja=Adopcja::find(1);
        $response = $this->get('/adopcja/'.$adopcja->id);
        $response->assertSee('Poszukiwany'); 
        $response->assertSee('Pies'); 
    }
    /** @test */
    public function adopcja_one_failure_show_test(){
        $response = $this->get('/adopcja/'.'abc');
        $response->assertSee('Redirecting to ');
    }
    
    /** @test */
    public function adopcja_subpage_failure_show_test(){
        $response = $this->get('/adopcja?p='.'abc');
        $response->assertSee('Psy do adopcji');
    }
    /** @test */
    public function adopcja_create_dog(){
        $dog=new Adopcja;
        $dog->opis='Opis testowy adopcja Laravel';
        $dog->id_plec=1;
        $dog->save();
        $response = $this->get('adopcja/'.$dog->id);
        $response->assertSee('Opis testowy poszukiwane Laravel'); 
        $response->assertSee('Pies'); 
    }
    /** @test */
    public function przybyle_update_dog(){
        $adopcja=Adopcja::where('opis','Opis testowy adopcja Laravel')->get();
        $dog=Adopcja::find($adopcja[0]->id);
        $dog->opis='Zmieniony opis Laravel';
        $dog->id_plec=2;
        $dog->save();
        $response = $this->get('adopcja/'.$dog->id);
        $response->assertSee('Zmieniony opis Laravel'); 
        $response->assertSee('Suka'); 
    }
    /** @test */
    public function przybyle_remove_dog(){
        $adopcja=Adopcja::where('opis','Zmieniony opis Laravel')->get();
        $id=$adopcja[0]->id;
        Adopcja::find($id)->delete();
        DB::statement("alter table adopcja auto_increment=$id");
        $response = $this->get('/adopcja/'.$id);
        $response->assertSee('Redirecting to ');
    }
    

}
