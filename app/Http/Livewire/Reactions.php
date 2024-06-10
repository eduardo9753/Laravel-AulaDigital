<?php

namespace App\Http\Livewire;

use App\Models\Reaction;
use Livewire\Component;

class Reactions extends Component
{
    public $postId;
    public $likes;
    public $dislikes;

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->loadReactions();
    }

    public function loadReactions()
    {
        $this->likes = Reaction::where('reactionable_id', $this->postId)
            ->where('reactionable_type', 'App\Models\Post')
            ->where('value', '1')
            ->count();  //cuenta los like 

        $this->dislikes = Reaction::where('reactionable_id', $this->postId)
            ->where('reactionable_type', 'App\Models\Post')
            ->where('value', '2')
            ->count(); //cuenta los dislike
    }

    public function like()
    {
        $this->react(1);
    }

    public function dislike()
    {
        $this->react(2);
    }

    private function react($value)
    {
        Reaction::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'reactionable_id' => $this->postId,
                'reactionable_type' => 'App\Models\Post',
            ],
            [
                'value' => $value
            ]
        );

        $this->loadReactions();
    }

    public function render()
    {
        return view('livewire.reactions');
    }
}
