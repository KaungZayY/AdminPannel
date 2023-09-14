@extends('layout')

@section('content')
<div class="container mx-left max-w-md p-6">
    <h1 class="text-2xl font-semibold">Category Registration</h1>
    <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data" class="mt-4">
        @csrf

        <div class="mb-4 mt-10">
            <label for="category" class="block text-sm font-medium text-gray-700">Category Name</label>
            <input type="text" name="category" id="category" class="mt-1 p-2 w-full rounded border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" required>
        </div>
        
        <div class="mb-4 mt-10 relative">
            <label for="category_photo" class="block text-sm font-medium text-gray-700">Category Photo</label>
            <!-- Hidden file input -->
            <input type="file" name="category_photo" id="category_photo" class="hidden" accept="image/*">
            <div id="dropZone" class="w-full h-32 border border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer">
                <span class="text-gray-600">Drag and drop your files here</span>
                <span class="text-blue-500">- or -</span>
                <span class="text-white bg-indigo-600 py-1 px-2 rounded-full">Choose your file</span>
            </div>
            <!-- Display the selected file name -->
            <div id="file-name" class="mt-2 text-gray-700"></div>
        </div>
        
        <script>
            // JavaScript to handle file input when the label is clicked
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('category_photo');
            const fileNameDisplay = document.getElementById('file-name');
        
            // Trigger file input when the drop zone is clicked
            dropZone.addEventListener('click', () => {
                fileInput.click();
            });
        
            // Handle file selection via drag and drop
            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('border-blue-500'); // Highlight the drop zone
            });
        
            dropZone.addEventListener('dragleave', () => {
                dropZone.classList.remove('border-blue-500'); // Remove highlight on drag leave
            });
        
            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('border-blue-500'); // Remove highlight on drop
                const files = e.dataTransfer.files;
        
                // Assign the selected files to the file input
                fileInput.files = files;
        
                // Display the selected file name
                if (files.length > 0) {
                    fileNameDisplay.textContent = files[0].name;
                }
            });
        
            // Update file name when a file is selected
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    fileNameDisplay.textContent = fileInput.files[0].name;
                }
            });
        </script>
        
        
        
        
        
        <div class="mb-4 mt-10">
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <div class="mt-2 space-y-2">
                <label for="status_active" class="inline-flex items-center">
                    <input type="checkbox" name="status" id="status_active" class="form-checkbox text-blue-600 focus:ring focus:ring-blue-200" value="1">
                    <span class="ml-2">Publish</span>
                </label>
            </div>
        </div>

        <div class="mt-4 mt-10">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
            <a href="{{ route('category') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection






