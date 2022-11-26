<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Posts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title, $content, $featured_image;

    protected $rules = [
            'title' => 'required|min:10,max:20',
            'content' => 'required', 
            'featured_image' => 'image'    // validates image formats EG png, jpg, gif etc ... 
        ];
        
    public function save()
    {
        $data = [
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->user()->id,
            'featured_image' => $this->featured_image->hashName(),
        ];

        // dd($data['featured_image']);
        // dd($this->featured_image);
        
        $this->validate();

        if (!empty($this->featured_image)) {
            $this->featured_image->store('public/images');
        }

        Post::create($data);

        $this->clearVars();
    }

    public function delete($postId)
    {
        Post::destroy($postId);
    }

    private function clearVars()
    {
        $this->title = null;
        $this->content = null;
    }

    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::where('user_id', '=', auth()->user()->id)->paginate(3),
        ]);
    }
}
