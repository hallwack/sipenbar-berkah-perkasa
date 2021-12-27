@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 mx-md-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content mx-md-3">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <select class="form-control select2" id="product-name" style="width: 100%;">
                    @foreach ($products as $product)    
                      <option value="{{ $product->id }}" data-id="{{ $product->id }}" data-name="{{ $product->product_name }}" data-price="{{ $product->product_price }}" data-code="{{ $product->product_code }}">{{ $product->product_name }} ({{ $product->product_price }})</option>
                    @endforeach
                  </select>
                  <button onclick="addProduct()" class="btn btn-primary mt-3">Add Product</button>

                  <button id="delete-product" class="btn btn-danger mt-3">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <form action="{{ url('admin/cashier')}}" method="POST">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="card card-default">
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Product Price</th>
                        <th style="width: 15%">Quantity</th>
                      </tr>
                    </thead>
                    <tbody id="list-detail">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card card-default">
                <div class="card-body">
                  <div class="form-group">
                    <label for="customer">Customer</label>
                    <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer" name="customer" value="{{ old('customer') }}" required>
                    @error('customer')
                      <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div>
          </div>

        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('custom-script')
  <script>
    $(function () {
      $('.select2').select2();
    });

    function addProduct() {
      $("#list-detail")
        .append(`
          <tr id="list-product" data-product="${$('#product-name').find(':selected').data('name')}">
            <input name="product_id" type="hidden" value="${$('#product-name').find(':selected').data('id')}">
            <td><input name="product_name" type="hidden" value="${$('#product-name').find(':selected').data('name')}">${$('#product-name').find(':selected').data('name')}</td>
            <td><input name="product_code" type="hidden" value="${$('#product-name').find(':selected').data('code')}">${$('#product-name').find(':selected').data('code')}</td>
            <td><input name="product_price" type="hidden" value="${$('#product-name').find(':selected').data('price')}">${$('#product-name').find(':selected').data('price')}</td>
            <td>
              <input class="form-control form-control-border" type="number" name="product_quantity" min="0">
            </td>
          </tr>`);
    }

    $('#delete-product').click(function () {
      $('#list-detail').children().remove();
    })

  </script>
@endpush