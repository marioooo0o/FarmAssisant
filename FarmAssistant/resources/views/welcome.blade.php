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
            
Farm Assistant to aplikacja której celem jest pomoc w ewidencji oraz zarządzaniu gospodarstwem rolnym. 
Każdy użytkownik może stworzyć swoje gospodarstwo rolne, gdzie będzie mógł dodać działki ewidencyjne
 składające się na pola oraz uprawę która na tych polach się znajduje.
Następnie może posiadać magazyn swoich środków ochrony roślin, aby szybko upewnić się czy jest jego 
wystarczająca ilość. Klient aplikacji może też dodać zabieg ochrony roślin, który wykonuje na swoich 
polach na podstawie środków dostępnych w swoim magazynie. Zabiegi te oprócz prezentacji w tabeli zostają
 też uwględnione w kalendarzu, aby rolnik mógł szybko przypomnieć sobie datę zabiegu jak i zaplanować 
 kolejny zabieg.
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
