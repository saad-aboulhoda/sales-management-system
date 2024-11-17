@extends('layouts.master')

@section('title', 'التصنيفات | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> لائحة التصنيفات</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">التصنيفات</li>
                <li class="breadcrumb-item active"><a href="#">الإدارة</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @can('category-create')
            <div>
                <a class="btn btn-primary" href="{{ route('category.create') }}"><i class="fa fa-plus"></i> أضف تصنيف
                    جديد</a>
            </div>
        @endcan

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="sampleTable_length"><label
                                        style="display: flex; align-items:center">أظهر <select name="sampleTable_length"
                                                                                               aria-controls="sampleTable"
                                                                                               class="form-control form-control-sm"
                                                                                               style="margin: 0 4px">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> مدخلات</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="sampleTable_filter" class="dataTables_filter"><label
                                        style="display: flex; align-items: center">ابحث:<input type="search"
                                                                                               class="form-control form-control-sm mr-1"
                                                                                               placeholder="مثال بحث"
                                                                                               aria-controls="sampleTable"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-6 col-lg-4 col-xl-2 p-1">
                                    <div class="category-container">
                                        <div class="category-img-overlay"></div>
                                        <img class="category-img"
                                             src="{{ asset('images/category/' . $category->image) }}"/>
                                        <div class="category-body">
                                            <div class="category-title">{{ $category->name }}</div>
                                        </div>
                                        <div class="category-status">
                                            @if ($category->status)
                                                <span class="active"></span>
                                            @else
                                                <span class="inactive"></span>
                                            @endif
                                        </div>
                                        <div class="category-action">
                                            @can('category-edit')
                                                <a class="edit-caregory-btn"
                                                   href="{{ route('category.edit', $category->id) }}"
                                                   class="btn btn-primary"><i class="fa fa-edit m-0"></i></a>
                                            @endcan
                                            @can('category-delete')
                                                <button class="delete-caregory-btn"
                                                        onclick="deleteTag({{ $category->id }})"
                                                        class="btn btn-danger"><i class="fa fa-trash m-0"></i></button>
                                                <form id="delete-form-{{ $category->id }}"
                                                      action="{{ route('category.destroy', $category->id) }}"
                                                      method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-5" style="display: flex; align-items: center">
                                <div>يعرض 0
                                    إلى 0 من أصل 0 مُدخل
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7"
                                 style="display: flex; align-items: center; justify-content: end">
                                <div>
                                    <ul class="pagination m-0">
                                        <li><a href="#" aria-controls="sampleTable" data-dt-idx="0" tabindex="0"
                                               class="page-link">السابق</a></li>
                                        <li><a href="#" aria-controls="sampleTable" data-dt-idx="1" tabindex="0"
                                               class="page-link">التالي</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('js')
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
                    )
                }
            })
        }
    </script>
@endpush
