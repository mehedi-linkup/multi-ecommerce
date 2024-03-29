@extends('backend.layouts.admin_master')

@section('report')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Reports</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-4">
            <div class="card">
              <div class="card-header">Search By Date</div>
                <div class="card-body">
                <form action="{{ route('admin.report.by.date') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label class="form-control-label">Select Date: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="date" name="date">
                      @error('date')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-layout-footer">
                      <button type="submit" class="btn btn-info">Search</button>
                    </div><!-- form-layout-footer -->
                </form>
                </div>
            </div>
          </div>
        
        <div class="col-md-4">
            <div class="card">
              <div class="card-header">Search By Month</div>
                <div class="card-body">
              <form action="{{ route('admin.report.by.month') }}" method="POST" >
                  @csrf
                  <div class="form-group">
                    <label class="form-control-label">Select Month: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" name="month_name" data-placeholder="Choose one" data-validation="required">
                        <option label="Choose one"></option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                      </select>
                    @error('month_name')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  <div class="form-group">
                    <label class="form-control-label">Select Year: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" name="year_name" data-placeholder="Choose one" data-validation="required">
                        <option label="Choose one"></option>
                        <option value="2027">2027</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                      </select>
                    @error('year_name')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>
                  <div class="form-layout-footer">
                    <button type="submit" class="btn btn-info">Search</button>
                  </div><!-- form-layout-footer -->
                </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
              <div class="card-header">Search By Year</div>
                <div class="card-body">
              <form action="{{ route('admin.report.by.year') }}" method="POST" >
                  @csrf
                  <div class="form-group">
                    <label class="form-control-label">Select Year: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" name="year" data-placeholder="Choose one" data-validation="required">
                        <option label="Choose one"></option>
                        <option value="2027">2027</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                      </select>
                    @error('year')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>
                  <div class="form-layout-footer">
                    <button type="submit" class="btn btn-info">Search</button>
                  </div><!-- form-layout-footer -->
                </form>
                </div>
            </div>
        </div>

    </div><!-- row -->
</div><!-- sl-pagebody -->
@endsection
