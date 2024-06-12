let calendar = document.querySelector('.calendar');

const month_names = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

isLeapYear = (year) => {
    return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
};

getFebDays = (year) => {
    return isLeapYear(year) ? 29 : 28;
};

generateCalendar = (month, year) => {
    let calendar_days = calendar.querySelector('.calendar-days');
    let calendar_header_year = calendar.querySelector('#year');

    let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    calendar_days.innerHTML = '';

    let currDate = new Date();
    if (!month) month = currDate.getMonth();
    if (!year) year = currDate.getFullYear();

    let curr_month = `${month_names[month]}`;
    month_picker.innerHTML = curr_month;
    calendar_header_year.innerHTML = year;

    // get first day of month
    let first_day = new Date(year, month, 1);

    // get last day of previous month
    let last_day_prev_month = new Date(year, month, 0).getDate();

    let prev_month_days = first_day.getDay(); // Jumlah hari dari bulan sebelumnya yang perlu ditampilkan

    for (let i = prev_month_days - 1; i >= 0; i--) {
        let day = document.createElement('div');
        day.classList.add('calendar-day-empty');
        day.innerHTML = last_day_prev_month - i;
        day.style.color = '#D9D9D9'; // Set warna teks menjadi hitam
        calendar_days.appendChild(day);
    }

    for (let i = 0; i < days_of_month[month]; i++) {
        let day = document.createElement('div');
        day.classList.add('calendar-day-hover');
        day.innerHTML = i + 1;
        day.innerHTML += `<span></span>
                        <span></span>
                        <span></span>
                        <span></span>`;
        if (
            i + 1 === currDate.getDate() &&
            year === currDate.getFullYear() &&
            month === currDate.getMonth()
        ) {
            day.classList.add('curr-date');
            day.style.color = '#B94343'; // Mengubah warna teks menjadi merah
            day.style.background = '#C5C5C5'; // Mengubah latar belakang menjadi abu-abu
    
         
            day.style.borderRadius = '50%';
            // Mengatur lebar dan tinggi elemen agar sama sehingga membentuk lingkaran
            day.style.width = day.style.height = '25px'; // Sesuaikan ukuran lingkaran sesuai kebutuhan
            // Mengatur padding agar angka tanggal berada di tengah lingkaran
            day.style.padding = '6px'
        }
        calendar_days.appendChild(day);
    }

    // Hitung jumlah baris yang diperlukan untuk menampilkan semua tanggal
    let totalRows = Math.ceil((prev_month_days + days_of_month[month]) / 7);
    // Atur padding bottom pada .calendar-days
    calendar_days.style.paddingBottom = `${(totalRows * 15) + 5}px`; // Sesuaikan nilai padding sesuai dengan preferensi Anda
};

// Remove month list menu handling
let month_picker = calendar.querySelector('#month-picker');

let currDate = new Date();

let curr_month = { value: currDate.getMonth() };
let curr_year = { value: currDate.getFullYear() };

generateCalendar(curr_month.value, curr_year.value);

document.querySelector('#prev-year').onclick = () => {
    if (curr_month.value === 0) {
        // Jika bulan adalah Januari, kurangi tahun dan atur bulan ke Desember
        curr_year.value--;
        curr_month.value = 11; // Desember
    } else {
        curr_month.value--;
    }
    generateCalendar(curr_month.value, curr_year.value);
};

document.querySelector('#next-year').onclick = () => {
    if (curr_month.value === 11) {
        // Jika bulan adalah Desember, tambahkan tahun dan atur bulan ke Januari
        curr_year.value++;
        curr_month.value = 0; // Januari
    } else {
        curr_month.value++;
    }
    generateCalendar(curr_month.value, curr_year.value);
};