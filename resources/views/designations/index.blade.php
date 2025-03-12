<!-- resources/views/designations/index.blade.php -->
@extends('adminlte::page')

@section('title', 'Designations')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Designations</h1>
        <a href="{{ route('designations.create') }}" class="btn btn-primary">Add New Designation</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="alert-container"></div>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($designations as $designation)
                        <tr>
                            <td>{{ $designation->title }}</td>
                            <td>
                                <span class="badge {{ $designation->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $designation->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('designations.edit', $designation) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop


