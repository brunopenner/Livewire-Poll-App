<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = ['First'];

    protected $rules = [
        'title'     => 'required|min:3|max:255',
        'options'   => 'required|array|min:1|max:10',
        'options.*' => 'required|min:1|max:255'
    ];

    protected $messages = [
        'options.*' => "The option can't be empty"
    ];

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.create-poll');
    }

    //This will basically add a new element to options
    //this is how to add a value at the end of the array
    public function addOption() {
        $this->options[] ='';
    }

    public function removeOption($index) {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    // action for form submission, it is called within the form in create-poll.blade.php
    public function createPoll() {

        $this->validate();

        //The following commented out code was replace by the refactored code below, which does not need the $pool variable
        // $poll = Poll::create([
        //     'title' => $this->title
        // ]);

        // foreach($this->options as $optionName) {
        //     $poll->options()->create(['name' => $optionName]);
        // }

        Poll::create([
            'title' => $this->title
        ])->options()->createMany(
                collect($this->options)
                    ->map(fn ($option) => ['name' => $option])
                    ->all()
        );

        $this->reset(['title', 'options']);

        $this->emit('pollCreated');
    }

    //This is another way to initialise the options array
    // public function mount() {

    // }
}
