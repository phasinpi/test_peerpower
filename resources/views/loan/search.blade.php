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
                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                    <div class="portlet">
                                        <div class="portlet-body">
                                            <div class="portlet box green">
                                                <div class="portlet-title">
                                                    <div class="caption">Advance Search</div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="expand"></a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body display-hide">
                                                    <!-- BEGIN FORM-->
                                                    <form action="/loan/search" method="post" class="form-horizontal">
                                                        {{ csrf_field() }}
                                                        <div class="form-body">
                                                            <p class="col-md-12">Loan
                                                                Amount(THB)</p>
                                                            <div class="form-group">
                                                                <label class="col-md-2 control-label">Min:</label>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="minAmount" min="1000"
                                                                        max="100000000" class="form-control"
                                                                        placeholder="10000" value="{{$minAmount}}">
                                                                </div>
                                                                <label class="col-md-2 control-label">Max:</label>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="maxAmount" min="1000"
                                                                        max="100000000" class="form-control"
                                                                        placeholder="100000000" value="{{$maxAmount}}">
                                                                </div>
                                                            </div>
                                                            <p class="col-md-12">Interest Rate(%)</p>
                                                            <div class="form-group">
                                                                <label class="col-md-2 control-label">Min:</label>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="minRate" min="1"
                                                                        max="100" class="form-control" placeholder="1"
                                                                        value="{{$minRate}}">
                                                                </div>
                                                                <label class="col-md-2 control-label">Max:</label>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="maxRate" min="1"
                                                                        max="100" class="form-control" placeholder="100"
                                                                        value="{{$maxRate}}">
                                                                </div>
                                                            </div>
                                                            <p class="col-md-12">Loan Term</p>
                                                            <div class="form-group">
                                                                <label class="col-md-2 control-label">Min:</label>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="minTerm" min="1" max="50"
                                                                        class="form-control" placeholder="1"
                                                                        value="{{$minTerm}}">
                                                                </div>
                                                                <label class="col-md-2 control-label">Max:</label>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="maxTerm" min="1" max="50"
                                                                        class="form-control" placeholder="50"
                                                                        value="{{$maxTerm}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-9">
                                                                    <button type="submit"
                                                                        class="btn btn-circle green">Search</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- END FORM-->
                                                </div>
                                            </div>
                                            <a href="/loan/create" class="btn btn-circle btn-sm green">
                                                Add New Loan
                                            </a>
                                            <div class="table-scrollable">
                                                <table
                                                    class="table table-striped table-bordered table-advance table-hover tbl-green">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Loan Amount</th>
                                                            <th>Loan Term</th>
                                                            <th>Interest Rate</th>
                                                            <th>Created at</th>
                                                            <th>Edit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if($loans)
                                                        @foreach($loans as $loan)
                                                        <tr>
                                                            <td> {{$loan->id}} </td>
                                                            <td> {{number_format($loan->amount, 2)}} ฿</td>
                                                            <td> {{$loan->term}} Years</td>
                                                            <td> {{number_format($loan->interest_rate, 2)}} %</td>
                                                            <td> {{$loan->created_at}} </td>
                                                            <td style="display: inline-flex;">
                                                                <form class="form-horizontal" role="form" method="GET"
                                                                    action="{{ url('/loan/' . $loan->id) }}">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit"
                                                                        class="btn btn-circle btn-sm blue">
                                                                        <i class="fa fa-edit"></i> View
                                                                    </button>
                                                                </form>
                                                                <form class="form-horizontal" role="form" method="GET"
                                                                    action="{{ url('/loan/' . $loan->id . '/edit') }}">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit"
                                                                        class="btn btn-circle btn-sm green">
                                                                        <i class="fa fa-edit"></i> Edit
                                                                    </button>
                                                                </form>
                                                                <form id="form-delete"
                                                                    class="form-horizontal form-delete" role="form"
                                                                    method="POST"
                                                                    action="{{ url('/loan/' . $loan->id) }}">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit"
                                                                        class="btn btn-circle dark btn-sm red">
                                                                        <i class="fa fa-trash-o"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
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
<?php if (!empty($loan->id)) { ?>
<script>
    $(".form-delete").submit(function () {
          if (confirm("Do you want to delete this Loan?")) {
              form.get(0).submit();
          }
          return false;
      });
</script>
<?php } ?>
@endsection
