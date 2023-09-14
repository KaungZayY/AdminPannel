@extends('layout')

@section('content')
<div class="w-full px-4 py-2 bg-gray-200 lg:w-full">
    <div class="bg-your-color font-semibold">category -&gt; category list</div>
    <h1 class="text-3xl font-bold">Category List</h1>
    <div class="container mx-auto mt-2">
        <div id="messageContainer">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg">{{ session('success') }}</div>            
            @elseif(session('error'))
                <div class="bg-red-500 text-white p-4 rounded-lg">{{ session('error') }}</div>
            @endif
        </div>
        <script>
            // Wait for the document to be fully loaded
            document.addEventListener('DOMContentLoaded', function() {
                // Select the message container element by its ID
                var messageContainer = document.getElementById('messageContainer');
                
                // Check if the message container exists
                if (messageContainer) {
                    // Automatically hide the message container after 5 seconds (5000 milliseconds)
                    setTimeout(function() {
                        messageContainer.style.display = 'none'; // Hide the element
                    }, 5000); // 5000 milliseconds = 5 seconds
                }
            });
        </script>
                
        <div class="flex justify-end">
            <form action="{{route('category.add.create')}}" method="GET">
                @csrf
                <button type="submit" class="bg-indigo-600 hover:shadow hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                    + Add New Category
                </button>
            </form>
        </div>
        @if ($categories->count())
        <div class="flex flex-col mt-2">
            <div class="flex items-center space-x-4">
                <span>Show:</span>
                <select id="rowsPerPage" class="border rounded px-2 py-1 bg-blue-200">
                    <option value="5">5 rows</option>
                    <option value="10">10 rows</option>
                </select>
            </div>
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 mt-2">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Action</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Category</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Publish</th>
                                
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                        @foreach ($categories as $category)
                            <tr>
                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    <form action="{{route('category.edit',$category)}}">
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </form>
                                
                                    <form action="{{route('category.delete',$category)}}" method="POST">
                                        @csrf
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">
                                        {{$category->id}}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">{{$category->category}}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    @if ($category->status==1)
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                        Inactive
                                    </span>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="flex flex-col mt-8">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <p class="text-lg">No Categories Uploaded, Add new One</p>
                </div>
            </div>
        </div>
        @endif
        
    </div>
</div>
@endsection