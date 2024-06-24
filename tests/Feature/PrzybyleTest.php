<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Adopcja;
use App\Models\Poszukiwane;
use App\Models\Przybyle;
use App\Models\Wydarzenia;
use Illuminate\Support\Facades\DB;

class PrzybyleTest extends TestCase
{
    /** @test */
    public function przybyle_list_show_test()
    {
        $response = $this->get('/przybyle'); 
        $response->isOk();
        $response->assertViewIs('zwierzeta.przybyle.przybyle');
        $response->assertSee('Przybyłe');
    }
    /** @test */
    public function przybyle_one_show_test()
    {
        $przybyle=Przybyle::find(1);
        $response = $this->get('/przybyle/'.$przybyle->id);
        $response->assertViewIs('zwierzeta.przybyle.przybyle-pies'); 
        $response->assertSee('Przybyłe'); 
    }
    /** @test */
    public function przybyle_one_failure_show_test(){
        $response = $this->get('/przybyle/'.'abc');
        $response->assertSee('Redirecting to ');
    }
    
    /** @test */
    public function przybyle_subpage_failure_show_test(){
        $response = $this->get('/przybyle/?p='.'abc');
        $response->assertSee('Redirecting to ');
    }
    /** @test */
    public function przybyle_create_dog(){
        $dog=new Przybyle;
        $dog->opis='Opis testowy przybyle Laravel';
        $dog->id_plec=1;
        $dog->save();
        $response = $this->get('przybyle/'.$dog->id);
        $response->assertViewIs('zwierzeta.przybyle.przybyle-pies'); 
        $response->assertSee('Opis testowy przybyle Laravel'); 
        $response->assertSee('Pies'); 
    }
    /** @test */
    public function przybyle_update_dog(){
        $przybyle=Przybyle::where('opis','Opis testowy przybyle Laravel')->get();
        $dog=Przybyle::find($przybyle[0]->id);
        $dog->opis='Zmieniony opis Laravel';
        $dog->id_plec=2;
        $dog->save();
        $response = $this->get('przybyle/'.$dog->id);
        $response->assertViewIs('zwierzeta.przybyle.przybyle-pies'); 
        $response->assertSee('Zmieniony opis Laravel'); 
        $response->assertSee('Suka'); 
    }
    /** @test */
    public function przybyle_remove_dog(){
        $przybyle=Przybyle::where('opis','Zmieniony opis Laravel')->get();
        $id=$przybyle[0]->id;
        DB::statement("alter table przybyle auto_increment=$id");
        Przybyle::find($id)->delete();
        $response = $this->get('/przybyle/'.$id);
        $response->assertSee('Redirecting to ');
    }
    
    /** @test */
    public function wydarzenia_one_show_test()
    {
        $wydarzenie=Wydarzenia::find(1);
        $response = $this->get('/wydarzenia');
        $response->assertViewIs('wydarzenia.wydarzenia'); 
        $response->assertSee($wydarzenie->tytul); 
    }
    

}
