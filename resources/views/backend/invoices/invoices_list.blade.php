@extends('layouts.backend')

@section('content')

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex align-items-center">
						<div class="col-6">
							<h3 class="h4">@lang('laryl-invoices.heading.list')</h3>
						</div>
						<div class="col-6 text-right">
							<a href="{{ route('Invoices.invoices.create')  }}" class="bttn-plain">
								<i class="fas fa-file-invoice"></i>&emsp;@lang('laryl-invoices.buttons.create-new')
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th> @lang('laryl-invoices.table.#') </th>
										<th> @lang('laryl-invoices.table.issueDate') </th>
										<th> @lang('laryl-invoices.table.dueDate') </th>
										<th> @lang('laryl-invoices.table.customer') </th>
										<th> @lang('laryl-invoices.table.invoiceStatus') </th>
										<th> @lang('laryl-invoices.table.grandValue') </th>
										<th> @lang('laryl-invoices.table.options') </th>
									</tr>
								</thead>
								<tbody>
									@php
										$invoice_array = $invoices->toArray();
										$i = $invoice_array['from'];
									@endphp

									@if(count($invoices) > 0)

										@foreach($invoices as $invoice)
											<tr>
												<th class="scope-row">{{$i}}</th>
												<td class="t-cap">{{$invoice['issueDate']}}</td>
												<td class="t-up">{{$invoice['dueDate']}}</td>
												<td class="t-up">{{$invoice['customer']['name']}}</td>
												<td class="t-up">{{$invoice['invoiceStatus']}}</td>
												<td class="t-cap">Rs. {{$invoice['grandValue']}}</td>
												<td>

														<a class="btn btn-sm btn-success mb-2 mb-sm-0" href="{{ route('Invoices.invoices.show', $invoice['id'])  }}" data-toggle="tooltip" title="@lang('laryl.tooltips.show')">
															@lang('laryl.buttons.show')
														</a>

														<a class="btn btn-sm btn-warning mb-2 mb-sm-0" href="{{ route('Invoices.invoices.edit', $invoice['id'])  }}" data-toggle="tooltip" title="@lang('laryl.tooltips.edit')">
															@lang('laryl.buttons.edit')
														</a>
														<a class="btn btn-sm btn-primary mb-2 mb-sm-0" data-remodal-target="invoiceStatusChange" href="javascript:;"  title="@lang('laryl.tooltips.payment')" onclick="$('#invoiceStatusChange').val('{{$invoice['invoiceStatus']}}');$('#id').val('{{$invoice['id']}}');">
															@lang('laryl.buttons.payment')
														</a>
												</td>
											</tr>

											@php $i++; @endphp
											
										@endforeach
										
									@else 
										
										<tr class="text-center">
											<td colspan="7">@lang('laryl.messages.no-records')</td>
										</tr>

									@endif
								</tbody>
							</table>
							
						{{-- table responsive --}}
						</div> 

						<div class="row">
							<div class="col d-none d-sm-block">
								{{ $invoices->render() }}
							</div>

							<div class="col d-sm-none">
								{{ $invoices->links('pagination::simple-bootstrap-4') }}
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="remodal" data-remodal-id="invoiceStatusChange" aria-labelledby="modalTitle" aria-describedby="modalDesc" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div>
		<form id="invoiceStatusChange_form" method="post" action="{{url('changeInvoiceStatus')}}">
			@csrf
			<div class="form-group row align-items-center">
				<label for="invoiceStatus" class="col-md-5 col-form-label">Change to @lang('laryl-invoices.form.label.invoiceStatus')</label>
				<div class="col-sm-7">
					<div class="col-md-12">
						<select id="invoiceStatus" name="invoiceStatus" class="form-control">
							<option value="unpaid"{{ ( $invoice->invoiceStatus === "unpaid" ) ? 'selected' : '' }}>Unpaid</option>
							<option value="partial"{{ ( $invoice->invoiceStatus === "partial" ) ? 'selected' : '' }}>Partial</option>
							<option value="paid"{{ ( $invoice->invoiceStatus === "paid" ) ? 'selected' : '' }}>Paid</option>
						</select>
						<input name="id" id="id" type="hidden" class="form-control" >
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-auto ml-auto" style="text-align: left;">
					<button type="submit" class="btn btn-success">Change Status</button>
					<button type="reset" data-remodal-action="cancel" class="btn btn-danger ml-auto">Close</button>
				</div>
			</div>
		</form>			
	</div>
</div>
@endsection