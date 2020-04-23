<?php
use App\Dosen;
use App\Mahasiswa;
use App\Matakuliah;
// use App\Jadwal;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
    Route::get('/read', function(){
        // $dosens = App\Dosen::all();

        $dosens = App\Dosen::where('status',1)
                ->orderBy('nama','asc')
                ->get();
        foreach ($dosens as $dosen) {
            echo $dosen->nama."<br/>";
        }
    });

    Route::get('/find', function(){
        $dosen = Dosen::find('333');

        echo $dosen->nama;
    });

    Route::get('/insert',function(){
        // $dosen = new Dosen;

        // $dosen->nidn = '444';
        // $dosen->nama = 'albert';

        // $dosen->save();
        Dosen::create(['nidn'=>'333','nama'=>'ahe','keterangan'=>'Aktif']);
    });

    Route::get('/update', function(){
        // $dosen = Dosen::find('333');

        // $dosen->nama =  'SiKetiga';
        // $dosen->save();
        Dosen::where('status', 1)
            ->update(['keterangan'=> 'Aktif Euy']);
    });

    Route::get('/delete',function(){
        // $dosen = Dosen::find('555');
        // $dosen->delete();
        Dosen::destroy('222');
        // Dosen::where('status',0)->delete();
    });

    Route::get('/trash',function(){
        $dosens = Dosen::onlyTrashed()->get();

        foreach ($dosens as $dosen) {
            echo $dosen->nama."<br/>";
        } 
    });

    Route::get('/restore',function(){
        $dosens = Dosen::onlyTrashed()
        // ->where('nidn','444')
        ->restore();
    });

    Route::get('/forcedelete',function(){
        $dosens = Dosen::onlyTrashed()
        ->where('nidn','222')
        ->forceDelete();
    });

    //Eloquent Relationship
    //One to one
    Route::get('dosen/mhs/{nidn}', function ($nidn) {
        return Dosen::find($nidn)->nama;
    });
    //One to one Inverse
    Route::get('mhs/dosen/{npm}', function($npm) {
        return Mahasiswa::find($npm)->dosen->nama.'</br>';
    });
    //One to Many
    Route::get('dosen/allmhs/{nidn}', function ($nidn) {
        // return Dosen::find($nidn)->allmhs;
        $mhs = Dosen::find($nidn)->allmhs;
        foreach ($mhs as $mahasiswa) {
            echo $mahasiswa->nama."<br/>";
        }
    });
    //Many to Many
    Route::get('dosen/matkul/{nidn}', function ($nidn) {
        return Dosen::find($nidn)->matkul;
    });
    //Many to Many Inverse
    Route::get('matkul/dosen/{kode_matkul}', function ($kode_matkul) {
        return Matakuliah::find($kode_matkul)->dosens;
    });