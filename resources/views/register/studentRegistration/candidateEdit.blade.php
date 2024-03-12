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
                                <h2>Candidate Edit Store</h2>
                                <a href="{{ route('candidate.mock.date', $getCandidateData->id )}}" class="btn btn-primary float-end">Time Slots For This Candidate</a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('candidate.edit.store') }}" method="POST" class="form-control">
                                    @csrf
                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{ $getCandidateData->id }}">
                                                <label for="">Full Name</label>
                                                <input type="text" class="form-control" name="full_name" required
                                                    value="{{ $getCandidateData->full_name }}">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" class="form-control" name="email" required
                                                    value="{{ $getCandidateData->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number" required
                                                    value="{{ $getCandidateData->phone_number }}">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Purpose Of Ielts</label>
                                                <select name="purpose_of_ielts" id="" class="form-control"
                                                    required>
                                                    <option value="" selected>Select an Option</option>
                                                    <option value="ac"
                                                        {{ $getCandidateData->purpose_of_ielts == 'ac' ? 'selected' : '' }}>
                                                        Academic</option>
                                                    <option value="gt"
                                                        {{ $getCandidateData->purpose_of_ielts == 'gt' ? 'selected' : '' }}>
                                                        General Training</option>
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
                                                    <option value="uttara"
                                                        {{ $getCandidateData->branch_name_for_mock == 'uttara' ? 'selected' : '' }}>
                                                        Uttara</option>
                                                    <option value="mirpur"
                                                        {{ $getCandidateData->branch_name_for_mock == 'mirpur' ? 'selected' : '' }}>
                                                        Mirpur</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Student Source</label>
                                                <select name="student_source" id="" class="form-control">
                                                    <option value="" selected>Select an Option</option>
                                                    <option value="inhouse"
                                                        {{ $getCandidateData->student_source == 'inhouse' ? 'selected' : '' }}>
                                                        Student From BARC</option>
                                                    <option value="outside"
                                                        {{ $getCandidateData->student_source == 'outside' ? 'selected' : '' }}>
                                                        Student From Outside</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-end">
                                            <input type="submit" class="btn btn-primary mx-2" value="Submit">
                                            <a href="{{ route('candidate.list') }}" class="btn btn-primary">Go Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-4 my-4">
                    <div class="col-md-10">
                        <div class="card-body">
                            <h2>Purchase New Mock</h2>
                            <div class="row my-4">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="" class="fs-4">Select Branch</label>
                                    <select name="" id="branch_select_for_calender" class="form-control"
                                        onchange="selectBranch(event)">
                                        <option value="" selected>Select An Option</option>
                                        <option value="uttara">Uttara</option>
                                        <option value="mirpur">Mirpur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="calender-div" id="calender-div">
                                @include('components.calender')
                            </div>

                            
                            <form action="{{ route('buy.new.mock') }}" method="POST">
                                @csrf
                                <div class=" row my-4" >
                                    <input type="hidden" name="id" value="{{ $getCandidateData->id }}">
                                    {{-- <span>Avaiable time Slots</span> --}}
                                    <label for="">Avaiable time Slots</label>
                                    <div class="form-group" id="time_slot_div">

                                    </div>
                                    <div id="branch_name_div">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div id="selected_dates">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Package</label>
                                                <select type="package" class="form-control" name="package">
                                                    <option value="" selected>Select An Option</option>
                                                    <option value="regular">Regular</option>
                                                    <option value="offered">Offered</option>
                                                    <option value="free">Free</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Mock Numbers</label>
                                                <select name="mock_number" id="mock_number" class="form-control" onchange="offer_status(event)">
                                                    <option value="" selected>Select An Option</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Payment Recieved</label>
                                                <input type="text" name="payment_recieved" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="mock_offers">
                                                <label for="">Offers</label>
                                                <input type="text" name="mock_offers" class="form-control" id="mock_offers_value" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-end">
                                            <input type="submit" class="btn btn-primary" value="Purchase">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    var mockDatesUttara = "{{ $getMockDatesUttara }}";
    var mockDatesMirpur = "{{ $getMockDatesMirpur }}";
    var mockNumber = "{{ $getMockPrices }}";


    var mockNumber = JSON.parse(mockNumber.replace(/&quot;/g, '"'));
    console.log(mockNumber[0].offer_status);
    console.log(mockNumber.length);
    var Offers = [];
    var OfferPrices = [];
    mockNumber.forEach(element => {
        if (element.offer_status == 'active') {
            Offers.push(element.id);
            OfferPrices.push(element.offer_price);
        }
    });

function offer_status(event) {
        var selectedID = event.target.value;
        
        for(i=0;i<=Offers.length;i++){
            if ( selectedID == Offers[i] ){
                document.getElementById('mock_offers').style.display = "block";
                document.getElementById('mock_offers_value').value = OfferPrices[i];
                console.log(Offers[i]);
                break;
            }
            else{
                document.getElementById('mock_offers').style.display = "none";
            }
        }
    }
</script>
