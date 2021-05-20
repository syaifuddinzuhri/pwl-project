@extends('layouts.main')

@section('title', 'Edit Role')

@section('pageCSS')
@endsection

@section('content')
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Manajamen User</h5>
                        <p class="m-b-0">Selamat Datang di Premium RentCar</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item">Manajemen User</li>
                        <li class="breadcrumb-item"><a href="{{ route('role.index')}}">Data Roles</a></li>
                        <li class="breadcrumb-item">Edit Role</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <a href="{{ route('role.index')}}" class="btn btn-outline-secondary"><i class="fa fa-mail-reply"></i>Kembali</a>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit Role</h5>
                                </div>
                                <div class="card-body">
                                    <form class="md-float-material form-material" id="form-edit-role">
                                        {!! Form::hidden('id', $role->id, ['id' => 'id']) !!}
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Nama Role</label>
                                            <div class="col-md-10 form-input">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama role" value="{{ $role->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Permissions</label>
                                            <div class="col-md-10 ">
                                                <div class="row ">
                                                    <div class="col-12">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="permissionsList" id="selectAll">
                                                            <label class="form-check-label" for="selectAll">Pilih semua</label>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                    @foreach ($permissions as $p)
                                                    <div class="col-md-3 col-6 mb-2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="chk-{{$p->id}}" value="{{$p->id}}" name="permissions[]" @foreach ($roleHasPermissions as $rp) @if ($rp->pivot->permission_id == $p->id)
                                                            {{ 'checked'}}
                                                            @endif
                                                            @endforeach
                                                            >
                                                            <label class="form-check-label" for="chk-{{$p->id}}">{{ $p->name }}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-loading" type="button" disabled>Loading...</button>
                                        <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i>Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('pageScript')
<script src="{{ asset('admin-templates') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('admin-templates') }}/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="{{ asset('js/role.js')}}" type="module"></script>
@endsection
