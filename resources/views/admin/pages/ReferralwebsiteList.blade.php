@extends('admin.layout')
@section('title')
Referral Website
@endsection
@section('content')
<section class="content mt-3">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-1 fw-bold">Referral Websites Table</h3>
                        <div class="card-tools">
                            <a href="{{ url('admin/referral_web_site/create') }}" class="btn btn-sm btn-primary fw-bold">Add
                                Referral Website</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap" id="ReferralLinkTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>UserName</th>
                                    <th>Category</th>
                                    <th>Canonicalized Name</th>
                                    <th>Logo</th>
                                    <th>Promo Terms</th>
                                    <th>Promo Url</th>
                                    <th>Promo Exp Date</th>
                                    <th>Payout</th>
                                    <th>Referee Share</th>
                                    <th>Referral Share</th>
                                    <th>Platform Share</th>
                                    <th>Expected Days</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($referral_website as $referral)
                                <tr>
                                    <td>{{ $referral->id }}</td>
                                    <td>
                                        @foreach ($user as $userItem)
                                        @if ($referral->user_id == $userItem->id)
                                        {{ $userItem->firstname }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($category as $categoryItem)
                                        @if ($referral->category_id == $categoryItem->id)
                                        {{ $categoryItem->name }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $referral->canonicalized_name }}</td>
                                    <td>{!! $referral->logo ? "<img src='" . asset('images/' . $referral->logo) . "' class='' style='width:50px'>" : '-' !!}</td>
                                    <td>{{ $referral->promo_terms }}</td>
                                    <td>{{ $referral->promo_terms_url }}</td>
                                    <td>{{ $referral->promo_expiration_date ?? '-' }}</td>
                                    <td>{{ $referral->expected_payout }}</td>
                                    <td>{{ $referral->referee_share_percentage }}</td>
                                    <td>{{ $referral->referral_share_percentage }}</td>
                                    <td>{{ $referral->platform_percentage }}</td>
                                    <td>{{ $referral->expected_days }}</td>
                                    <td>{{ $referral->status }}</td>
                                    <td class="d-flex">
                                        <form action="{{url('admin/referral_web_site/'.$referral->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="border rounded rounded-2 p-1 mx-2">
                                                <i class="fa-regular fa-trash-can fa-lg"></i>
                                            </button>
                                        </form>
                                        <a class="border rounded rounded-2 p-1 text-reset"
                                            href="{{ route('referral_web_site.edit', $referral->id) }}">
                                            <i class="fa-regular fa-pen-to-square fa-lg "></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="16" class="text-center">Referral Website Not Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="px-3 pt-3">{{ $referral_website->links() }}</div>
                </div>
                <!-- /.card -->
            </div>
        </div>
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
    // function DeleteReferralLink(id) {
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: '/admin/referral_website/' + id,
    //                 type: "DELETE",
    //                 data: {
    //                     _token: '{{ csrf_token() }}'
    //                 },
    //                 success: function(response) {
    //                 console.log(response);
    //                     if (response.success) {
    //                         Swal.fire({
    //                             icon: 'success',
    //                             title: 'Deleted!',
    //                             text: response.message,
    //                             toast: true,
    //                             position: 'top-end',
    //                             showConfirmButton: false,
    //                             timer: 3000,
    //                             timerProgressBar: true,
    //                             didOpen: (toast) => {
    //                                 toast.addEventListener('mouseenter', Swal.stopTimer)
    //                                 toast.addEventListener('mouseleave', Swal.resumeTimer)
    //                             }
    //                         });
    //                         $('#ReferralLinkTable').find('tr').filter(function() {
    //                             return $(this).find('td').first().text() == id;
    //                         }).remove();
    //                     } else {
    //                         Swal.fire({
    //                             icon: 'error',
    //                             title: 'Error!',
    //                             text: response.message,
    //                         });
    //                     }
    //                 },
    //                 error: function(xhr, status, error) {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Error!',
    //                         text: 'An error occurred while deleting the record.',
    //                     });
    //                 }
    //             });
    //         }
    //     });
    // }
</script>
@endsection