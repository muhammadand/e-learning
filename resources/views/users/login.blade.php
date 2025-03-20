<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KampusKompoter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-2xl p-10 flex flex-col md:flex-row items-center md:items-start space-y-8 md:space-y-0 md:space-x-10 w-full max-w-4xl">
        <div class="text-gray-800 md:w-1/2 text-center md:text-left">
            <h1 class="text-4xl font-extrabold text-blue-600">WELCOME</h1>
            <h2 class="text-lg font-semibold mt-2">To CV. Setya Mandiri Sejahtera</h2>
            <p class="text-gray-600 mt-4">Solusi terbaik untuk kebutuhan Anda dengan layanan profesional dan terpercaya.</p>
            <div class="mt-6 flex justify-center md:justify-start space-x-4">
                <i class="fab fa-facebook text-blue-700 text-2xl"></i>
                <i class="fab fa-twitter text-blue-500 text-2xl"></i>
                <i class="fab fa-instagram text-pink-600 text-2xl"></i>
            </div>
        </div>
        <div class="bg-gray-50 rounded-lg shadow-md p-8 w-full md:w-1/2">
            <h2 class="text-2xl font-bold text-center text-gray-700">Sign in</h2>
            
            @if(session('success'))
                <p class="text-green-600 text-sm text-center mt-2">{{ session('success') }}</p>
            @endif

            @if($errors->any())
                @foreach($errors->all() as $err)
                    <p class="text-red-600 text-sm text-center">{{ $err }}</p>
                @endforeach
            @endif
            
            <form action="{{ route('login') }}" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-600 font-medium">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-600 font-medium">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mb-4 flex items-center justify-between">
                    <label class="inline-flex items-center text-sm text-gray-600">
                        <input type="checkbox" class="form-checkbox text-blue-600"> Remember me
                    </label>
                    <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full focus:outline-none focus:shadow-outline" type="submit">
                    Sign in
                </button>
            </form>
            <p class="text-gray-600 text-sm text-center mt-4">Don't have an account? <a href="#" class="text-blue-600 hover:underline">Sign up</a></p>
        </div>
    </div>
</body>
</html>