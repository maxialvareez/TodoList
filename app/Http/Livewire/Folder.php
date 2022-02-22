<?php

namespace App\Http\Livewire;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class Folder extends Todolist
{

    public $folderid;

    public function mount($folderid){
        $this->folderid = $folderid;
    }

    public function storeItem(){

        Item::create(array(
            'data' => $this->data,
            'done' => false,
            'user_id' => Auth::id(),
            'folder_id' => $this->folderid
        ));

        $this->data = null;

    }

    public function render()
    {
        $this->folders = \App\Models\Folder::where('user_id', Auth::id())->get();
        $this->items = Item::where('folder_id', $this->folderid)->get();
        return view('livewire.folder');
    }
}
