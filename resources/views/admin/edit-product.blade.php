@extends('admin.master')

@section('content')
    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center h-100 w-100">
                            <div class="">
                                <h5 class="m-0 font-weight-bold text-primary">Edit Product</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{url('/admin/edit-product/'.$product->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="titleProduct" class="form-control" value="{{old('title') ?? $product->title}}" name="title">
                                </div>

                                <div class="form-group">
                                    <input type="number" id="titlePrice" class="form-control" value="{{old('price') ?? $product->price}}" name="price">
                                </div>

                                <div class="form-group">
                                    <select name="category_id" class="form-control" id="selectCategory">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="file" id="titleIMage" class="form-control" name="image"><br>
                                    <img src="{{asset('uploads/images/'.$product->image)}}" width="70px" height="50px" alt="">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Edit Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
       

@endsection
@section('footer_asset')
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
@endsection
@section('head_asset')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">  
@endsection

