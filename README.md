# FarmAssisant


## Spis treści
* [Ogólne informacje](#general-information)
* [Użyte technologie](#użyte-technologie)
* [Zrealizowane funkcjonalności](#zrealizowane-funkcjonalności)
* [Zrzuty ekranu](#screenshots)
* [Konfiguracja](#konfiguracja)
* [Status projektu](#status-projektu)
* [Podziękowania](#podziękowania)
* [Kontakt](#kontakt)
* [Licencja](#licencja)


## Informacje ogólne
<b>Farm Assistant</b> to aplikacja której celem jest pomoc w ewidencji oraz zarządzaniu gospodarstwem rolnym. 
Każdy użytkownik może stworzyć swoje gospodarstwo rolne, gdzie będzie mógł dodać działki ewidencyjne
 składające się na pola oraz uprawę która na tych polach się znajduje.
Następnie może posiadać magazyn swoich środków ochrony roślin, aby szybko upewnić się czy jest jego 
wystarczająca ilość. Klient aplikacji może też dodać zabieg ochrony roślin, który wykonuje na swoich 
polach na podstawie środków dostępnych w swoim magazynie. Zabiegi te oprócz prezentacji w tabeli zostają
 też uwględnione w kalendarzu, aby rolnik mógł szybko przypomnieć sobie datę zabiegu jak i zaplanować 
 kolejny zabieg.


## Użyte technologie
- HTML
- CSS
- JavaScript
- PHP - version 8.0.10
- Laravel - version 8.62.0


## Zrealizowane funkcjonalności
Lista zrealizowanych funkcjonalnosci:
- Tworzenie gospodarstwa
- Tworzenie, przeglądanie, edycja oraz usuwanie pól
- Tworzenie, przeglądanie, edycja oraz usuwanie działek ewidenyjnych
- Tworzenie, przeglądanie, edycja oraz usuwanie zabiegów ze środkami ochrony roślin
- Przeglądanie oraz dodawanie środków ochrony roślin do magazynu
- Kalendarz z wykonanymi zabiegami oraz z możliwością planowania kolejnych


## Zrzuty ekranu
![Example screenshot](./img/screenshot.png)
<!-- If you have screenshots you'd like to share, include them here. -->


## Konfiguracja
Do uruchomenia potrzebny jest serwer aplikacyjny, interpreter PHP, baza danych oraz Composer. 3 pierwsze elementy oferuje XAMPP a Composer otrzymamy ze strony https://getcomposer.org/ 
 potrzebny on nam będzie w celu zarządzania używanymi przez nas bibliotekami.
 1. Po wypakowaniu projektu do katalogu xampp/htdocs należy wywołać komendę 
 `composer install` 
 2. Przygotowanie środowiska:
 - dla Windows `copy .env.example .env`
3. Wygenerowanie klucza:
 `php artisan key:generate`
4. Stworzenie bazy danych o nazwie zdefiniowanej w pliku .env pod nazwą <b>DB_DATABASE</b>
5. Wykonanie migracji: `php artisan migrate`
6. Wypełnienie tabeli Uprawy i Środki ochrony roślin:
- `php artisan db:seed --class=PlantProtectionProductsTableSeeder`
- `php artisan db:seed --class=CropsTableSeeder`
7. Uruchomienie serwera `php artisan serve`

## Status projektu
Została zakończona wersja 1.0 projektu oprata na blade Laravela. Następna wersja będzie stworzona w oparciu o framework Vue.js po stronie frontendu i kontynuacja Laravela po stronie backendu.


## Kontakt
Aplikacja stworzona przez 
- [Mariusz Dąbrowski](https://github.com/marioooo0o) frontend, backend  
- [Maksymilian Dendura](https://github.com/Noniv)



## Licencja
Wszelkie prawa zastrzeżone. Dostęp po konsultacji z [Mariusz Dąbrowski](https://github.com/marioooo0o).
