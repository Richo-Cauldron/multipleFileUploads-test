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

    public $title, $content, $featuredImage;

    protected $rules = [
            'title' => 'required|min:10,max:20',
            'content' => 'required', 
            'featuredImage' => 'image'    // validates image formats EG png, jpg, gif etc ... 
        ];
        
    public function save()
    {
        // dd($this->featuredImage);
        $data = [
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->user()->id,
            'featuredImage' => $this->featuredImage->hashName(),
        ];
        
        $this->validate();

       
        $filename = $this->featuredImage->store('images');
      
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->user()->id,
            'featured_image' => $filename,
        ]);

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

    public function updatedFeaturedImage()
    {
        // $this->validate(['featuredImage' => 'image|max:10']);
    }

    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::where('user_id', '=', auth()->user()->id)->paginate(3),
        ]);
    }
}
