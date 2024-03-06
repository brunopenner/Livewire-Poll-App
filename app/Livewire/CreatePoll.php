<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = ['First'];

    public function render()
    {
        return view('livewire.create-poll');
    }

    //This will basically add a new element to options
    //this is how to add a value at the end of the array
    public function addOption() {
        $this->options[] ='';
    }

    //This is another way to initialise the options array
    // public function mount() {

    // }
}
