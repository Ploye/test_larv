<?php
use App\Dosen;
use App\Mahasiswa;
use App\Matakuliah;
use App\Post;
use App\Video;
use App\Comment;
use App\Tag;
// use App\Taggable;
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
    //Has one Through
    Route::get('dosen/krs/{nidn}', function ($nidn) {
        return Dosen::find($nidn)->oneKrs;
    });
     //Has Many Through
     Route::get('dosen/manykrs/{nidn}', function ($nidn) {
        // return Dosen::find($nidn)->manyKrs;
        $krs = Dosen::find($nidn)->manyKrs->where('npm','101');
        foreach ($krs as $mhs) {
            echo $mhs->npm.' - '.$mhs->kode_matakuliah.'</br>';
        }
    });
    //Polymorphic
    //One to One
    Route::get('post/{id}/comment', function ($id) {
        return Post::find($id)->comment;
    });
    Route::get('video/{id}/comment', function ($id) {
        return Video::find($id)->comment;
    });
    //One To Many 
    Route::get('post/{id}/comments', function ($id) {
        return Post::find($id)->comments;
    });
    Route::get('video/{id}/comments', function ($id) {
        $parentPosts = Video::find($id);

        echo $parentPosts->title;
        echo "</br> Komentar: </br>";

        $videos = $parentPosts->comments;
        foreach ($videos as $video) {
            echo ' - '.$video->content.'<br/>';
        }
    });
    //Many to Many
    Route::get('tags/{id}/post', function ($id) {
        return Post::find($id)->tags;
    });
    Route::get('tags/{id}/video', function ($id) {
        return Video::find($id)->tags;
    });
    //INSERT
    Route::get('video/{id}/post_comment', function ($id) {
        $comment = new comment([
            'content' => 'ini adalah komentar...  '
        ]);
        $video = Video::find($id);

        $video->comments()->save($comment);
    });
    //UPDATE
    Route::get('video/{id}/update_comment', function ($id) {
        $comment = Comment::find($id);

        $comment->content = 'Update Komentar';
        $comment->save();
    });
    //DELETE
    Route::get('video/{id}/delete_comment', function ($id) {
        $comment = Comment::find($id);
       
        $comment->delete();
    });
    //Many to Many
    //INSERT
    Route::get('video/create', function () {
       $video = Video::create([
            'title' => 'Video Ketiga',
            'path' => 'Video_3.mp4'
       ]);
       $tag = Tag::find(2);
       $video->tags()->save($tag);
    });
    //-TUGAS-//
    //UPDATE
    Route::get('video/{video}/tag/{untag}/change/{tag}', function ($video, $untag, $tag) {
        $video = Video::find($video);

        $video->tags()->detach($untag);
        $video->tags()->attach($tag);
    });
    //DELETE
    Route::get('video/{video}/untag/{tag}', function ($video, $tag) {
        $video = Video::find($video);

        $video->tags()->detach($tag);
    });
    