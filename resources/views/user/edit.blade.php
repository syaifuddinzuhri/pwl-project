@extends('layouts.main')

@section('title', 'Manajemen User')


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
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item">Manajemen User</li>
                        <li class="breadcrumb-item">Data User</li>
                        <li class="breadcrumb-item">Edit User</li>
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
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit User</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form-material" action="{{route('user.update', $user->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group form-primary  ">
                                            <label for=" name">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
                                            <span class="form-bar"></span>
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="no_ktp">Nomor KTP</label>
                                            <input type="number" class="form-control" name="no_ktp" id="no_ktp" value="{{ $user->no_ktp }}" required>

                                            <span class="form-bar"></span>
                                            @error('no_ktp')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>

                                            <span class="form-bar"></span>
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select class="form-control" name="gender" id="gender" required>
                                                <option selected disabled></option>
                                                <option value="lk" {{$user->gender == "lk" ? 'selected' : ''}}>Laki-laki</option>
                                                <option value="pr" {{$user->gender == "pr" ? 'selected' : ''}}>Perempuan</option>
                                            </select>
                                            <span class="form-bar"></span>
                                            @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="phone">Nomor HP</label>
                                            <input type="number" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" required>

                                            <span class="form-bar"></span>
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="address">Alamat</label>
                                            <textarea class="form-control" name="address" rows="3" id="address" required>{{ $user->address }}</textarea>

                                            <span class="form-bar"></span>
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="role">Role</label>
                                            <select class="form-control" name="role" id="role" required>
                                                <option selected disabled></option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" {{$user->roles[0]->id == $role->id ? 'selected' : ''}}>{{ $role->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-bar"></span>
                                            @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
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
<script src="{{ asset('js/user.js')}}" type="module"></script>
@endsection
