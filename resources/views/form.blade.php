<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tailwind Contact Form</title>
        <style>
            body {
                background-color: #1a202c;
                color: #e2e8f0;
            }

            .form-container {
                animation: fadeIn 0.5s ease forwards;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="flex items-center justify-center h-screen">
        <div class="max-w-lg mx-auto p-6 bg-gray-800 rounded-md shadow-md form-container">
            <h2 class="text-2xl font-semibold text-white mb-6">{{$form->name}}</h2>
            <p class="text-gray-300 mb-6">{{$form->description}}</p>
            <form action="{{route('forms.store', $form)}}" method="POST" autocomplete="new-password">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-300 text-sm font-bold mb-2">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="john@example.com" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 bg-gray-700 text-white"
                        autocomplete="new-password">
                </div>
                @error('email')
                <p class="text-red-500 text-xs italic mb-4">{{ $message }}</p>
                @enderror

                @foreach ($form->fields as $field => $type)
                @if($type == 'text' || $type == 'password')
                <div class="mb-4">
                    <label for="{{$field}}" class="block text-gray-300 text-sm font-bold mb-2">{{$field}}</label>
                    <input type="{{$type}}" id="{{$field}}" name="{{$field}}" placeholder="{{$field}}"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 bg-gray-700 text-white"
                        autocomplete="new-password">
                </div>
                @elseif($type== 'checkbox')
                <div class="mb-4 flex items-center gap-2">
                    <label for="{{$field}}" class="block text-gray-300  font-bold ">{{$field}}</label>
                    <input type="checkbox" id="{{$field}}" name="{{$field}}"
                        class="w-5 h-5 rounded-md focus:outline-none focus:border-blue-500 bg-gray-700 text-white"
                        autocomplete="new-password">
                </div>
                @endif
                @endforeach

                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                    Submit form
                </button>

                <p class="text-gray-300 mt-4">Make sure you are on <span
                        class="font-bold text-green-300">{{config('app.url')}}</span> before submitting.</p>
            </form>
        </div>
    </body>

</html>
