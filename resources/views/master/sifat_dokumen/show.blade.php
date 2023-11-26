@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Role</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="card-title">Show Role</h4>
                <p class="card-description"> Detail Permission </p>
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control text-dark" name="name" value="{{$role->name}}" id="exampleInputName1" placeholder="Enter Role Name" readonly>
                </div>
                <div class="row">
                    @foreach ( $permissions as $permision )
                        <div class="col-3">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox{{ $permision->id}}" name="permission[]"  value="{{ $permision->id}}" {{ in_array($permision->id, $rolePermissions) ? 'checked' : ''}} disabled>
                                    <label for="customCheckbox{{ $permision->id}}" class="custom-control-label">{{ $permision->name }}</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="#" class="btn btn-dark" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Cancel</a>
              </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.c  ontent-wrapper -->
@endsection

@push('addon-style')

@endpush

@push('addon-script')
    
@endpush