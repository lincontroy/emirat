<!-- resources/views/layouts/auth.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- ✅ Important for mobile -->
    <title>{{ config('app.name') }} - Auth</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        @yield('content')
    </div>

</body>
</html>

