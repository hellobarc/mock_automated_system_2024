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
                                Candidate Mock Time Slots
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <h2>Time Slots Taken</h2>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Serial No</th>
                                                <th>Mock Date</th>
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
                                                    </td>
                                                </tr>
                                                {{-- modal --}}
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
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <h2>Without Time Slots</h2>
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
                                                        <a href="#" class="btn btn-primary" data-toggle="speakingTimeChange-{{$st->mock_dates_id}}" data-target="#speakingTimeChange-{{$st->mock_dates_id}}">Select Time Slots</a>
                                                    </td>
                                                </tr>

                                                {{-- modal --}}
                                                    <div class="modal fade" id="speakingTimeChange-{{$st->mock_dates_id}}" tabindex="-1" role="dialog" aria-labelledby="speakingTimeChangeLabel-{{$st->mock_dates_id}}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="speakingTimeChangeLabel">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal-{{$st->mock_dates_id}}" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ...
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal-{{$st->mock_dates_id}}">Close</button>
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
    function clickModal(value)
{
$('#speakingTimeSlot-'+value).modal('show');
}
</script>