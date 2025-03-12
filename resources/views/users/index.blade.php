<!-- resources/views/users/index.blade.php -->
@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Users</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filters</h3>
        </div>
        <div class="card-body">
            <form id="filter-form" class="form-inline">
                <div class="form-group mr-3">
                    <label for="designation_id" class="mr-2">Designation:</label>
                    <select class="form-control" id="designation_id" name="designation_id">
                        <option value="">All Designations</option>
                        @foreach($designations as $designation)
                            <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group mr-3">
                    <label for="status" class="mr-2">Status:</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <button type="button" id="reset-filters" class="btn btn-default ml-2">Reset</button>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div id="alert-container"></div>
            
            <div id="users-list">
                @include('users.partials.list')
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {
            // Handle filter form submission
            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: '{{ route("users.index") }}',
                    method: 'GET',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#users-list').html(response.html);
                    }
                });
            });
            
            // Reset filters
            $('#reset-filters').on('click', function() {
                $('#designation_id').val('');
                $('#status').val('');
                $('#filter-form').trigger('submit');
            });
        });
    </script>
@stop

