@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])
@section('content')

<div class="dashboard-container">
    <div class="procedures">
        <h2>Zabiegi</h2>

        <ol>     
            @if (!$practises->isEmpty())
                @for ($i=0; $i < 5; $i++)
                    @isset($practises[$i])
                        <li><a href="{{ route('practise.show',[$activeFarm->id, $practises[$i]->id]) }}" class="procedure-name">{{ $practises[$i]->name }}</a> <a href="{{ route('field.show',[$activeFarm->id, $practises[$i]->field_id]) }}">{{ $practises[$i]->field_name }}</a><span class="date">{{\Carbon\Carbon::parse($practises[$i]->updated_at)->format('d-m-Y') }}</span></li>
                    @endisset
                @endfor
                <a href="{{ route('practise.index', [$activeFarm->id]) }}" ><button class="more button">Pokaż wszystkie</button></a>

            @else
                Brak zabiegów, dodaj swój pierwszy zabieg!
            @endif
            
                        
            
        </ol>
        <a href="{{ route('practise.create', [$activeFarm->id]) }}"><button class="button">+</button></a>
    </div>
    <div class="fields">
        <h2>Pola</h2>

        <ol>

            @if (!$fields->isEmpty())
                @for ($i = 0; $i < 4; $i++)
                    @isset($fields[$i])
                        <li><a href="/farm/{{ $fields[$i]->farm_id }}/field/{{ $fields[$i]->id }}"> {{ $fields[$i]->field_name }}    {{ $fields[$i]->field_area }}ha</a> </li>
                    @endisset
                @endfor
                <a href="{{ route('field.index', [$activeFarm->id]) }}" ><button class="more button">Pokaż wszystkie</button></a>
            @else
                Brak pól, dodaj swoje pierwsze pole!      
            @endif

        </ol>
        <a href="{{ route('field.create', ['idFarm'=> $activeFarm->id ]) }}"><button class="button">+</button></a>
    </div>
    <div class="magazine">
        <h2>Magazyn</h2>

        @if (!$productsInMagazine->isEmpty())
        <ul>
            @foreach ($productsInMagazine as $product)
            <li id="product-{{ $loop->iteration }}">
                {{ $product->name}} {{ $product->quantity}} {{ $product->unit }}
                <script>
                    if("{{ $product->quantity}}" < 5) {
                        document.getElementById("product-{{ $loop->iteration }}").innerHTML += `<div class="bar bar--red" id="product-bar-{{ $loop->iteration }}"></div>`;
                        document.getElementById("product-bar-{{ $loop->iteration }}").style.width = `${"{{ $product->quantity }}"*10}%`;
                    }
                    else if("{{ $product->quantity}}" < 10) {
                        document.getElementById("product-{{ $loop->iteration }}").innerHTML += `<div class="bar bar--orange" id="product-bar-{{ $loop->iteration }}"></div>`;
                        document.getElementById("product-bar-{{ $loop->iteration }}").style.width = `${"{{ $product->quantity }}"*10}%`;
                    }
                    else {
                        document.getElementById("product-{{ $loop->iteration }}").innerHTML += `<div class="bar bar--green" id="product-bar-{{ $loop->iteration }}"></div>`;
                        document.getElementById("product-bar-{{ $loop->iteration }}").style.width = `100%`;
                    }
                    
                </script>
            </li>
            @endforeach
        </ul>        
        <a href="{{  route('magazine.index', [$activeFarm->id]) }}"><button class="more button">Pokaż wszystkie</button></a>
        <a href="/home/{{ $activeFarm->id }}/magazine/create"><button class="button">+</button></a>

        @else Brak środków w magazynie!
        <a href="/home/{{ $activeFarm->id }}/magazine/create"><button class="button">+</button></a>


        @endif
    </div>
    <div class="weather">
        <h2>Pogoda</h2>
    </div>
    <div class="ranking">
        <h2>Ranking upraw</h2>
        <ol>
            @if (!$crops->isEmpty())
                @foreach ($crops as $crop)
                    <li>{{ $crop->name }} {{ $crop->crop_area }} ha</li>
                @endforeach

                <a href="#"><button class="more more--down button">Pokaż wszystkie</button></a>
            @else
                Nie posiadasz żadnych upraw!
            @endif
        </ol>
        
    </div>
    <div class="calendar">
        <h2><a href="/home/{{ $activeFarm->id }}/calender">Kalendarz</a> </h2>
        
        <div id="calendar">
            
        </div>
        
        <script>
            $(document).ready(function () {
               
            var SITEURL = "{{ url('/') }}";

            var NEWURL = '/api/farm/{{  $activeFarm->id }}/events';
            console.log(NEWURL)
            //console.log(NEWURL.data);
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log(NEWURL.data);
            var calendar = $('#calendar').fullCalendar({
                                monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
                                monthNamesShort: ['St', 'Lut', 'Mrz', 'Kw', 'Maj', 'Cz', 'Lip', 'Sier', 'Wrz', 'Paź', 'Lis', 'Gr'],
                                dayNames: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
                                dayNamesShort: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Niedz'],
                                editable: true,
                                //events: NEWURL,
                                eventSources: [
                                    {
                                        url: NEWURL,
                                        color: 'dark blue',   
                                        textColor: 'white',  
                                    
                                    }
                                ],
                                displayEventTime: false,
                                editable: true,
                                eventRender: function (event, element, view) {
                                    if (event.allDay === 'true') {
                                            event.allDay = true;
                                    } else {
                                            event.allDay = false;
                                    }
                                },
                                selectable: true,
                                selectHelper: true,
                                select: function (start, end, allDay) {
                                    var title = prompt('Event Title:');
                                    if (title) {
                                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                                        $.ajax({
                                            url: SITEURL + "/fullcalenderAjax",
                                            data: {
                                                title: title,
                                                start: start,
                                                end: end,
                                                type: 'add'
                                            },
                                            type: "POST",
                                            success: function (data) {
                                                displayMessage("Event Created Successfully");
              
                                                calendar.fullCalendar('renderEvent',
                                                    {
                                                        id: data.id,
                                                        title: title,
                                                        start: start,
                                                        end: end,
                                                        allDay: allDay
                                                    },true);
              
                                                calendar.fullCalendar('unselect');
                                            }
                                        });
                                    }
                                },
                                eventDrop: function (event, delta) {
                                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
              
                                    $.ajax({
                                        url: SITEURL + '/fullcalenderAjax',
                                        data: {
                                            title: event.title,
                                            start: start,
                                            end: end,
                                            id: event.id,
                                            type: 'update'
                                        },
                                        type: "POST",
                                        success: function (response) {
                                            displayMessage("Event Updated Successfully");
                                        }
                                    });
                                },
                                eventClick: function (event) {
                                    
                                    var showMsg = confirm("Chcesz zobaczyć więcej informacji?");
                                    if (showMsg) {
                                        console.log(event.id);
                                        
                                       window.location.href = "{{ route('farm.show', [$activeFarm->id]) }}"+ "/practise/"+event.id;
                                    }
                                }
             
                            });
             
            });
            function displayMessage(message) {
                toastr.success(message, 'Event');
            } 
              
         </script>
   
        
    </div>
</div>
@endsection
