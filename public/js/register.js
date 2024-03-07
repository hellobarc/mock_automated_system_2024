// Calender
var data = mockDates;
var data = JSON.parse(data.replace(/&quot;/g, '"'));
var dates = [];

data.forEach(i => {
    let a = i.date;     //slice(0, 2);
    dates.push(a);
});
var datesLength = dates.length;
console.log(dates);

var selectedDates= [];

function generate_year_range(start, end) {
    var years = "";
    for (var year = start; year <= end; year++) {
        years += "<option value='" + year + "'>" + year + "</option>";
    }
    return years;
}

today = new Date();
currentMonth = today.getMonth();
currentYear = today.getFullYear();
selectYear = document.getElementById("year");
selectMonth = document.getElementById("month");


createYear = generate_year_range(1970, 2050);
/** or
* createYear = generate_year_range( 1970, currentYear );
*/

document.getElementById("year").innerHTML = createYear;

var calendar = document.getElementById("calendar");
var lang = calendar.getAttribute('data-lang');

var months = "";
var days = "";

var monthDefault = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

var dayDefault = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

if (lang == "en") {
    months = monthDefault;
    days = dayDefault;
} else if (lang == "id") {
    months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    days = ["Ming", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
} else if (lang == "fr") {
    months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
    days = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
} else {
    months = monthDefault;
    days = dayDefault;
}


var $dataHead = "<tr>";
for (dhead in days) {
    $dataHead += "<th data-days='" + days[dhead] + "'>" + days[dhead] + "</th>";
}
$dataHead += "</tr>";

//alert($dataHead);
document.getElementById("thead-month").innerHTML = $dataHead;


monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);



function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {

    var firstDay = (new Date(year, month)).getDay();

    tbl = document.getElementById("calendar-body");


    tbl.innerHTML = "";


    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    var date = 1;
    for (var i = 0; i < 6; i++) {

        var row = document.createElement("tr");

        for (var j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                cell = document.createElement("td");
                cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth(month, year)) {
                break;
            } else {
                cell = document.createElement("td");
                cell.setAttribute("data-date", date);
                cell.setAttribute("data-month", month + 1);
                cell.setAttribute("data-year", year);
                cell.setAttribute("data-month_name", months[month]);
                cell.setAttribute("id", "id" + date + (month + 1) + year);
                cell.className = "date-picker";
                cell.innerHTML = "<span>" + date + "</span>";
                let presentDay = date + '-' +(month+1)+'-'+year;
                
                // for(k=0 ; k<=datesLength ; k++){
                //     if(dates[k] == presentDay && date> today.getDate() ){
                //         cell.className = "date-picker-free-slot";
                //         cell.addEventListener('click', function(){
                //             let dateValue = this.dataset.date;
                //             let monthValue = this.dataset.month;
                //             let yearValue = this.dataset.year;
                //             // console.log(dateValue,monthValue,yearValue);
                //             let selectedDate = dateValue + '-' + monthValue + '-' + yearValue ;
                //             console.log(selectedDate);
                //             document.getElementById('selected_date').value = selectedDate;
                //             cell.className = "date-picker selected";
                //         });
                //     }
                //     else if( date < today.getDate() && date != i){
                //                 cell.className = "date-picker booked";
                //         } 
                // }
                dates.forEach(i => {
                    if(i == presentDay){
                        cell.className = "date-picker-free-slot";
                        cell.addEventListener('click', function(){
                            // cell.className = "date-picker-selected";
                            let dateValue = this.dataset.date;
                            let monthValue = this.dataset.month;
                            let yearValue = this.dataset.year;
                            // console.log(dateValue,monthValue,yearValue);
                            let selectedDate = dateValue + '-' + monthValue + '-' + yearValue;
                            console.log(selectedDate);
                            // document.getElementById('selected_date').value = selectedDate;
                            const sel = document.getElementById(this.id);
                            // sel.classList.remove("date-picker-free-slot");
                            // sel.classList.add('date-picker-selected');
                            sel.classList.toggle('date-picker-selected');
                            // var dates = document.getElementsByClassName('date-picker-selected').value;
                            // console.log(dates);
                            selectedDates.push(this.id);
                            // console.log(this.id);
                            // console.log(selectedDates);
                            document.getElementById("selected_dates").insertAdjacentHTML('beforeend', `<input type="hidden" name="selected_dates[]" value="${this.id}">`);
                            // var html = `<input type="hidden" name="selected_dates[]" value="${this.id}">`;
                                // document.getElementById('selected_dates').insertAdjacentHTML(html);

                            // selectedDates.forEach(element => {
                                
                            // });
                        }); 
                    }
                    else if( date < today.getDate() && month == today.getMonth() && date != i){
                        cell.className = "date-picker booked";
                    }                  
                });
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.className = "date-picker selected";
                }

                row.appendChild(cell);
                date++;
            }
        }
        tbl.appendChild(row);
    }
}

function daysInMonth(iMonth, iYear) {
    return 32 - new Date(iYear, iMonth, 32).getDate();
}

// var data = mockDates;
// var data = JSON.parse(data.replace(/&quot;/g, '"'));
// var dates = [];
// data.forEach(i => {
//     let a = i.date.slice(0, 2);
//     dates.push(a);
// });
// console.log(dates);

// var dates = document.getElementsByClassName('date-picker-selected').value;
// console.log(dates);

// document.getElementById('selected_dates').value = selectedDates;
var html = `<input type="hidden" name="selected_dates[]" value="">`;

selectedDates.forEach(element => {
    document.getElementById('selected_dates').innerHTML= html;
});

