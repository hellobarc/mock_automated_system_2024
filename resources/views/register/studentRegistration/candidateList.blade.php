@extends('layouts.app')
  
@section('content')
<div class="sidebar-wrapper">
    @include('register.sidebar')
    <div class="main_content"> 
        @include('flash-message')
        <div class="container">
            <div class="row mx-4 my-4">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h2>Candidate List</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection