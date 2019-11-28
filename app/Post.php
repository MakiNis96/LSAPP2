<?php
// model kreiran naredbom php artisan make:model Post -m  
// -m znaci da ce nam kreirati i tabelu za taj model
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // po defaultu ime tabele je posts
    protected $table = 'posts';  // na ovaj nacin mozemo da promenimo defaultno ime tabele, ovo cemo da stavimo zbog referenciranja
    // na ovaj nacin mozemo da promenimo primarni kljuc
    public $primaryKey = 'id';
    public $timestamps = true; //po defaultu je true, to znaci da cemo imati created_at i updated_at, to mozemo i da zabranimo postavljanjem na false
    
    //dodajemo vezu - jedan post ima jednog usera (pripada jendom useru)
    public function user(){
        return $this->belongsTo('App\User');
    }
}
