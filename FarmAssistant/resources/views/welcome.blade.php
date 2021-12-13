<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Farm Assistant</title>
  </head>
  <body>
    <div class="welcome">
      <div class="wrapper">
        <div class="content">
          <div class="logo-farm">
            <x-application-logo class="block h-40 w-auto mx-auto" />
            <h1>Farm Assistant</h1>
        </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et illum
            enim cupiditate consequuntur, officiis vitae, temporibus doloremque
            saepe harum impedit rem sequi porro consequatur explicabo
            perspiciatis asperiores nam quae minus? Lorem ipsum dolor sit amet,
            consectetur adipisicing elit. Non veritatis quia nam facilis
            quibusdam. Recusandae, doloribus esse, blanditiis, reiciendis
            quisquam quas illum nam autem dolorem repudiandae iure consequatur
            rerum quae?
          </p>
          <div class="buttons">
            <a href="{{ route('login') }}" class="button">Logowanie</a>
            <a href="{{ route('register') }}" class="button">Rejestracja</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
