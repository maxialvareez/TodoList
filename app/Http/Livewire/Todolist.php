<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;


class Todolist extends Component
{
    public $data;
    public $item;
    public $openModal = false;
    public $openModalFolder = false;
    public $openModalShowFolder = false;
    public $idTask;
    public $done;
    public $name;
    public $folder;
    public $expand;

    public function storeItem(){

        if($this->folder == 0)
            Item::create(array(
                'data' => $this->data,
                'done' => false,
                'user_id' => Auth::id(),
                'folder_id' => null
            ));
        else {
            Item::create(array(
                'data' => $this->data,
                'done' => false,
                'user_id' => Auth::id(),
                'folder_id' => $this->folder
            ));
        }
        $this->data = null;

    }

    public function storeFolder(){

        Folder::create(array(
            'name' => $this->name,
            'user_id' => Auth::id()
        ));

        $this->name = null;
        $this->openModalFolder = false;

    }

    public function done($id){

        $item = Item::findOrFail($id);

        if($item->done == true)
            $item->update(['done' => false]);
        else {
            $item->update(['done' => true]);
        }
    }

    public function openModal($item){
        $this->item = $item;
        $this->idTask = $item['id'];
        $this->openModal = true;
    }

    public function openModalFolder(){
        $this->openModalFolder = true;
    }

    public function edit(){
        $item = Item::findOrFail($this->idTask);
    
        $item->update(['data' => $this->data]);

        $this->openModal = false;
        $this->data = null;
        
    }

    public function deleteItem($id){

        Item::where('id', $id)->delete();
        
    }
    
    public function deleteFolder($id){

        Folder::where('id', $id)->delete();
        
    }

    public function render()
    {
        $this->items = Item::where('user_id', Auth::id())->get();
        $this->folders = Folder::where('user_id', Auth::id())->get();
        return view('livewire.todolist');
    }
}
