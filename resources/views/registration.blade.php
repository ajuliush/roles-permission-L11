<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center h-screen bg-gray-900">
    <main class="h-screen w-screen flex items-center justify-center mt-0" role="main">
        <div class="h-full w-full flex items-center justify-center">
            <span class="h-auto w-full max-w-md flex flex-col items-center justify-center gap-6 overflow-hidden rounded-lg bg-gray-800 p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-white/70 hover:ring-white/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:p-10 lg:pb-10 dark:bg-gray-800 dark:ring-gray-700 dark:hover:text-white/70 dark:hover:ring-gray-600 dark:focus-visible:ring-[#FF2D20]" tabindex="0" aria-label="Interactive content" role="region">
                <form class="w-full max-w-md" action="{{ url('registration') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <h2 class="text-2xl font-bold mb-6 text-center text-white">Register</h2>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                        <input type="text" id="name" name="name" value=" {{ old('name') }}" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-blue-500 @error('name') border-red-500 @enderror">
                        @error('name')
                        <div class=" text-red-500 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                        <input type="email" id="email" name="email" value=" {{ old('email') }}" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-blue-500 @error('email') border-red-500 @enderror">
                        @error('email')
                        <div class=" text-red-500 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-blue-500 @error('password') border-red-500 @enderror">
                        @error('password')
                        <div class=" text-red-500 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-blue-500 @error('password') border-red-500 @enderror">
                        @error('password_confirmation')
                        <div class=" text-red-500 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300">Register</button>
                </form>
            </span>
        </div>
    </main>
</body>
</html>
