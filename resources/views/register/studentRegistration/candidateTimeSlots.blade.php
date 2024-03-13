@extends('layouts.app')

@section('content')
    <div class="sidebar-wrapper">
        @include('register.sidebar')
        <div class="main_content">
            @include('flash-message')
            <div class="container">
                <div class="row my-4 mx-4">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                Candidate Mock Speaking Time Slots
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <h2>Speaking Time Slots Taken</h2>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Serial No</th>
                                                <th>Mock Date</th>
                                                <th>Branch</th>
                                                <th>Time Slot</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getMockDateWithTime as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $item->date }}</td>
                                                    <td>{{ $item->branch }}</td>
                                                    <td>{{ $item->time }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}">Change Date</a>
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeSpeakingTime-{{$item->id}}" data-mock_dates_id="{{ $item->mock_dates_id }}" data-id="{{ $item->id }}" onclick="getTimeSlotData(event)">Change Time</a>
                                                    </td>
                                                </tr>
                                                {{--Change Date modal --}}
                                                <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel-{{$item->id}}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel-{{$item->id}}">Change Date</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          <form action="{{ route('change.mock.date') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="candidate_id" value="{{ $item->candidate_logs_id }}">
                                                            <input type="hidden" name="old_date_id" value="{{ $item->mock_dates_id }}">
                                                            <select name="new_mock_date" id="" class="form-control">
                                                                <option value="" selected>--select--</option>
                                                                @foreach ($getMockDates as $date)
                                                                    <option value="{{ $date->id }}">{{ $date->date }}---{{ $date->branch }}---{{40-$date->total_allocation}} Seats Left</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="my-3 float-end">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                          </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>

                                                {{-- Change Time Modal --}}
                                                <div class="modal fade" id="changeSpeakingTime-{{$item->id}}" tabindex="-1" aria-labelledby="changeSpeakingTime-{{$item->id}}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="changeSpeakingTime-{{$item->id}}">Change Speakng Time Slot</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          <form action="{{ route('change.speaking.time') }}" method="POST">
                                                            @csrf
                                                            <div id="time_slots_date">

                                                            </div>
                                                            <div class="my-3 float-end">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                          </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <h2>Without Speaking Time Slots</h2>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Serial No</th>
                                                <th>Mock Date</th>
                                                <th>Branch</th>
                                                {{-- <th>Time Slot</th> --}}
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getMockDatewithSpeakingTimes as $st)   
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>{{ $st->MockDate->date}}</td>
                                                    <td>{{ $st->MockDate->branch}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTimeSlot-{{$st->id}}">
                                                            Select Time Slot
                                                        </button>
                                                    </td>
                                                </tr>

                                                {{-- modal --}}
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="addTimeSlot-{{$st->id}}" tabindex="-1" aria-labelledby="addTimeSlot-{{$st->id}}Label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="addTimeSlot-{{$st->id}}Label">Change Time Slot</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('set.time.slot') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="candidate_id" value="{{ $st->candidate_logs_id }}">
                                                                    <input type="hidden" name="mock_date_id" value="{{ $st->mock_dates_id }}">
                                                                    <select name="time_slot" id="" class="form-control">
                                                                        <option value="" selected>--select--</option>
                                                                        @foreach ($st->MockDate->SpeakingTimes as $timeslot)
                                                                            <option value="{{ $timeslot->id}}">{{ $timeslot->time }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="my-3 float-end">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                  </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
function getTimeSlotData(){
let change_time = event.target;
let mock_date_id = change_time.dataset.mock_dates_id;
let id = change_time.dataset.id;
// console.log(id);
console.log(mock_date_id);
document.getElementById("time_slots_date").innerHTML = ``;
get_timeData(mock_date_id);

}

async function get_timeData(mock_date_id){
    let data = await axios.post('/get-change-speaking-time', {
        params: {
            date_id: mock_date_id
        }
    });
    
    data.data.time_slots_for_date[0].speaking_times.forEach(element => {
        if(element.assinged_count >= 6){
        }
        else{
            console.log(element.time)
            document.getElementById("time_slots_date").insertAdjacentHTML('beforeend', `<input type="radio" onclick=""  name="time_Slot" value="${element.id}" class="my-1">&nbsp;&nbsp;&nbsp;<label>${element.time}</label>&nbsp;&nbsp;&nbsp;&nbsp;<span>${6 - element.assinged_count} booking left</span> <br>`);
        }
    });

    console.log(data.data.time_slots_for_date[0].speaking_times);
}
</script>