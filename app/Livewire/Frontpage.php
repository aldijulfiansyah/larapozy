<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class Frontpage extends Component
{
    public $title;
    public $urlslug;
    public $content;

    public function mount($urlslug){
        $this->retrieveContent($urlslug);
    }
    
    /**
     * menmberi kembali isian page
     *
     * @param  mixed $urlslug
     * @return void
     */
    public function retrieveContent($urlslug){
        $data = Page::where('slug', $urlslug)->first();
        $this->title = $data->title;
        $this->content = $data->content;
    }

    public function render()
    {
        return view('livewire.frontpage')->layout('layouts.frontpage');
    }
}
