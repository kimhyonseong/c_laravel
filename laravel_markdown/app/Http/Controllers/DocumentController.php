<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function show($file= null){
        $index = \Cache::remember('document.index',120,function (){
            return mark_down($this->document->get());
        });
        $content = \Cache::remember("document.{$file}",120,function () use ($file){
            return mark_down($this->document->get($file));
        });
        return view('document.index',compact('index','content'));
    }
}
