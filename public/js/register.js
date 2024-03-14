window.onload = function () {
    document.getElementById('calender-div').style.display = "none";
    document.getElementById('regular-offers').style.display = "none";
    document.getElementById('free-offers').style.display = "none";
    document.getElementById('offered-offers').style.display = "none";
    document.getElementById('student_batch_no').style.display = "none";
    document.getElementById('offered_payment').style.display = "none";    
}

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

var selectedBranch;
function selectBranch(event) {
    selectedBranch = event.target.value;
    showCalendar(currentMonth, currentYear);
    document.getElementById("branch_name_div").insertAdjacentHTML('beforeend', `<input type="hidden" onclick="" id="" name="branch_name" value="${selectedBranch}" class="my-1">`);
}

function showCalendar(month, year) {
    if (selectedBranch == 'uttara') {
        var data = mockDatesUttara;
    }
    else if (selectedBranch == 'mirpur') {
        var data = mockDatesMirpur;
    }
    // var data = mockDatesUttara;
    data = JSON.parse(data.replace(/&quot;/g, '"'));
    console.log(data);
    var dates = [];

    data.forEach(i => {
        let a = i.date;     //slice(0, 2);
        dates.push(a);
    });
    console.log(dates);

    var selectedDates = [];

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
                let presentDay = date + '-' + (month + 1) + '-' + year;

                data.forEach(i => {
                    if (i.date == presentDay && date > today.getDate()) {
                        cell.className = "date-picker-free-slot";
                        cell.addEventListener('click', function () {
                            let dateValue = this.dataset.date;
                            let monthValue = this.dataset.month;
                            let yearValue = this.dataset.year;
                            let selectedDate = dateValue + '-' + monthValue + '-' + yearValue;
                            console.log(selectedDate);
                            const sel = document.getElementById(this.id);
                            sel.classList.toggle('date-picker-selected');
                            document.getElementById("selected_dates").insertAdjacentHTML('beforeend', `<input type="hidden" name="selected_dates[]" value="${i.id}">`);
                            if(sel.classList.contains("date-picker-selected")){
                                getTimeSlots(selectedDate, selectedBranch,i.id);
                            }
                            else{
                                document.getElementById("time_slot_div").innerHTML = ``;
                            }
                        });
                    }
                    else if (date < today.getDate() && month == today.getMonth() && date != i) {
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
    document.getElementById('calender-div').style.display = "block";
}

function daysInMonth(iMonth, iYear) {
    return 32 - new Date(iYear, iMonth, 32).getDate();
}

async function getTimeSlots(sdate,sbranch,slotId){
    let timeSlotvalues =await axios.post("/get-time-slots",{
        params: {
            date: sdate,
            branch: sbranch
        }
    });
    console.log(timeSlotvalues.data.time_slots);
    document.getElementById("time_slot_div").insertAdjacentHTML('beforeend', `<span style="color: red" >For ${sdate}</span><br>`);
    timeSlotvalues.data.time_slots.forEach(element => {
        if(element.assinged_count >= 6){
        }
        else
            document.getElementById("time_slot_div").insertAdjacentHTML('beforeend', `<input type="radio" onclick="" id=selected-time-slot-${sdate} name="time_Slot-${slotId}" value="${element.id}" class="my-1">&nbsp;&nbsp;&nbsp;<label>${element.time}</label>&nbsp;&nbsp;&nbsp;&nbsp;<span>${6 - element.assinged_count} booking left</span> <br>`);
    });
}


//form price inputs

function regularOffers() {
    var x = document.getElementById('regular-offers');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}

function freeOffers() {
    var x = document.getElementById('free-offers');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}

function offeredOffers() {
    var x = document.getElementById('offered-offers');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}

function inhouseStudent(){
    let x = document.getElementById('student_source').value;
    console.log(x);
    if(x == 'inhouse'){
        document.getElementById('student_batch_no').style.display = "block";
    }
    else{
        document.getElementById('student_batch_no').style.display = "none";
    }
}

function offerPrices(){
    document.getElementById('offered_payment').style.display = "block";
}







