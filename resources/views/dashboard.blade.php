@extends('layouts.main')

@section('content')

<div class="page-header">
    <div class="page-header-title">
        <h4>Dashboard</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="index-2.html">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
            </li>
        </ul>
    </div>
</div>
<div class="page-body">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-3 text-center">
                            <i class="icofont icofont-eye-alt text-success" style="font-size: 50px"></i>
                        </div>
                        <div class="col-9 text-center">
                            <h5>10k</h5>
                            <span>Visitors</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-3 text-center">
                            <i class="icofont icofont-eye-alt text-success" style="font-size: 50px"></i>
                        </div>
                        <div class="col-9 text-center">
                            <h5>10k</h5>
                            <span>Visitors</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-3 text-center">
                            <i class="icofont icofont-eye-alt text-success" style="font-size: 50px"></i>
                        </div>
                        <div class="col-9 text-center">
                            <h5>10k</h5>
                            <span>Visitors</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
