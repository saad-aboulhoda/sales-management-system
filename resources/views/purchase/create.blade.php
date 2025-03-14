@extends('layouts.master')

@section('title', 'شراء | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> شراء</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">المشتريات</li>
                <li class="breadcrumb-item"><a href="#">الشراء</a></li>
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
                    <h3 class="tile-title">استمارة الشراء</h3>
                    <div class="tile-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('purchase.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="control-label">المورد</label>
                                    <select name="supplier_id" class="form-control">
                                        <option>اختر مورد</option>
                                        @foreach ($suppliers as $supplier)
                                            <option name="supplier_id" value="{{ $supplier->id }}">{{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="control-label">تاريخ الشراء</label>
                                    <input name="date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>"
                                        type="date">
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">المنتج</th>
                                        <th scope="col">ثمن العلبة</th>
                                        <th scope="col">عدد العلب</th>
                                        <th scope="col">الثمن * العدد</th>
                                        <th scope="col" style="cursor: pointer"><a class="addRow badge badge-success text-white"><i
                                            class="fa fa-plus"></i> أضف</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><select name="product_id[]" class="form-control productname">
                                                <option>اختر المنتج</option>
                                                @foreach ($products as $product)
                                                    <option name="product_id[]" value="{{ $product->id }}">
                                                        {{ $product->name }}</option>
                                                @endforeach
                                            </select></td>
                                        <td><input type="text" name="box_price[]" class="form-control price"></td>
                                        <td><input type="text" name="box_qty[]" class="form-control qty"></td>
                                        <td>
                                            <input type="text" name="total_price[]" class="form-control amount"
                                                readonly></input>
                                        </td>
                                        <td><a class="btn btn-danger remove"> <i class="fa fa-remove m-0"
                                                    style="color: white"></i></a></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><b>المجموع</b></td>
                                        <td><b class="total"></b><input type="text" name="price" hidden></td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-usd"></i>شراء
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
        $(document).ready(function() {
            $('tbody').delegate('.productname', 'change', function() {
                var tr = $(this).parent().parent();
                tr.find('.price').focus();
            })

            $('tbody').delegate('.qty,.price', 'keyup', function() {
                var tr = $(this).parent().parent();
                var qty = tr.find('.qty').val();
                var price = tr.find('.price').val();
                var amount = (qty * price);
                tr.find('.amount').val(amount);
                total();
            });

            function total() {
                var total = 0;
                $('.amount').each(function(i, e) {
                    var amount = $(this).val() - 0;
                    total += amount;
                })
                $('.total').text(`${total} درهم`);
                $('[name="price"]').val(total);
            }

            $('.addRow').on('click', function() {
                addRow();

            });

            function addRow() {
                var addRow = `<tr>
                                        <td><select name="product_id[]" class="form-control productname">
                                                <option>اختر المنتج</option>
                                                @foreach ($products as $product)
                                                    <option name="product_id[]" value="{{ $product->id }}">
                                                        {{ $product->name }}</option>
                                                @endforeach
                                            </select></td>
                                        <td><input type="text" name="box_price[]" class="form-control price"></td>
                                        <td><input type="text" name="box_qty[]" class="form-control qty"></td>
                                        <td>
                                            <input type="text" name="total_price[]" class="form-control amount"
                                                readonly></input>
                                        </td>
                                        <td><a class="btn btn-danger remove"> <i class="fa fa-remove m-0"
                                                    style="color: white"></i></a></td>
                                    </tr>`;
                $('tbody').append(addRow);
            };


            $('.remove').live('click', function() {
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
