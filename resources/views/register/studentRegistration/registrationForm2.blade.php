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
                                <form action="{{ route('candidate.form.store') }}" method="POST" class="form-control">
                                    @csrf
                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div id="selected_dates">

                                                </div>
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
                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Student Source</label>
                                                <select name="student_source" id="student_source" class="form-control" onchange="inhouseStudent()" >
                                                    <option value="" selected>Select an Option</option>
                                                    <option value="inhouse">Student From BARC</option>
                                                    <option value="outside">Student From Outside</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" id="student_batch_no">
                                            <label for="">Batch No</label>
                                            <input type="text" name="student_batch_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Package</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="regular-check" name="regular" onchange="regularOffers()">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Regular
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                        id="free-check" name="free" onchange="freeOffers()">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Free
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                        id="offered-check" name="offered" onchange="offeredOffers()">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Offered
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="regular-offers">
                                        <Span style="color: blue">Regular</Span>
                                        <div class="row my-4 mx-4">
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="">Number Of Mocks</label>
                                                    <input type="text" class="form-control" name="number_of_mocks_regular">
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="">Total Amount</label>
                                                    <input type="text" class="form-control" name="total_amount_regular">
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="">Payment Recieved</label>
                                                    <input type="text" class="form-control" name="payment_recieved_regular">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="free-offers">
                                        <Span style="color: blue">Free</Span>
                                        <div class="row my-4 mx-4">
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="">Number Of Mocks</label>
                                                    <input type="text" class="form-control" name="free_number_of_mocks">
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="">Current Batch No</label>
                                                    <input type="text" class="form-control" name="free_current_batch_no">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="offered-offers">
                                        <Span style="color: blue">Avaiable Offers</Span>
                                        <div class="row my-4 mx-4">
                                            @foreach ($getMockOffers as $item)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="{{ $item->id }}"
                                                    id="offered_prices-{{ $item->id }}" name="offered_prices" onchange="offerPrices()">
                                                <label class="form-check-label" for="flexCheckDefault-{{ $item->id }}">
                                                    {{ $item->offer_description }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div id="offered_payment">
                                            <div class="row my-4">
                                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Number Of Mocks</label>
                                                        <input type="text" class="form-control" name="number_of_mocks_offered">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Number Of Mock (Free) </label>
                                                        <input type="text" class="form-control" name="number_of_mocks_offered_free">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Number Of Mocks (Paid)</label>
                                                        <input type="text" class="form-control" name="number_of_mocks_offered_paid">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Total Amount</label>
                                                        <input type="text" class="form-control" name="total_amount_offered">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Payment Recieved</label>
                                                        <input type="text" class="form-control" name="payment_recieved_offered">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <label for="" class="fs-4">Select Branch</label>
                                            <select name="branch_name_for_mock" id="branch_name_for_mock"
                                                class="form-control" onchange="selectBranch(event)">
                                                <option value="" selected>Select An Option</option>
                                                <option value="uttara">Uttara</option>
                                                <option value="mirpur">Mirpur</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="">Advisors Name</label>
                                        <select name="advisors_name" id="" class="form-control">
                                            <option value="" selected> --select--</option>
                                            @foreach ($getMockAdvisors as $item)
                                                <option value="{{ $item->id }}">{{ $item->advisor_name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>

                                    <div class="calender-div" id="calender-div">
                                        @include('components.calender')
                                    </div>
                                    <div class=" row my-4">
                                        <label for="">Avaiable time Slots</label>
                                        <div class="form-group" id="time_slot_div">

                                        </div>
                                        <div id="branch_name_div">

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



</script>
