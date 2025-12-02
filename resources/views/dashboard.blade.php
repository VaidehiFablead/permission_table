@extends('layouts.app')
<style>
    #calendar {
        /* max-width: 80%; */
        margin: 21px 43px;
    }

    .fc .fc-toolbar-title {

        margin: 0px;
        font-size: 21px !important;
    }

    .card-header.text-white {
        background: #1e555c;
    }

    button.fc-prev-button.fc-button.fc-button-primary,
    button.fc-next-button.fc-button.fc-button-primary {
        margin: 4px;
        padding: 2px;
        border-radius: 17px;
        background: #1e555c;
        border: none;
    }

    .fc-event-title-container {
        background: #1e555c;
        border: none;
    }
</style>
@section('content')
    {{-- <div class="card">
        <div id="calendar"></div>
    </div> --}}

    <div class="col-md-6">
        <div class="card shadow-sm ">
            <div class="card-header  text-white">
                <h5 class="mb-0">Calendar</h5>
            </div>

            <div class="card-body p-2">
                <div id="calendar">

                </div>
            </div>
        </div>
    </div>

    {{-- staff count --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                events: async function(fetchInfo, successCallback, failureCallback) {
                    try {
                        let res = await fetch('/staff-count');
                        let data = await res.json();

                        let events = data.map(item => ({
                            title: item.staff_count + " Staff",
                            start: item.date
                        }));

                        successCallback(events);

                    } catch (error) {
                        failureCallback(error);
                    }
                },

                eventDisplay: "block", // show text inside date
                eventBackgroundColor: "#4CAF50",
                eventTextColor: "#fff",
            });

            calendar.render();
        });


        // calendar
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // options: dayGridMonth, timeGridWeek, timeGridDay, listWeek

                selectable: true,
                editable: true,

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                // Sample static events
                events: [{
                        title: 'Meeting',
                        start: '2025-12-05'
                    },
                    {
                        title: 'Project Deadline',
                        start: '2025-12-10'
                    }
                ],

                // When user clicks a date
                dateClick: function(info) {
                    alert('Clicked date: ' + info.dateStr);
                }
            });

            calendar.render();
        });
    </script>
@endsection
