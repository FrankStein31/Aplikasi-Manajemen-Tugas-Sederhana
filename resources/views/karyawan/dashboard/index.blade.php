@extends('layouts.karyawan.app')
@section('title', 'Dashboard')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</h1>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if($user->status === 'ditugaskan')
                                <span class="text-success"><i class="fas fa-check-circle mr-2"></i>Ditugaskan</span>
                            @else
                                <span class="text-warning"><i class="fas fa-clock mr-2"></i>Belum Ditugaskan</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        @if($user->status === 'ditugaskan')
                            <i class="fas fa-user-check fa-3x text-gray-300"></i>
                        @else
                            <i class="fas fa-user-clock fa-3x text-gray-300"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
