@extends('layouts.master')

@section('title', 'المنتوجات | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> إدارة المنتوجات</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المنتوجات</li>
                <li class="breadcrumb-item active"><a href="#">الإدارة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('product-create')
            <div>
                <a class="btn btn-primary" href="{{ route('product.create') }}"><i class="fa fa-plus"></i> أضف منتج</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>المنتج</th>
                                <th>ثمن العلبة</th>
                                <th>عدد العلب</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                @if ($product)
                                    <tr>
                                        <td style="display: flex"><img
                                                style="width: 45px; height: 45px; object-fit: cover; border-radius: 6px;
                                                margin-inline-end: 6px;"
                                                src="{{ asset('images/product/' . $product->image) }}">
                                            <div>
                                                <h6 class="m-0">{{ $product->name }}</h6>
                                                <span
                                                    style="font-size: 15px; color: #535353;">{{ $product->model }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $product->box_price }} درهم</td>
                                        <td>{{ $product->box_qty }} علبة</td>

                                        <td>
                                            @can('product-edit')
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{ route('product.edit', $product->id) }}"><i
                                                        class="fa fa-edit m-0"></i></a>
                                            @endcan
                                            @can('product-delete')
                                                <button class="btn btn-danger btn-sm waves-effect" type="submit"
                                                        onclick="deleteTag({{ $product->id }})">
                                                    <i class="fa fa-trash m-0"></i>
                                                </button>
                                                <form id="delete-form-{{ $product->id }}"
                                                      action="{{ route('product.destroy', $product->id) }}"
                                                      method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endif
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
