@extends('layouts.master')

@section('titel', 'الزبائن | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> إدارة الزبائن</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">الزبائن</li>
                <li class="breadcrumb-item active"><a href="#">الإدارة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('customer-create')
            <div>
                <a class="btn btn-primary" href="{{ route('customer.create') }}"><i class="fa fa-plus"></i> إضافة زبون
                    جديد</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>الزبون</th>
                                <th>العنوان</th>
                                <th>الهاتف</th>
                                <th>ملاحظات</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }} </td>
                                    <td>{{ $customer->address }} </td>
                                    <td>{{ $customer->mobile }} </td>
                                    <td>{{ $customer->notes }} </td>
                                    <td>
                                        @can('customer-edit')
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('customer.edit', $customer->id) }}"><i
                                                    class="fa fa-edit m-0"></i></a>
                                        @endcan
                                        @can('customer-delete')
                                            <button class="btn btn-danger btn-sm waves-effect" type="submit"
                                                    onclick="deleteTag({{ $customer->id }})">
                                                <i class="fa fa-trash m-0"></i>
                                            </button>
                                            <form id="delete-form-{{ $customer->id }}"
                                                  action="{{ route('customer.destroy', $customer->id) }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/ar.json',
            },
        });
    </script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteTag(id) {
            swal({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم، احذفه!',
                cancelButtonText: 'لا، إلغاء!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'تم الإلغاء',
                        'بياناتك آمنة :)',
                        'error'
                    );
                }
            })
        }
    </script>
@endpush
