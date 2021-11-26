@extends('layouts.app', ['farms' => $farms, 'activeFarm' => $activeFarm])

@section('content')
      <div class="container">
         <div class="jumbotron">
            <div class="container text-center">
               <h1>Laravel 8 FullCalendar Tutorial</h1>
            </div>
         </div>
         <div id='calendar'></div>
      </div>
      <script>
         $(document).ready(function () {
            
         var SITEURL = "{{ url('/') }}";

         var NEWURL = '/api/farm/{{  $activeFarm->id }}/events';
           
         $.ajaxSetup({
             headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
           
         var calendar = $('#calendar').fullCalendar({
                            monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
                            monthNamesShort: ['St', 'Lut', 'Mrz', 'Kw', 'Maj', 'Cz', 'Lip', 'Sier', 'Wrz', 'Paź', 'Lis', 'Gr'],
                            dayNames: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
                            dayNamesShort: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Niedz'],
                            
                            editable: true,
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

@endsection