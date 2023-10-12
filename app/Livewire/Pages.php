<?php

namespace App\Livewire;
use App\Models\Page;
use Livewire\Component;

class Pages extends Component
{
    public $slug;
    public $title;
    public $content;

    // modal set up
    public $modalVisible = false;
    
    /**
     * show the form modal
     * of the create func
     *
     * @return void
     */
    public function showCreateModal(){
        $this-> modalVisible = true;
    }


    
    /**
     * livewire render func
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages');
    }
}
