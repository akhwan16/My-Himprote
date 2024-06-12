const calendar = document.querySelector('.calendar');
const month_names = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

// Function to check if a year is leap year
const isLeapYear = (year) => {
    return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
};

// Function to get number of days in February for a given year
const getFebDays = (year) => {
    return isLeapYear(year) ? 29 : 28;
};

// Function to generate the calendar
const generateCalendar = (month, year) => {
    let calendar_days = calendar.querySelector('.calendar-days');
    let calendar_header_year = calendar.querySelector('#year');

    let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    calendar_days.innerHTML = '';

    let currDate = new Date();
    if (!month) month = currDate.getMonth() + 1; // Default to current month
    if (!year) year = currDate.getFullYear(); // Default to current year

    let curr_month = `${month_names[month - 1]}`; // Convert month index to month name
    month_picker.innerHTML = curr_month;
    calendar_header_year.innerHTML = year;

    // Get first day of the month
    let first_day = new Date(year, month - 1, 1);

    // Get last day of previous month
    let last_day_prev_month = new Date(year, month - 1, 0).getDate();

    let prev_month_days = first_day.getDay(); // Number of days from previous month to display

    // Display days from previous month
    for (let i = prev_month_days - 1; i >= 0; i--) {
        let day = document.createElement('div');
        day.classList.add('calendar-day-empty');
        day.innerHTML = last_day_prev_month - i;
        day.style.color = '#D9D9D9'; // Set text color to gray
        calendar_days.appendChild(day);
    }

    // Display days of the current month
    for (let i = 0; i < days_of_month[month - 1]; i++) {
        let day = document.createElement('div');
        day.classList.add('calendar-day-hover');
        day.innerHTML = i + 1;
        day.innerHTML += `<span></span><span></span><span></span><span></span>`; // Additional spans as needed

        if (
            i + 1 === currDate.getDate() &&
            year === currDate.getFullYear() &&
            month === currDate.getMonth() + 1
        ) {
            day.classList.add('curr-date');
            day.style.color = '#B94343'; // Set text color to red
            day.style.background = '#C5C5C5'; // Set background color to gray
            day.style.borderRadius = '50%'; // Make it round
            day.style.width = day.style.height = '25px'; // Set dimensions for circle
            day.style.padding = '6px'; // Padding for placing date in center of circle
        }
        calendar_days.appendChild(day);
    }

    // Calculate number of rows needed to display all dates
    let totalRows = Math.ceil((prev_month_days + days_of_month[month - 1]) / 7);
    // Set bottom padding on .calendar-days
    calendar_days.style.paddingBottom = `${(totalRows * 15) + 5}px`; // Adjust padding as desired
};

// Remove month list menu handling
let month_picker = calendar.querySelector('#month-picker');

// Initialize current date
let currDate = new Date();
let curr_month = { value: currDate.getMonth() + 1 }; // Start from current month
let curr_year = { value: currDate.getFullYear() }; // Start from current year

generateCalendar(curr_month.value, curr_year.value); // Generate calendar for current month and year

// Handle next year button click
document.querySelector('#next-year').onclick = () => {
    if (curr_month.value === 12) {
        // If current month is December, increment year and set month to January
        curr_year.value++;
        curr_month.value = 1;
    } else {
        // Otherwise, just increment month
        curr_month.value++;
    }
    generateCalendar(curr_month.value, curr_year.value); // Generate calendar for new month and year
};

// Handle previous year button click
document.querySelector('#prev-year').onclick = () => {
    if (curr_month.value === 1) {
        // If current month is January, decrement year and set month to December
        curr_year.value--;
        curr_month.value = 12;
    } else {
        // Otherwise, just decrement month
        curr_month.value--;
    }
    generateCalendar(curr_month.value, curr_year.value); // Generate calendar for new month and year
};
xa