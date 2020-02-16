@extends('layout.templete')
@section('content')
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Loan
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                @if(Session::has('message'))
                <div class="alert alert-dismissable text-center {{ Session::get('alert-class', 'alert-danger') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {{ Session::get('message') }} </div>
                @endif
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light form-fit ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject font-green bold uppercase">Create
                                                    Loan</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <form method="POST" action="{{ url('/loan') }}"
                                                class="form-horizontal form-bordered">
                                                {{ csrf_field() }}
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Loan Amount:</label>
                                                        <div class="col-md-4 input-group">
                                                            <input class="form-control" name="amount" type="number"
                                                                min="1000" max="100000000" value="{{old('amount')}}"
                                                                required />
                                                            <span class="input-group-addon">฿</span>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Loan Term:</label>
                                                        <div class="col-md-4 input-group">
                                                            <input class="form-control" name="term" type="number"
                                                                min="1" max="50" value="{{old('term')}}" required />
                                                            <span class="input-group-addon">Years</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Interest Rate:</label>
                                                        <div class="col-md-4 input-group">
                                                            <input class="form-control" name="interest_rate"
                                                                type="number" min="1" max="36"
                                                                value="{{old('interest_rate')}}" required />
                                                            <span class="input-group-addon">%</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Start Date:</label>
                                                        <div class="col-md-2">
                                                            <select name="month" class="form-control" required>
                                                                <option selected value="">Selete Month</option>
                                                                <option value="1">Jan</option>
                                                                <option value="2">Feb</option>
                                                                <option value="3">Mar</option>
                                                                <option value="4">Apr</option>
                                                                <option value="5">May</option>
                                                                <option value="6">Jun</option>
                                                                <option value="7">Jul</option>
                                                                <option value="8">Aug</option>
                                                                <option value="9">Sep</option>
                                                                <option value="10">Oct</option>
                                                                <option value="11">Nov</option>
                                                                <option value="12">Dec</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select name="year" class="form-control" required>
                                                                <option selected value="">Selete Year</option>
                                                                @for($year = 2017; $year <= 2050; $year++) <option
                                                                    value="{{$year}}">{{$year}}</option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button type="submit"
                                                                class="btn green mt-ladda-btn ladda-button"
                                                                data-style="slide-down" data-spinner-color="#333">
                                                                <span class="ladda-label">
                                                                    Create
                                                                </span>
                                                            </button>
                                                            <a href="/loan" class="btn btn-default">Back</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- END FORM-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
    </div>
</div>
@endsection
