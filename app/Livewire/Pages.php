<?php

namespace App\Livewire;
use App\Models\Page;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\Component;

class Pages extends Component
{

    public $slug;
    public $title;
    public $content;
    public $modalVisible = false;
    
 

    
    /**
     * function for validation
     *
     * @return void
     */
    public function rules(){
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')],
            'content' => 'required',
        ];
    }


    
    /**
     * melakukan input secara otomatis terhadap slug sesuai dengan title
     * lalu regex menjadi str tanpa spasi dan kapital
     * @return void
     */
    public function updateSlug(){
        $this->slug = Str::slug($this->title);
    }
    


   /**
     * function create to DB
     *
     * @return void
     */
    
    public function create(){
        $this->validate();
        Page::create($this->dataModel());
        $this->modalVisible = false;
        $this->clearValue();
    }

    /**
     * this is data from Page Model
     * used for mapping
     *
     * @return void
     */
    public function dataModel(){
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }
    
    /**
     * this will reset input of the livewire 
     *
     * @return void
     */
    public function clearValue(){
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }


    // modal set up
    public function closeCreateModal(){
        
         $this->modalVisible = false;
    }

    
    /**
     * show the form modal
     * of the create func
     *
     * @return void
     */
    public function showCreateModal(){
        $this->modalVisible = true;
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
