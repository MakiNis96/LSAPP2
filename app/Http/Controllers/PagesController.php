<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //ovako dodajemo fju u kontroleru
    public function index(){
        //return 'INDEX';
        //return view('pages.index'); //funkcija kontrolera vraca view
        //prosledjivanje parametra view-u 
        $title = "Welcome to Laravel";
        //return view('pages.index', compact('title'));  //nacin za prosledjivanje jedne vrednosti
        return view('pages.index')->with('title',$title); //drugi nacin za prosledjivanje veceg broja vrednosti
        //u view samo pristupamo na sledeci nacin: {{$title}}
    }

    public function about(){
        $title = 'About';
        return view('pages.about')->with('title',$title);
    }
    public function services(){ //prosledjivanje veceg broja parametara u vidu niza
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }

}
