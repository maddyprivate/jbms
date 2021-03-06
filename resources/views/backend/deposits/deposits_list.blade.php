@extends('layouts.backend')

@section('content')

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex align-items-center">
						<div class="col-6">
							<h3 class="h4">@lang('laryl-deposits.heading.list')</h3>
						</div>
						<div class="col-6 text-right">
							<a href="{{ route('Deposits.deposits.create')  }}" class="bttn-plain">
								<i class="fas fa-file-deposit"></i>&emsp;@lang('laryl-deposits.buttons.create-new')
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th> @lang('laryl-deposits.table.#') </th>
										<th> @lang('laryl-deposits.table.date') </th>
										<th> @lang('laryl-deposits.table.amount') </th>
										<th> @lang('laryl-deposits.table.account_id') </th>
										<th> @lang('laryl-deposits.table.description') </th>
										<th> @lang('laryl-deposits.table.chequeNo') </th>
										<th> @lang('laryl-deposits.table.ref') </th>
										<th> @lang('laryl-deposits.table.person') </th>
										<th> @lang('laryl-deposits.table.options') </th>
									</tr>
								</thead>
								<tbody>
									@php
										$deposit_array = $deposits->toArray();
										$i = $deposit_array['from'];
									@endphp

									@if(count($deposits) > 0)

										@foreach($deposits as $key => $deposit)
											<tr>
												<th class="scope-row">{{$key+1}}</th>
												<td class="t-cap">{{dmyDate($deposit['date'])}}</td>
												<td class="t-up">Rs. {{$deposit['amount']}}</td>
												<td class="t-up">{{$deposit['accounts']['accountName']}}</td>
												<td class="t-cap">{{$deposit['description']}}</td>
												<td class="t-cap">{{$deposit['chequeNo']}}</td>
												<td class="t-cap">{{$deposit['ref']}}</td>
												<td class="t-cap">{{$deposit['person']}}</td>
												<td>

														<a class="btn btn-sm btn-success mb-2 mb-sm-0" href="{{ route('Deposits.deposits.show', $deposit['id'])  }}" data-toggle="tooltip" title="@lang('laryl.tooltips.show')">
															@lang('laryl.buttons.show')
														</a>

														<a class="btn btn-sm btn-warning mb-2 mb-sm-0" href="{{ route('Deposits.deposits.edit', $deposit['id'])  }}" data-toggle="tooltip" title="@lang('laryl.tooltips.edit')">
															@lang('laryl.buttons.edit')
														</a>

														<a class="btn btn-sm btn-danger mb-2 mb-sm-0" data-toggle="tooltip" title="@lang('laryl.tooltips.delete')" onclick="deleteDeposit('{{$deposit['id']}}')">
															@lang('laryl.buttons.delete')
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
								{{ $deposits->render() }}
							</div>

							<div class="col d-sm-none">
								{{ $deposits->links('pagination::simple-bootstrap-4') }}
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('footer')
<script type="text/javascript">
	// $(document).ready(function() {
		function deleteDeposit(id){
			alert(id);
		}
	// });
</script>
@endsection