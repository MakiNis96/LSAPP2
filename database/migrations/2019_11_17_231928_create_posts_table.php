<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // php artisan make:model Post -m -ovim kreiramo i model i migraciju, za kontrolera nema migracije
    // migraciju izvrsavamo naredbom: php artisan migrate
    public function up()  //taj kod se izvrsava kada izvrsimo migraciju
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');  //kreirace se tabela sa poljem id- koje je primary key
            $table->string('title');   //dodavanje novog polja
            $table->mediumText('body'); //vece od string
            $table->timestamps();  // i dva polja created at i updated at
        });
    }
// u bazi insertujemo preko terminala (tinker aplikacije): php artisan tinker
// App\Post::count() - vraca 0
// $post = new App\Post(); - pravimo instancu u memoriju i dodeljujemo je promenljivoj
// $post->title = 'Post one'; - dodajemo polja
// $post->body = 'This is the post body';
// $post->save(); -ovim to sacuvamo u bazu, vraca true
// isto ovo ponavljamo i za insertovanje jos jedne vrste u tabeli posts (od new pa nadalje)
// za izlazenje: clear
// quit
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()   //izvrsava se kada roll backujemo migraciju
    {
        Schema::dropIfExists('posts'); //brisemo celu tabelu
    }
}
