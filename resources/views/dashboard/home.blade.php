@extends('layouts.admin-dash')
@section('title','HelpDesk')
@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
 <!-- LINE CHART -->
 <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Line Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
  <!-- /.card -->
  </div>
    <!-- /.col (LEFT) -->
    <div class="col-md-6">
           
  <!-- STACKED BAR CHART -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Bar Chart</h3>

          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
               <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col (RIGHT) -->
  </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- end main content -->

<!-- data gathering for charts-->
@php
$op_data_bar = 0;
$cd_data_bar=0;
foreach ($issues as $issue)
if ($issue->status==="Open")
$op_data_bar=$op_data_bar+1;
else 
$cd_data_bar=$cd_data_bar+1;


$sev_don_1=0;
$sev_don_2=0;
$sev_don_3=0;
$sev_don_4=0;
$sev_don_5=0;
$sev_don_6=0;
$sev_don_7=0;
$sev_don_8=0;
$sev_don_9=0;
$sev_don_10=0;

foreach ($issues as $issue)
switch ($issue->severity){
case "1" :
  $sev_don_1++;break;
case "2" :
  $sev_don_2++;break;
case "3" :
  $sev_don_3++;break;
case "4" :
  $sev_don_4++;break;
case "5" :
  $sev_don_5++;break;
case "6" :
  $sev_don_6++;break;
case "7" :
  $sev_don_7++;break;
case "8" :
  $sev_don_8++;break;
case "9" :
  $sev_don_9++;break;
case "10" :
  $sev_don_10++;break;
}
@endphp

@endsection