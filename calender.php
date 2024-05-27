<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Dinamis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .calendar {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .calendar-header {
            background-color: #f5f5f5;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .calendar-body {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
        }
        .calendar-body div {
            padding: 10px;
            text-align: center;
        }
        .day-header {
            background-color: #e0e0e0;
            font-weight: bold;
        }
        .day {
            background-color: #fff;
        }
        .highlight {
            background-color: #ffeb3b;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="calendar">
        <div class="calendar-header">
            <span id="month-year">< Maret ></span> 2024
        </div>
        <div class="calendar-body">
            <div class="day-header">Senin</div>
            <div class="day-header">Selasa</div>
            <div class="day-header">Rabu</div>
            <div class="day-header">Kamis</div>
            <div class="day-header">Jum'at</div>
            <div class="day-header">Sabtu</div>
            <div class="day-header">Minggu</div>
            <div id="calendar-days"></div>
        </div>
    </div>

    <script>
        function generateCalendar(year, month) {
            const monthYearLabel = document.getElementById('month-year');
            const calendarDays = document.getElementById('calendar-days');
            const date = new Date(year, month - 1, 1);
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            const daysInMonth = new Date(year, month, 0).getDate();
            const startDay = date.getDay(); // Get the day of the week of the first day of the month

            monthYearLabel.innerText = `< ${monthNames[month - 1]} > ${year}`;
            calendarDays.innerHTML = '';

            // Add empty divs for the days before the start of the month
            for (let i = 0; i < (startDay + 6) % 7; i++) {
                const emptyDiv = document.createElement('div');
                emptyDiv.classList.add('day');
                calendarDays.appendChild(emptyDiv);
            }

            // Add divs for each day of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.classList.add('day');
                dayDiv.innerText = day;
                if (day === 13) {
                    dayDiv.classList.add('highlight');
                }
                calendarDays.appendChild(dayDiv);
            }
        }

        // Initialize the calendar for March 2024
        generateCalendar(2024, 3);
    </script>
</body>
</html>
