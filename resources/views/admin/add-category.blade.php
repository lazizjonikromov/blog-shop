@extends('admin.master')

@section('content')
    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center h-100 w-100">
                            <div class="">
                                <h5 class="m-0 font-weight-bold text-primary">Category Add</h5>
                            </div>
                            <div class="">
                                @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                    {!! \Session::get('success') !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{url('/admin/add-category')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="nameCategory" class="form-control" placeholder="Name" name="name">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Category Add</button>
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

