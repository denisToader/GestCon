/* aici se limita selectarea datei, dar in cazul cand se face edit ar trebui sa se poata selecta orice data,
deci eliminam aceasta functionalitate
jQuery(document).ready(function($) {
    let d1 = $('#concedii_data_de_la').val();
    let d2 = $('#concedii_data_pana_la').val();
    $( "#concedii_data_de_la" ).attr('min', d1);
    $( "#concedii_data_pana_la" ).attr('min', d2);
});*/

// functii folosite pentru adaugarea sau editarea de concedii
function calculateNewDate(){
    let d1 = $('#concedii_data_de_la').val(); //se ia valoarea datei din campul "data_de_la"
    let d2 = $('#concedii_data_pana_la').val(); //se ia valoarea datei din campul "data_pana_la"
    $('#concedii_nr_zile').val(workingDaysBetweenDates(d1,d2)); //se seteaza valoarea campului "nr zile" cu rezultatul functiei "workingDaysBetweenDates"
}

//agaug change listener cu jQuery
$("#concedii_data_de_la").change(function() {
    calculateNewDate();
});

$("#concedii_data_pana_la").change(function() {
    calculateNewDate();
});

//se calculeaza zilele lucratoare dintre 2 date
let workingDaysBetweenDates = (d0, d1) => {
    /* Two working days and an sunday (not working day) */
    var holidays = [];
    var startDate = parseDate(d0);
    var endDate = parseDate(d1);  

    // Validate input
    if (endDate < startDate) {
        return 0;
    }

    // Calculate days between dates
    var millisecondsPerDay = 86400 * 1000; // Day in milliseconds
    startDate.setHours(0, 0, 0, 1);  // Start just after midnight
    endDate.setHours(23, 59, 59, 999);  // End just before midnight
    var diff = endDate - startDate;  // Milliseconds between datetime objects    
    var days = Math.ceil(diff / millisecondsPerDay);

    // Subtract two weekend days for every week in between
    var weeks = Math.floor(days / 7);
    days -= weeks * 2;

    // Handle special cases
    var startDay = startDate.getDay();
    var endDay = endDate.getDay();
    
    // Remove weekend not previously removed.   
    if (startDay - endDay > 1) {
        days -= 2;
    }
    // Remove start day if span starts on Sunday but ends before Saturday
    if (startDay == 0 && endDay != 6) {
        days--;  
    }
    // Remove end day if span ends on Saturday but starts after Sunday
    if (endDay == 6 && startDay != 0) {
        days--;
    }

    /* Here is the code */
    holidays.forEach(day => {
        if ((day >= d0) && (day <= d1)) {
        /* If it is not saturday (6) or sunday (0), substract it */
        if ((parseDate(day).getDay() % 6) != 0) {
            days--;
        }
        }
    });

    return days;
}
        
function parseDate(input) {
    // Transform date from text to date
    var parts = input.match(/(\d+)/g);
    // new Date(year, month [, date [, hours[, minutes[, seconds[, ms]]]]])
    return new Date(parts[0], parts[1]-1, parts[2]); // months are 0-based
}
