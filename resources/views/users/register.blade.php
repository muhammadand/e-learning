<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register -  CV. SETYA MANDIRI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-blue-600 rounded-lg shadow-lg p-8 flex flex-col md:flex-row items-center md:items-start space-y-8 md:space-y-0 md:space-x-8">
        <div class="text-white md:w-1/2">
            <h1 class="text-4xl font-bold mb-4">WELCOME</h1>
            <h2 class="text-xl mb-4">CREATE YOUR ACCOUNT</h2>
            <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-8 md:w-1/2">
            <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>
            <form action="{{ route('register.action') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                            <i class="fas fa-eye cursor-pointer"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                    <input type="password" name="password_confirm" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                    <select name="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="owner">Owner</option>
                        <option value="admin">Admin</option>
                        <option value="karyawan">Karyawan</option>
                    </select>
                </div>
                <div class="mb-4">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full focus:outline-none focus:shadow-outline" type="submit">Register</button>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-700">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Sign in</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
