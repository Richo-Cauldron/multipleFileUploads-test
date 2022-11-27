<div>
    <x-input-label>Featured Image</x-input-label>
    <input wire:model="featuredImage" type="file" class=" shadow border-gray-300 focus:border-blue-300  focus:ring-blue-200 focus:ring-opacity-50 focus:ring-1"/>
    <br>
    @error('featuredImage') <span class="error text-red-500">*{{ $message }}</span> @enderror
    <x-input-label>Title</x-input-label>
    <input wire:model="title" type="text" class="w-full indent-6 rounded-md shadow border-gray-300 focus:border-blue-300  focus:ring-blue-200 focus:ring-opacity-50 focus:ring-1 " />
    @error('title') <span class="error text-red-500">*{{ $message }}</span> @enderror
    <x-input-label>Content</x-input-label>
    <textarea wire:model="content" type="text" class="w-full indent-6 rounded-md shadow border-gray-300 focus:border-blue-300  focus:ring-blue-200 focus:ring-opacity-50 focus:ring-1 "></textarea>
    @error('content') <span class="error text-red-500">*{{ $message }}</span> @enderror
    <br>
    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none  dark:focus:ring-blue-800" wire:click="save">Save</button>

    @if ($posts->count())
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead class="bg-white border-b">
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Image</th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Title</th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Content</th>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="border-b border-gray-300 odd:bg-gray-200">
                        <td>
                            @if (!empty($post->featured_image))
                                <img width="80px" src="{{ url('images/' . $post->featured_image) }}" alt="" />
                            @else
                                No image available
                            @endif
                        </td>
                        <td class="py-2 px-2">{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td class="text-right"><button wire:click="delete({{ $post->id }})" class="text-white bg-red-700 hover:bg-red-800 focus:ring-2 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-2 mb-dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none  dark:focus:ring-red-800 mr-5
                            ">Delete</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $posts->links() }}
        </div>
        
    @endif
</div>
