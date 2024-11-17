@extends('layouts.master')

@section('title', 'إنشاء فاتورة | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> إنشاء فاتورة</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">الفواتير</li>
                <li class="breadcrumb-item"><a href="#">الإنشاء</a></li>
            </ul>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row">
            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">استمارة الإنشاء</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{ route('invoice.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="control-label">الزبون</label>
                                    <select name="customer_id" class="form-control">
                                        <option>اختر الزبون</option>
                                        @foreach ($customers as $customer)
                                            <option name="customer_id" value="{{ $customer->id }}">{{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="control-label">تاريخ الفاتورة</label>
                                    <input name="date" class="form-control datepicker"
                                           value="<?php echo date('Y-m-d'); ?>"
                                           type="date" placeholder="Enter your email">
                                </div>
                            </div>


                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">المنتج</th>
                                    <th scope="col">عدد العلب</th>
                                    <th scope="col">ثمن العلبة</th>
                                    <th scope="col">تخفيض %</th>
                                    <th scope="col">العدد * الثمن</th>
                                    <th scope="col" style="cursor: pointer"><a
                                            class="addRow badge badge-success text-white"><i class="fa fa-plus"></i>
                                            أضف</a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><select name="product_id[]" class="form-control productname">
                                            <option>اختر منتج</option>
                                            @foreach ($products as $product)
                                                <option name="product_id[]" value="{{ $product->id }}">
                                                    {{ $product->name }}</option>
                                            @endforeach
                                        </select></td>
                                    <td><input type="text" value="0" name="qty[]" class="form-control qty">
                                    </td>
                                    <td><input type="text" value="0" name="price[]" class="form-control price">
                                    </td>
                                    <td><input type="text" value="0" name="dis[]" class="form-control dis">
                                    </td>
                                    <td><input type="text" value="0" name="amount[]"
                                               class="form-control amount"></td>
                                    <td><a class="btn btn-danger remove"> <i
                                                class="fa fa-remove m-0 text-white"></i></a></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>المجموع</b></td>
                                    <td><b class="total"></b><input name="total_price" type="text" hidden></td>
                                    <td></td>
                                </tr>
                                </tfoot>

                            </table>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-plus"></i>إنشاء
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>


    </main>

@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="{{ asset('/') }}js/multifield/jquery.multifield.min.js"></script>




    <script type="text/javascript">
        $(document).ready(function () {


            $('tbody').delegate('.productname', 'change', function () {

                var tr = $(this).parent().parent();
                tr.find('.qty').focus();

            })

            $('tbody').delegate('.productname', 'change', function () {

                var tr = $(this).parent().parent();
                var id = tr.find('.productname').val();

                $.ajax({
                    type: 'GET',
                    url: '{!! URL::route('findPrice') !!}',

                    dataType: 'json',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        'id': id
                    },
                    success: function (data) {
                        tr.find('.price').val(data.box_price);
                    }
                });
            });

            $('tbody').delegate('.qty,.price,.dis', 'keyup', function () {

                var tr = $(this).parent().parent();
                var qty = tr.find('.qty').val();
                var price = tr.find('.price').val();
                var dis = tr.find('.dis').val();
                var amount = (qty * price) - (qty * price * dis) / 100;
                tr.find('.amount').val(amount);
                total();
            });

            function total() {
                var total = 0;
                $('.amount').each(function (i, e) {
                    var amount = $(this).val() - 0;
                    total += amount;
                })
                $('.total').html(`${total} درهم`);
                tr.find('[name="total_price"]').val(amount);
            }

            $('.addRow').on('click', function () {
                addRow();

            });

            function addRow() {
                var addRow = `<tr><td><select name="product_id[]" class="form-control productname">
                                                <option>اختر منتج</option>
                                                @foreach ($products as $product)
                                                    <option name="product_id[]" value="{{ $product->id }}">
                                                        {{ $product->name }}</option>
                                                @endforeach
                                    </select></td>
                    <td><input type="text" value="0" name="qty[]" class="form-control qty">
                    </td>
                    <td><input type="text" value="0" name="price[]" class="form-control price">
                    </td>
                    <td><input type="text" value="0" name="dis[]" class="form-control dis">
                    </td>
                    <td><input type="text" value="0" name="amount[]"
                            class="form-control amount"></td>
                    <td><a class="btn btn-danger remove"> <i
                                class="fa fa-remove m-0 text-white"></i></a></td>
                </tr>`;
                $('tbody').append(addRow);
            }


            $('.remove').live('click', function () {
                var l = $('tbody tr').length;
                if (l == 1) {
                    alert('you cant delete last one')
                } else {

                    $(this).parent().parent().remove();

                }

            });
        });
    </script>
@endpush
