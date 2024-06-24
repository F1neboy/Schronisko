<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Adopcja;
use App\Models\Poszukiwane;
use App\Models\Przybyle;
use App\Models\Wydarzenia;
use App\Models\Wpisy;
use Illuminate\Support\Facades\DB;

class WpisyTest extends TestCase
{
    /** @test */
    public function wpisy_list_show_test()
    {
        $response = $this->get('/aktualnosci'); 
        $response->isOk();
        $response->assertViewIs('aktualnosci.aktualnosci');
        $response->assertSee('Aktualności');
    }
    /** @test */
    public function wpis_one_show_test()
    {
        $wpis=Wpisy::find(1);
        $response = $this->get('/aktualnosci/'.$wpis->id);
        $response->assertSee('Zmiana godzin otwarcia'); 
    }
    /** @test */
    public function wpis_one_failure_show_test(){
        $response = $this->get('/aktualnosci/'.'abc');
        $response->assertSee('Redirecting to ');
    }
    
    /** @test */
    public function wpis_subpage_failure_show_test(){
        $response = $this->get('/aktualnosci/?p='.'abc');
        $response->assertSee('Aktualności');
    }
    /** @test */
    public function wydarzenie_create_test(){
        $wpis=new Wpisy;
        $wpis->tytul='Wpis testowy Laravel';
        $wpis->tresc='Opis testowy nowy wpis Laravel';
        $wpis->save();
        $response = $this->get('aktualnosci/'.$wpis->id);
        $response->assertSee('Wpis testowy Laravel'); 
        $response->assertSee('Opis testowy nowy wpis Laravel'); 
    }
    /** @test */
    public function wydarzenie_update_test(){
        $wpis=Wpisy::where('tytul','Wpis testowy Laravel')->get();
        $wpis=Wpisy::find($wpis[0]->id);
        $wpis->tytul='Zmieniony tytul wpisu Laravel';
        $wpis->tresc='Zmieniony opis wpisu Laravel';
        $wpis->save();
        $response = $this->get('aktualnosci/'.$wpis->id);
        $response->assertSee('Zmieniony tytul wpisu Laravel'); 
        $response->assertSee('Zmieniony opis wpisu Laravel'); 
    }
    /** @test */
    public function wydarzenia_remove_test(){
        $wpis=Wpisy::where('tytul','Zmieniony tytul wpisu Laravel')->get();
        $id=$wpis[0]->id;
        DB::statement("alter table wpisy auto_increment=$id");
        Wpisy::find($id)->delete();
        $response = $this->get('/aktualnosci/'.$id);
        $response->assertSee('Redirecting to ');
    }
    
    

}
