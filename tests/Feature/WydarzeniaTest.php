<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Adopcja;
use App\Models\Poszukiwane;
use App\Models\Przybyle;
use App\Models\Wydarzenia;
use Illuminate\Support\Facades\DB;

class WydarzeniaTest extends TestCase
{
    /** @test */
    public function wydarzenia_list_show_test()
    {
        $response = $this->get('/wydarzenia'); 
        $response->isOk();
        $response->assertViewIs('wydarzenia.wydarzenia');
        $response->assertSee('Wydarzenia');
    }
    /** @test */
    public function wydarzenia_one_show_test()
    {
        $wydarzenia=Wydarzenia::find(1);
        $response = $this->get('/wydarzenia/'.$wydarzenia->id);
        $response->assertViewIs('wydarzenia.wydarzenie'); 
        $response->assertSee('Gwiazdka'); 
    }
    /** @test */
    public function wydarzenia_one_failure_show_test(){
        $response = $this->get('/wydarzenia/'.'abc');
        $response->assertSee('Redirecting to ');
    }
    
    /** @test */
    public function wydarzenia_subpage_failure_show_test(){
        $response = $this->get('/wydarzenia/?p='.'abc');
        $response->assertSee('Wydarzenia w schronisku');
    }
    /** @test */
    public function wydarzenie_create_test(){
        $wydarzenie=new Wydarzenia;
        $wydarzenie->tytul='Wydarzenie testowe Laravel';
        $wydarzenie->skrocony='Opis testowy nowe wydarzenie Laravel';
        $wydarzenie->id_stan=2;
        $wydarzenie->save();
        $response = $this->get('wydarzenia');
        $response->assertViewIs('wydarzenia.wydarzenia'); 
        $response->assertSee('Wydarzenie testowe Laravel'); 
        $response->assertSee('Opis testowy nowe wydarzenie Laravel'); 
    }
    /** @test */
    public function wydarzenie_update_test(){
        $wydarzenie=Wydarzenia::where('tytul','Wydarzenie testowe Laravel')->get();
        $wydarzenie=Wydarzenia::find($wydarzenie[0]->id);
        $wydarzenie->tytul='Zmieniony tytul wydarzenia Laravel';
        $wydarzenie->skrocony='Zmieniony opis wydarzenia Laravel';
        $wydarzenie->save();
        $response = $this->get('wydarzenia');
        $response->assertViewIs('wydarzenia.wydarzenia'); 
        $response->assertSee('Zmieniony tytul wydarzenia Laravel'); 
        $response->assertSee('Zmieniony opis wydarzenia Laravel'); 
    }
    /** @test */
    public function wydarzenia_remove_test(){
        $wydarzenie=Wydarzenia::where('tytul','Zmieniony tytul wydarzenia Laravel')->get();
        $id=$wydarzenie[0]->id;
        DB::statement("alter table wydarzenia auto_increment=$id");
        Wydarzenia::find($id)->delete();
        $response = $this->get('/wydarzenia/'.$id);
        $response->assertSee('Redirecting to ');
    }
    
    

}
