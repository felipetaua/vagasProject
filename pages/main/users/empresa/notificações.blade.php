<!DOCTYPE html>
<html>
<head>
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
          {
            title: 'Evento de Exemplo',
            start: '2025-07-01T10:00:00',
            end: '2025-07-01T12:00:00'
          }
        ]
      });
      calendar.render();
    });
  </script>
  <script defer src="../../../../assets/js/global/auth-guard.js"></script>
</head>
<body>
  <div id='calendar'></div>
</body>
</html>