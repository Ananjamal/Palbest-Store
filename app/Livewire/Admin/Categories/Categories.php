<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $category_id;

    public $searchTerm;
    // protected $listeners = [
    //     'search' => 'search',
    //     'flash' => 'flash',
    //     'refreshPage' => 'refresh',
    // ];
    #[On('successflash')]
    public function successflash($message)
    {
        session()->flash('message', $message);
    }
    #[On('errorflash')]
    public function errorflash($message)
    {
        session()->flash('error', $message);
    }
    #[On('refreshPage')]
    public function refresh(){
        $this->category_id = null;
    }
    #[On('search')]
    public function search($message)
    {
        $this->searchTerm = $message;
    }
    public function deleteCategory($id){
        $this->category_id = $id;
    }
    public function editCategory($id){
        $this->category_id = $id;
    }
    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->searchTerm . '%')->paginate(10);
        return view('livewire.admin.categories.categories', [
            'categories' => $categories,
        ])->layout('layout.admin.app');
    }
}
