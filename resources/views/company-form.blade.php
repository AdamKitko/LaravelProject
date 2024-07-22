<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Company</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 font-sans">
<div class="container mx-auto max-w-lg py-4 px-4">
    <h1 class="text-2xl font-bold mb-4">Create a New Company</h1>
    <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data" class="space-y-4" id="companyForm">
        @csrf
        <div class="flex flex-col">
            <label for="name" class="text-gray-700 font-medium mb-1">Company Name</label>
            <input type="text" name="name" id="name" class="shadow-sm p-2 rounded-md border focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" required>
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="city" class="text-gray-700 font-medium mb-1">City</label>
            <input type="text" name="city" id="city" class="shadow-sm p-2 rounded-md border focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('city') border-red-500 @enderror" required>
            @error('city')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="address" class="text-gray-700 font-medium mb-1">Address</label>
            <input type="text" name="address" id="address" class="shadow-sm p-2 rounded-md border focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('address') border-red-500 @enderror" required>
            @error('address')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="image" class="text-gray-700 font-medium mb-1">Image URL</label>
            <input type="text" name="image" id="image" class="shadow-sm p-2 rounded-md border focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('image') border-red-500 @enderror" required>
            @error('image')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="description" class="text-gray-700 font-medium mb-1">Description</label>
            <textarea name="description" id="description" class="shadow-sm p-2 rounded-md border focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror" required></textarea>
            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create</button>
    </form>
</div>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('companyForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        let address = document.getElementById('address').value;
        let city = document.getElementById('city').value;
        let fullAddress = `${address}, ${city}`;

        axios.get(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(fullAddress)}`)
            .then(function(response) {
                if (response.data.length > 0) {
                    let latitude = response.data[0].lat;
                    let longitude = response.data[0].lon;

                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;

                    document.getElementById('companyForm').submit();
                } else {
                    alert('Geocoding failed: Address not found.');
                }
            })
            .catch(function(error) {
                console.error('Geocoding error:', error);
                alert('Geocoding failed: Unable to process the address.');
            });
    });
</script>
</body>
</html>
