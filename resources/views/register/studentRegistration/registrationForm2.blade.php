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
                                <div class="row my-4">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="" class="fs-4">Select Branch</label>
                                        <select name="" id="branch_select_for_calender" class="form-control" onchange="selectBranch(event)">
                                            <option value="" selected>Select An Option</option>
                                            <option value="uttara">Uttara</option>
                                            <option value="mirpur">Mirpur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="calender-div" id="calender-div">
                                    @include('components.calender')
                                </div>
                                <div class="" id="time_slot_div">
                                    
                                        
                                    
                                </div>
                                <form action="{{ route('candidate.form.store') }}" method="POST" class="form-control">
                                    @csrf
                                    
                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div id="selected_dates">
                                                    
                                                </div>
                                                {{-- <input type="hidden" name="selected_date_for_branch" id="selected_date"> --}}
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
                                                <select name="purpose_of_ielts" id="" class="form-control"
                                                    required>
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
                                                <label for="">Mock Venue</label>
                                                <select name="branch_name_for_mock" id="" class="form-control">
                                                    <option value="" selected>Select An Option</option>
                                                    <option value="uttara">Uttara</option>
                                                    <option value="mirpur">Mirpur</option>
                                                </select>
                                            </div>
                                        </div>
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
                                    </div>

                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Package</label>
                                                <select type="package" class="form-control" name="package">
                                                    <option value="" selected>Select An Option</option>
                                                    <option value="a1-a2">A1-A2</option>
                                                    <option value="b1-b2">B1-B2</option>
                                                    <option value="c1-c2">C1-C2</option>
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

// async function getTimeSlots(){
//     let timeSlotvalues =await axios.get("/get-time-slots");
//     console.log(timeSlotvalues);
// }
</script>
