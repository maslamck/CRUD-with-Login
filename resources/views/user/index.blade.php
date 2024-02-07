@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="fw-semibold"></div>{{ $message }}
                    <button class="btn-close" type="button" data-coreui-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td><a href="{{ route('users.edit', $user->id) }}">Edit</a>
                                            <a href="{{ url('destroy-user/'.$user->id) }}" class="text-danger delete" id="{{$user->id}}">Delete</a>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_script')
{{-- <script>
    jQuery(document).ready(function($) {
        $(document).on('click', '.delete', function() {
            alert('hi');
            var id = $(this).attr('id');

            $('#delete_id').val(id);
        });
        $("#confirm_delete_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var id = $('#delete_id').val();

            $.ajax({
                url: '{{ url('destroy-user') }}' + '/' + id,
                method: "DELETE",

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#confirm_delete').modal('hide');
                    location.reload(true);

                },
                error: function(response) {
                    $('#confirm_delete').modal('hide');

                }
            });
        });
       
    });
</script> --}}
@endpush
