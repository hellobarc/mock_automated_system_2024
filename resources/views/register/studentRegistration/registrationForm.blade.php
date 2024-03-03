@extends('register.home')
@section('register-content')
@include('flash-message')
<div class="container">
    <div class="row mx-4 my-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Student Registration</h2>
                </div>
                <div class="card-body">
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
                                    {{-- <input type="text" class="form-control" name="branch_name_for_mock"> --}}
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
@endsection