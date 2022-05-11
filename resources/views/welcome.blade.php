<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vue Js Project</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>

    <div class="container">
         <div class="p-4 bg-light rounded-3">
            <div class="container-fluid text-center">
              <h1 class="display-5 fw-bold">Laravel And Vuejs SPA</h1>
            </div>
          </div>
    </div>

    <div class="bg-light mt-5">
        <div class="container" id="app">
             <blog-list />
        </div>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
