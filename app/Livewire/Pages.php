<?php

namespace App\Livewire;
use App\Models\Page;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
class Pages extends Component
{
    use WithPagination;
    public $slug;
    public $title;
    public $content;
    public $modalVisible = false;
    public $dataId;
    
 

    
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
     * function read from DB and paginate
     *
     * @return void
     */
    public function read(){
        return Page::paginate(5);
    }

    


    /**
     * func for show update modal
     *
     * @param  mixed $id
     * @return void
     */
    public function updateModal($id){
        $this->resetValidation();
        $this->clearValue();
        $this->dataId = $id;
        $this->modalVisible = true;
        $this->loadData();
    }


    
    public function update(){
        $this->validate();
        Page::find($this->dataId)->update($this->dataModel());
        $this->modalVisible = false;
    }


    /**
     * loadData in modal by id
     *
     * @return void
     */
    public function loadData(){
        $data = Page::find($this->dataId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
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
        $this->dataId = null;
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }


    
    /**
     * show the form modal
     * of the create func
     *
     * @return void
     */
    public function showCreateModal(){
        $this->resetValidation();
        $this->clearValue();
        $this->modalVisible = true;
    }


    
    /**
     * livewire render func
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages',[
            'PageData' => $this->read(),
        ]);
    }
}
