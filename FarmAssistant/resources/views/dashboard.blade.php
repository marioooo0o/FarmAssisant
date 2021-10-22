<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div> -->
    <div class="dashboard-container">
        <div class="procedures">
            <h2>Zabiegi</h2>
            <ol>
                <li>
                    <a class="procedure-name">Nazwa zabiegu</a> <a class="field-name">Nazwa pola</a> <span class="date">data</span>
                </li>
                <li>
                    <a class="procedure-name">Nazwa zabiegu</a> <a class="field-name">Nazwa pola</a> <span class="date">data</span>
                </li>
                <li>
                    <a class="procedure-name">Nazwa zabiegu</a> <a class="field-name">Nazwa pola</a> <span class="date">data</span>
                </li>
                <li>
                    <a class="procedure-name">Nazwa zabiegu</a> <a class="field-name">Nazwa pola</a> <span class="date">data</span>
                </li>
            </ol>
            <button>+</button>
        </div>
        <div class="fields">
            <h2>Pola</h2>
            <ol>
                <li><a>Pole</a></li>
                <li><a>Pole</a></li>
                <li><a>Pole</a></li>
                <li><a>Pole</a></li>
            </ol>
            <button>+</button>
        </div>
        <div class="magazine">
            <h2>Magazyn</h2>
            <ul>
                <li>Środek 1</li>
                <li>Środek 2</li>
                <li>Środek 3</li>
                <li>Środek 4</li>
            </ul>
        </div>
        <div class="weather">
            <h2>Pogoda</h2>
        </div>
        <div class="ranking">
            <h2>Ranking upraw</h2>
            <ol>
                <li>Nazwa uprawy</li>
                <li>Nazwa uprawy</li>
                <li>Nazwa uprawy</li>
                <li>Nazwa uprawy</li>
            </ol>
        </div>
        <div class="calendar">
            <h2>Kalendarz</h2>
        </div>
    </div>
</x-app-layout>
