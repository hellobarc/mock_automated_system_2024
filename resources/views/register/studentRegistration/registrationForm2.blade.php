@extends('layouts.app')
  
@section('content')
<div class="sidebar-wrapper">
    @include('register.sidebar')
    <div class="main_content"> 
        {{-- <h2>test</h2> --}}
        {{-- @yield('register-content') --}}

        {{-- form --}}
        @include('flash-message')
        <div class="container">
            <div class="row mx-4 my-4">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h2>Student Registration</h2>
                        </div>
                        <div class="card-body">
                            @include('components.calender')
                            <form action="{{ route('candidate.form.store') }}" method="POST" class="form-control" >
                                @csrf
                                <div class="row my-4">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row my-4">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Purpose Of Ielts</label>
                                            <select name="purpose_of_ielts" id="" class="form-control" required>
                                                <option value="" selected>Select an Option</option>
                                                <option value="ac">Academic</option>
                                                <option value="gt">General Training</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row my-4">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Branch Venue</label>
                                            <select name="branch_name_for_mock" id="" class="form-control">
                                                <option value="" selected>Select An Option</option>
                                                <option value="uttara">Uttara</option>
                                                <option value="mirpur">Mirpur</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input type="Date" class="form-control" name="date">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row my-4">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Student Source</label>
                                            <select name="student_source" id="" class="form-control">
                                                <option value="" selected>Select an Option</option>
                                                <option value="inhouse">Student From BARC</option>
                                                <option value="outside">Student From Outside</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Price</label>
                                            <input type="price" class="form-control" name="price">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection

<script>
    window.onload = function(){
    window.mockDates = {!! json_encode($getMockDates->toArray()) !!};
    console.log(mockDates[0].date,mockDates[0].total_allocation);
    
    // Calender

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

  var firstDay = ( new Date( year, month ) ).getDay();

  tbl = document.getElementById("calendar-body");

  
  tbl.innerHTML = "";

  
  monthAndYear.innerHTML = months[month] + " " + year;
  selectYear.value = year;
  selectMonth.value = month;

  // creating all cells
  var date = 1;
  for ( var i = 0; i < 6; i++ ) {
      
      var row = document.createElement("tr");
      
      for ( var j = 0; j < 7; j++ ) {
          if ( i === 0 && j < firstDay ) {
              cell = document.createElement( "td" );
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
              cell.setAttribute("id", "id"+date+(month+1)+year);
              cell.className = "date-picker";
              cell.innerHTML = "<span>" + date + "</span>";
              cell.addEventListener('click', function(){
                let dateValue = this.dataset.date;
                let monthValue = this.dataset.month;
                let yearValue = this.dataset.year;
                console.log(dateValue,monthValue,yearValue);
              });
              if ( date === today.getDate() && year === today.getFullYear() && month === today.getMonth() ) {
                  cell.className = "date-picker selected";
              }
              else if( date%2 == 0){
                cell.className = "date-picker free-slot";
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
    }
</script>