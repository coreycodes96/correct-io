<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>correct.io</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
        {{-- Scripts --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body style="background-color: rgb(243 244 246);">
        <div id="app">
            {{-- Header --}}
            <guest-header />
        </div>
        
        <div class="w-screen h-screen flex flex-col justify-center items-center text-center">
            <h1 class="md:text-5xl text-2xl">Welcome To <span class="text-green-500">Correct.io</span></h1>
            <p class="mt-5 md:text-xl text-md">Create a quizzes and have fun</p>
        </div>
    </body>
</html>
