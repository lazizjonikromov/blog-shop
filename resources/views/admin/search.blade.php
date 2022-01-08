@extends('admin.master')
@section('head_asset')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">  
@endsection
@section('content')
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center h-100 w-100">
                            <div class="">
                                <h5 class="m-0 font-weight-bold text-primary">Product</h5>
                            </div>
                            <div class="">
                                @if (\Session::has('success'))
                                <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                                </div>
                                @endif
                            </div>
                            <form type="get" action="{{url('/admin/search')}}">
                                <div class="d-flex">
                                    <div class="" style="margin-right:10px;">
                                        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary" type="submit">Search Products</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach($products as $product)
                                    <tbody>
                                        <td>{{$product['title']}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->category->name ?? 'No Category' }}</td>
                                        <td>
                                            <img src="{{asset('uploads/images/'.$product->image)}}" width="70px" height="50px" alt="">
                                        </td>
                                        <td>
                                            <a href="{{url('/admin/edit-product/'.$product->id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{url('/admin/delete-product/'.$product->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tbody>
                                    @endforeach
                                </table>
                                <div class="d-flex justify-content-center w-100">
                                    <div class="">
                                        {{ $products->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


@endsection
@section('footer_asset')
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script> -->
@endsection


