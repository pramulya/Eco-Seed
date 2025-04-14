<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco-Seed</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-6xl mx-auto flex bg-white shadow-xl rounded-lg overflow-hidden">
        
        <div class="w-1/2 bg-white flex flex-col items-center justify-center p-10">
            <img src="{{ asset('images/eco-seed.png') }}" alt="Eco-Seed" class="w-48 mb-4">
        </div>

        
        <div class="w-1/2 bg-gray-200 flex items-center justify-center p-10">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
