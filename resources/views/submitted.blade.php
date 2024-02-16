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
        <div class="bg-green-100  text-green-700  rounded-lg">
            <p class="text-2xl font-bold">Form submitted successfully</p>
            <p>Your form has been submitted successfully, here is the unique response ID for your form.
                <br><code>{{$key}}</code>
            </p>

        </div>
        </div>
    </body>

</html>
