@php
use Illuminate\Support\Str;
@endphp
@extends('admin.layout')
@section('title', 'Referee')
@section('content')
<!-- Main content -->
<section class="content mt-3">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-1 fw-bold">Referee Table</h3>
                        <div class="card-tools">
                            <a href="{{url('admin/referee/create')}}" class="btn btn-sm btn-primary fw-bold">Add Referee</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap" id="UserTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>UserName</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Logo</th>
                                    <th>Usertype</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>About</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($referees as $referee)
                                <tr>
                                    <td>{{ $referee->id }}</td>
                                    <td>{{ $referee->firstname }} {{ $referee->lastname }}</td>
                                    <td>{{ $referee->username }}</td>
                                    <td>{{ $referee->email }}</td>
                                    <td>{{ $referee->phone == '' ? '-' : $referee->phone }}</td>
                                    <td>{!! $referee->logo == '' ? '-' : "<img src='" . asset('images/' . $referee->logo) . "' class='' style='width:50px'>" !!}</td>
                                    <td>{{$referee->usertype}}</td>
                                    <td>{{ $referee->address == '' ? '-' : Str::limit($referee->address,5,'...')}}</td>
                                    <td>{{ $referee->status == 1 ? 'Active' : '-' }}</td>
                                    <td>{{ $referee->about == '' ? '-' : Str::limit($referee->about,5,'...') }}</td>
                                    <td class="d-flex">
                                        <form action="{{url('admin/referee/'.$referee->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="border rounded rounded-2 p-1 mx-2">
                                                <i class="fa-regular fa-trash-can fa-lg"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('referee.edit', $referee->id) }}" class="border rounded rounded-2 p-1 text-reset">
                                            <i class="fa-regular fa-pen-to-square fa-lg "></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr >
                                    <td >No User Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 mt-2">
                        {{$referees->links()}}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('message'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('message')}}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    @endif
    // function DeleteUser(id) {
    //     $.ajax({
    //         url: '/admin/users/' + id,
    //         type: "Delete",
    //         data: {
    //             _token: '{{ csrf_token() }}'
    //         },
    //         success: function(response) {
    //             if (response.success) {
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Success',
    //                     text: response.message,
    //                     toast: true,
    //                     position: 'top-end',
    //                     showConfirmButton: false,
    //                     timer: 4000,
    //                     timerProgressBar: true,
    //                     didOpen: (toast) => {
    //                         toast.addEventListener('mouseenter', Swal
    //                             .stopTimer)
    //                         toast.addEventListener('mouseleave', Swal
    //                             .resumeTimer)
    //                     }
    //                 });
    //                 $('#UserTable').find('tr').filter(function() {
    //                     return $(this).find('td').first().text() == id;
    //                 }).remove();

    //             } else {
    //                 alert(response.message);
    //             }
    //         }
    //     })
    // }
</script>
@endsection