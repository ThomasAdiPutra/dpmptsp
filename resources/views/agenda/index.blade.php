@extends('layout.master', ['title'=>'Agenda DPMPTSP'])

@section('head')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.css' rel='stylesheet' />
@endsection

@section('main')
    <div class="text-center">
        <div id="calendar"></div>
    </div>
@endsection

@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.js'></script>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                eventColor: 'green',
                displayEventTime: false,
                events: [
                    @foreach ($agendas as $agenda)
                        {
                            title: '{{ $agenda->title }}',
                            start: '{{ $agenda->start_date }}',
                            end: '{{ $agenda->end_date }}',
                        },
                    @endforeach
                ],
                eventContent: function(info) {
                    title = info.event.title
                    el = `<span data-toggle="tooltip" title="${title}">${title}</span>`
                    return {
                        html: el
                    };
                },
                eventMouseEnter: function(info) {
                    $(info.el).find('[data-toggle="tooltip"]').tooltip('show');
                },
                eventMouseLeave: function(info) {
                    $(info.el).find('[data-toggle="tooltip"]').tooltip('hide');
                },
            });

            calendar.render();
        });
    </script>
@endsection
