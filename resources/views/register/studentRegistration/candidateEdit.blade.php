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
                        </div>
                        <div class="card-body">
                            <form action="{{ route('candidate.edit.store') }}" method="POST" class="form-control" >
                                @csrf
                                <div class="row my-4">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{ $getCandidateData->id }}">
                                            <label for="">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" required value="{{ $getCandidateData->full_name }}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" name="email" required value="{{ $getCandidateData->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number" required value="{{ $getCandidateData->phone_number }}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Purpose Of Ielts</label>
                                            <select name="purpose_of_ielts" id="" class="form-control" required >
                                                <option value="" selected>Select an Option</option>
                                                <option value="ac" {{ $getCandidateData->purpose_of_ielts == 'ac' ? 'selected' : '' }}>Academic</option>
                                                <option value="gt" {{ $getCandidateData->purpose_of_ielts == 'gt' ? 'selected' : '' }}>General Training</option>
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
                                                <option value="uttara" {{ $getCandidateData->branch_name_for_mock == 'uttara' ? 'selected' : '' }}>Uttara</option>
                                                <option value="mirpur" {{ $getCandidateData->branch_name_for_mock == 'mirpur' ? 'selected' : '' }}>Mirpur</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Student Source</label>
                                            <select name="student_source" id="" class="form-control">
                                                <option value="" selected>Select an Option</option>
                                                <option value="inhouse" {{ $getCandidateData->student_source == 'inhouse' ? 'selected' : ''}}>Student From BARC</option>
                                                <option value="outside" {{ $getCandidateData->student_source == 'outside' ? 'selected' : ''}}>Student From Outside</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary mx-2" value="Submit">
                                        <a href="{{route('candidate.list')}}" class="btn btn-primary">Go Back</a>
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