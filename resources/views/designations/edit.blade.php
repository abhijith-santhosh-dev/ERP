<!-- resources/views/designations/edit.blade.php -->
@extends('adminlte::page')

@section('title', 'Edit Designation')

@section('content_header')
    <h1>Edit Designation: {{ $designation->title }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="alert-container"></div>
                    
                    <form id="designation-form" action="{{ route('designations.update', $designation) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $designation->title }}" required>
                            <div class="invalid-feedback" id="title-error"></div>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $designation->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('designations.index') }}" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {
            $('#designation-form').on('submit', function(e) {
                e.preventDefault();
                
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
                            window.location.href = '{{ route("designations.index") }}';
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