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
                                <div id="sampleTable_filter" style="display: none" class="dataTables_filter"><label
                                        style="display: flex; align-items: center">ابحث:<input type="search"
                                                                                               class="form-control form-control-sm mr-1"
                                                                                               placeholder="مثال بحث"
                                                                                               aria-controls="sampleTable"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="category-item col-6 col-lg-4 col-xl-2 p-1">
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
                                                <a href="{{ route('category.edit', $category->id) }}"
                                                   class="edit-caregory-btn"><i
                                                        class="fa fa-edit m-0"></i></a>
                                            @endcan
                                            @can('category-delete')
                                                <button onclick="deleteTag({{ $category->id }})"
                                                        class="delete-caregory-btn"><i
                                                        class="fa fa-trash m-0"></i></button>
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
                                <div id="pagination-info">يعرض 0
                                    إلى 0 من أصل 0 مُدخل
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7"
                                 style="display: flex; align-items: center; justify-content: end">
                                <div>
                                    <ul class="pagination m-0">
                                        <li class="paginate_button page-item previous" id="sampleTable_previous"><a href="#" class="page-link">السابق</a></li>
                                        <li class="paginate_button page-item next" id="sampleTable_next"><a href="#" class="page-link">التالي</a></li>
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

@component('components.sweetalertjs')
@endcomponent
@push('js')
    <script type="text/javascript">
        // Category List
        const categories = document.querySelectorAll('.category-item');

        // Filter with Search Bar
        const searchBar = document.querySelector('#sampleTable_filter input');
        searchBar.addEventListener('keyup', function (e) {
            const searchValue = e.target.value.toLowerCase();
            categories.forEach(category => {
                const title = category.querySelector('.category-title').textContent.toLowerCase();
                if (title.includes(searchValue)) {
                    category.style.display = 'block';
                } else {
                    category.style.display = 'none';
                }
            });
        });


        // Pagination Feature
        const itemsPerPage = document.querySelector('#sampleTable_length select');
        let currentPage = 1;
        let totalPages = Math.ceil(categories.length / itemsPerPage.value);

        itemsPerPage.addEventListener('change', function (e) {
            currentPage = 1;
            totalPages = Math.ceil(categories.length / e.target.value);
            updatePagination();
            numberedPages();
            updatePaginationInfo();
        });

        function updatePagination() {
            const start = (currentPage - 1) * itemsPerPage.value;
            const end = start + itemsPerPage.value;
            categories.forEach((category, index) => {
                if (index >= start && index < end) {
                    category.style.display = 'block';
                } else {
                    category.style.display = 'none';
                }
            });
        }

        updatePagination();

        // Disable Next and Previous Buttons if there's no more than one page
        const previousBtn = document.getElementById('sampleTable_previous');
        const nextBtn = document.getElementById('sampleTable_next');
        if (totalPages <= 1) {
            previousBtn.classList.add('disabled');
            nextBtn.classList.add('disabled');
        }

        const pagination = document.querySelector('.pagination');
        pagination.addEventListener('click', function (e) {
            if (e.target.textContent === 'السابق') {
                if (currentPage > 1) {
                    currentPage--;
                }
            } else if (e.target.textContent === 'التالي') {
                if (currentPage < totalPages) {
                    currentPage++;
                }
            } else {
                // remove active from the others
                const pages = document.querySelectorAll('.paginate_button');
                pages.forEach(page => {
                    page.classList.remove('active');
                });
                e.target.parentElement.classList.add('active');
                currentPage = parseInt(e.target.textContent);
            }
            updatePagination();
        });
        // Add number of each pages between next and previous buttons and when that number is clicked, show the items of that page
        function numberedPages() {
            // Remove first anything between next and previous buttons
            const pages = document.querySelectorAll('.paginate_button');
            pages.forEach(page => {
                if (page !== previousBtn && page !== nextBtn) {
                    page.remove();
                }
            });
            for (let i = 0; i < totalPages; i++) {
                const numberedPages = document.createElement('li');
                numberedPages.classList.add('paginate_button', 'page-item');
                numberedPages.innerHTML = `<a href="#" class="page-link">${i+1}</a>`;
                pagination.insertBefore(numberedPages, nextBtn);
            }
            pagination.children[1].classList.add('active');
        }
        numberedPages();

        // Add number of pages, and current page
        function updatePaginationInfo() {
            const paginationInfo = document.getElementById('pagination-info');
            paginationInfo.textContent = `يعرض ${currentPage} إلى ${currentPage * itemsPerPage.value} من أصل ${categories.length} مُدخل`;
        }

        updatePaginationInfo();



    </script>
@endpush
