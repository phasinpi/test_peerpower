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
                            <h1>Repayment Schedules
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
                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                    <div class="portlet">
                                        <div class="portlet-body">
                                            <a href="/loan" class="btn btn-circle btn-sm green">
                                                Back
                                            </a>
                                            <div class="table-scrollable">
                                                <table
                                                    class="table table-striped table-bordered table-advance table-hover tbl-green">
                                                    <thead>
                                                        <tr>
                                                            <th>Payment No</th>
                                                            <th>Date</th>
                                                            <th>Payment Amount</th>
                                                            <th>Principal</th>
                                                            <th>Interest</th>
                                                            <th>Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if($loanDetails)
                                                        <?php $number = 1; ?>
                                                        @foreach($loanDetails as $loanDetail)
                                                        <tr>
                                                            <td> {{$number}} </td>
                                                            <?php
                                                            $dateStr = $loanDetail->year . '-' . $loanDetail->month . '-' . '01';
                                                            $date = date_create($dateStr);
                                                            $dateFormat = date_format($date,"M Y");
                                                            ?>
                                                            <td> {{$dateFormat}} </td>
                                                            <td> {{number_format($loanDetail->amount, 2)}} </td>
                                                            <td> {{number_format($loanDetail->principal, 2)}} </td>
                                                            <td> {{number_format($loanDetail->interest, 2)}} </td>
                                                            <td> {{number_format($loanDetail->balance, 2)}} </td>
                                                        </tr>
                                                        <?php $number++; ?>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                        </div>
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
    </div>
</div>
@endsection
