@extends('layouts.app')

@section('content')
    <div class="sidebar-wrapper">
        @include('register.sidebar')
        <div class="main_content">
            @include('flash-message')
            <div class="container">
                <div class="row mx-4 my-4">
                    <div class="col-md-10">
                        <div class="card ">
                            <div class="card-header">
                                <h2>Candidate List</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Unique Code</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Purpose</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getCandidateData as $item)
                                            <tr>
                                                <td>{{ $item->unique_id }}</td>
                                                <td>{{ $item->full_name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>{{ strtoupper($item->purpose_of_ielts) }}</td>
                                                <td>
                                                    <a href="{{ route('candidate.edit', $item->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal-{{ $item->id }}">Delete</a>
                                                </td>

                                                {{-- Delete Modal --}}
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel-{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Are You Sure
                                                                    You Want To Delete?</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <a href="{{ route('candidate.delete', $item->id) }}"
                                                                    class="btn btn-danger">Delete permanently</a>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
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
@endsection
