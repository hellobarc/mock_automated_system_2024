<div class="calender-wrapper">
    <div class="container-calendar">
        <h3 id="monthAndYear"></h3>
        <div class="button-container-calendar">
            <button id="previous" onclick="previous()">&#8249;</button>
            <button id="next" onclick="next()">&#8250;</button>
        </div>
        <table class="table-calendar" id="calendar" data-lang="en">
            <thead id="thead-month"></thead>
            <tbody id="calendar-body"></tbody>
        </table>
        <div class="footer-container-calendar">
            <label for="month">Jump To: </label>
            <select id="month" onchange="jump()">
                <option value=0>Jan</option>
                <option value=1>Feb</option>
                <option value=2>Mar</option>
                <option value=3>Apr</option>
                <option value=4>May</option>
                <option value=5>Jun</option>
                <option value=6>Jul</option>
                <option value=7>Aug</option>
                <option value=8>Sep</option>
                <option value=9>Oct</option>
                <option value=10>Nov</option>
                <option value=11>Dec</option>
            </select>
            <select id="year" onchange="jump()"></select>
        </div>
    </div>
</div>

<script>
    // window.onload = function(){
    // let date = document.getElementById("id73");
    // date.addEventListener('click', function(){
    //     let dateValue = id73.dataset.date;
    //     let monthValue = id73.dataset.month;
    //     let yearValue = id73.dataset.year;
    //     console.log(dateValue,monthValue,yearValue);
    // });

    // }
</script>