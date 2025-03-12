<!-- resources/views/users/edit.blade.php -->
@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User: {{ $user->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="alert-container"></div>
                    
                    <form id="user-form" action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            <div class="invalid-feedback" id="name-error"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            <div class="invalid-feedback" id="email-error"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="invalid-feedback" id="password-error"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $user->contact_number }}" required>
                            <div class="invalid-feedback" id="contact_number-error"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="alternative_contact_number">Alternative Contact Number</label>
                            <input type="text" class="form-control" id="alternative_contact_number" name="alternative_contact_number" value="{{ $user->alternative_contact_number }}">
                            <div class="invalid-feedback" id="alternative_contact_number-error"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3">{{ $user->address }}</textarea>
                            <div class="invalid-feedback" id="address-error"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="designation_id">Designation</label>
                            <select class="form-control" id="designation_id" name="designation_id" required>
                                <option value="">Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->id }}" {{ $user->designation_id == $designation->id ? 'selected' : '' }}>
                                        {{ $designation->title }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="designation_id-error"></div>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $user->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {
            $('#user-form').on('submit', function(e) {
                e.preventDefault();
                
                // Reset validation errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#alert-container').html(
                            '<div class="alert alert-success alert-dismissible">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            response.message +
                            '</div>'
                        );
                        
                        setTimeout(function() {
                            window.location.href = '{{ route("users.index") }}';
                        }, 1500);
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '-error').text(value[0]);
                        });
                        
                        $('#alert-container').html(
                            '<div class="alert alert-danger alert-dismissible">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            'Please correct the errors in the form.' +
                            '</div>'
                        );
                    }
                });
            });
        });
    </script>
@stop