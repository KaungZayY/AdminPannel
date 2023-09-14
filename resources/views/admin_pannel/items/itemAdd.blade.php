@extends('layout')

@section('content')
<div class="container mx-left max-w-md p-6">
    <h1 class="text-2xl font-semibold">Item Information</h1>
    <form method="POST" action="{{route('item.store')}}" enctype="multipart/form-data" class="mt-4" id="myForm">
        @csrf
        <div class="mb-4 mt-10">
            <label for="item_name" class="block text-sm font-medium text-gray-700">Item Name</label>
            <input type="text" name="item_name" id="item_name" class="mt-1 p-2 w-full rounded border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4 mt-10">
            <label for="category" class="block text-sm font-medium text-gray-700">Select Category</label>
            <select id="category" name="category" class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4 mt-10">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="text" name="price" id="price" class="mt-1 p-2 w-full rounded border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4 mt-10">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="txt-description" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"></textarea>
        </div>
        <div class="mb-4 mt-10">
            <label for="item_condition" class="block text-sm font-medium text-gray-700">Select Item Condition</label>
            <select id="item_condition" name="item_condition" class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
                <option value="New">New</option>
                <option value="Good">Used</option>
                <option value="Good Second">Good Second</option>
            </select>
        </div>
        <div class="mb-4 mt-10">
            <label for="item_type" class="block text-sm font-medium text-gray-700">Select Item Type</label>
            <select id="item_type" name="item_type" class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
                <option value="Sell">Sell</option>
                <option value="Buy">Buy</option>
                <option value="Trade">Trade</option>
            </select>
        </div>
        <div class="mb-4 mt-10">
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <div class="mt-2 space-y-2">
                <label for="status_active" class="inline-flex items-center">
                    <input type="checkbox" name="status" id="status_active" class="form-checkbox text-blue-600 focus:ring focus:ring-blue-200" value="1">
                    <span class="ml-2">Publish</span>
                </label>
            </div>
        </div>
        <div class="mb-4 mt-10 relative">
            <label for="item_photo" class="block text-sm font-medium text-gray-700">Category Photo</label>
            <!-- Hidden file input -->
            <input type="file" name="item_photo" id="item_photo" class="hidden" accept="image/*">
            <div id="dropZone" class="w-full h-32 border border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer">
                <span class="text-gray-600">Drag and drop your files here</span>
                <span class="text-blue-500">- or -</span>
                <span class="text-white bg-indigo-600 py-1 px-2 rounded-full">Choose your file</span>
            </div>
            <!-- Display the selected file name -->
            <div id="file-name" class="mt-2 text-gray-700"></div>
        </div>
</div>

<div class="container mx-left max-w-md p-6">
    <h1 class="text-2xl font-semibold">User Information</h1>
    
        <div class="mb-4 mt-10">
            <label for="user_name" class="block text-sm font-medium text-gray-700">User Name</label>
            <input type="text" name="user_name" id="user_name" class="mt-1 p-2 w-full rounded border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4 mt-10">
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
            <input type="hidden" name="phone_number" id="hidden_phone_number">
            <input type="text" name="phone_number" id="phone_number" class="mt-1 p-2 w-full rounded border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4 mt-10">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" name="address" id="locationInput" class="mt-1 p-2 w-full rounded border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4 mt-10" id="map" style="height: 400px;">
            
        </div>
        <div class="mt-4 mt-10">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
            <a href="{{ route('item') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // JavaScript to handle file input when the label is clicked
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('item_photo');
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

<script>
    ClassicEditor
        .create( document.querySelector( '#txt-description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

<script>
    var map = L.map('map').setView([16.8661, 96.1951], 13); // Set the initial view to Yangon, Myanmar

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    var marker = L.marker([16.8661, 96.1951], {
        draggable: true
    }).addTo(map);

    marker.bindPopup('A sample marker on the map.').openPopup();

    marker.on('dragend', function (event) {
        var markerLatLng = marker.getLatLng();
        document.getElementById('locationInput').value = markerLatLng.lat + ', ' + markerLatLng.lng;
    });
</script>

{{-- <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
  const input = document.querySelector("#phone_number");
  window.intlTelInput(input, {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
  });
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
    const input = document.querySelector("#phone_number");
    const hiddenInput = document.querySelector("#hidden_phone_number");
  
    const iti = window.intlTelInput(input, {
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
      hiddenInput: "full", // or "e164" if you want the E.164 format
    });
  
    // Listen for form submission
    const form = document.querySelector("#myForm");
    form.addEventListener("submit", function (event) {
      // Prevent the default form submission
      event.preventDefault();
  
      // Get the full international number using getNumber
      const fullNumber = iti.getNumber();
  
      // Populate the hidden input field with the full number
      hiddenInput.value = fullNumber;
  
      // Now you can submit the form
      form.submit();
    });
  </script>
  

@endsection






