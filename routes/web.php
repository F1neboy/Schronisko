<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdopcjaController;
use App\Http\Controllers\PrzybyleController;
use App\Http\Controllers\PoszukiwaneController;
use App\Http\Controllers\WydarzeniaController;
use App\Http\Controllers\AktualnosciController;
use App\Http\Controllers\ZwierzetaController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['custom.auth'])->group(function(){
    Route::get('/adminPanel', function(){return view('admin.adminPanel');});

    Route::get('/adminPanel/add-dog', function(){return view('admin.zwierzeta.add-dog');});
    Route::post('/adminPanel/add_dog', [ZwierzetaController::class, 'getDataAdopcja']);

    Route::get('/adminPanel/add-przyb', function(){return view('admin.zwierzeta.add-przyb');});
    Route::post('/adminPanel/add_przyb', [ZwierzetaController::class, 'getDataPrzybyle']);

    Route::get('/adminPanel/add-posz', function(){return view('admin.zwierzeta.add-posz');});
    Route::post('/adminPanel/add_posz', [ZwierzetaController::class, 'getDataPoszukiwane']);

    Route::get('/adminPanel/list-posz', [ZwierzetaController::class, 'listPoszukiwane']);
    Route::get('/adminPanel/list-posz/{id}', [ZwierzetaController::class, 'detPoszukiwane']);

    Route::get('/adminPanel/panel-adopcja', [ZwierzetaController::class, 'panelAdopcja']);
    Route::get('/adminPanel/panel-adopcja/{id}', [ZwierzetaController::class, 'editDog']);
    Route::post('/adminPanel/panel-adopcja/{id}', [ZwierzetaController::class, 'saveAdopcja']);

    Route::get('/adminPanel/panel-przybyle', [ZwierzetaController::class, 'panelPrzybyle']);
    Route::get('/adminPanel/panel-przybyle/{id}', [ZwierzetaController::class, 'editPrzybyle']);
    Route::post('/adminPanel/panel-przybyle/{id}', [ZwierzetaController::class, 'savePrzybyle']);

    Route::get('/adminPanel/panel-poszukiwane', [ZwierzetaController::class, 'panelPoszukiwane']);
    Route::get('/adminPanel/panel-poszukiwane/{id}', [ZwierzetaController::class, 'editPoszukiwane']);
    Route::post('/adminPanel/panel-poszukiwane/{id}', [ZwierzetaController::class, 'savePoszukiwane']);

    Route::get('/adminPanel/add-wydarzenie', [WydarzeniaController::class, 'formWyd']);
    Route::post('/adminPanel/add-wydarzenie', [WydarzeniaController::class, 'addWydarzenie']);

    Route::get('/adminPanel/panel-wydarzenia', [WydarzeniaController::class, 'panelWydarzenia']);
    Route::get('/adminPanel/panel-wydarzenia/{id}', [WydarzeniaController::class, 'editWydarzenia']);
    Route::post('/adminPanel/panel-wydarzenia/{id}', [WydarzeniaController::class, 'saveWydarzenia']);
    Route::get('/adminPanel/panel-wydarzenia/{id}/{id_dog}', [WydarzeniaController::class, 'editDog']);

    Route::get('/adminPanel/add-wpis',  function(){return view('admin.wpisy.add-wpis');});
    Route::post('/adminPanel/add-wpis', [AktualnosciController::class, 'addWpis']);

    Route::get('/adminPanel/panel-wpisy', [AktualnosciController::class, 'panelWpisy']);
    Route::get('/adminPanel/panel-wpisy/{id}', [AktualnosciController::class, 'editWpisy']);
    Route::post('/adminPanel/panel-wpisy/{id}', [AktualnosciController::class, 'saveWpisy']);

    Route::get('/adminPanel/edit-site', [IndexController::class, 'editSite']);
    Route::post('/adminPanel/edit-site', [IndexController::class, 'saveSite']);


    Route::get('/logout',   [IndexController::class, 'logout']);

    Route::get('/adminPanel/statistics', [IndexController::class, 'stats']);

});
Route::get('/login',  function(){return view('admin.login');});
Route::post('/login',   [IndexController::class, 'adminLogin']);

Route::get('/', [IndexController::class, 'index']);
Route::post('/', [IndexController::class, 'addPosz']);

Route::get('/adopcja/{id}', [AdopcjaController::class, 'show']);
Route::get('/adopcja', [AdopcjaController::class, 'all']);

Route::get('/przybyle', [PrzybyleController::class, 'all']);
Route::get('/przybyle/{id}', [PrzybyleController::class, 'show']);

Route::get('/poszukiwane', [PoszukiwaneController::class, 'all']);
Route::get('/poszukiwane/{id}', [PoszukiwaneController::class, 'show']);

Route::get('/wydarzenia', [WydarzeniaController::class, 'all']);
Route::post('/wydarzenia', [WydarzeniaController::class, 'checkDog']);
Route::get('/wydarzenia/{id}', [WydarzeniaController::class, 'show']);
Route::get('/wydarzenia/{id}/{idDog}', [WydarzeniaController::class, 'showDog']);
Route::post('/wydarzenia/{id}/{idDog}', [WydarzeniaController::class, 'reserveDog']);

Route::get('/aktualnosci', [AktualnosciController::class, 'all']);
Route::get('/aktualnosci/{id}', [AktualnosciController::class, 'show']);

Route::get('/o-nas',  function(){return view('schronisko.o-nas');});
Route::get('/kontakt',  function(){return view('schronisko.kontakt');});
Route::get('/wsparcie',  function(){return view('schronisko.wsparcie');});
Route::get('/o-adopcji',  function(){return view('schronisko.o-adopcji');});