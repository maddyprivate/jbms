@extends('layouts.backend')

@section('content')

<section>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex align-items-center row no-gutters">
						<div class="col-6">
							<h3 class="h4">@lang('laryl-dcs.heading.edit', ['dc'=> $dc->serialPrefix.$dc->serialNumber])</h3>
						</div>
						<div class="col-6 text-right">
							<a href="{{ route('Dcs.dcs.index')  }}" class="bttn-plain">
								@lang('laryl-dcs.buttons.back-to-dcs')
							</a>
						</div>
						<div class="col-12">
							<h6 class="t-cap">{{ $dc->profile['businessName'] }}, <span id="placeoforigin">{{ $dc->profile['placeOfOrigin'] }}</span></h6>
						</div>
					</div>
					<div class="card-body">
						<div class="container">

							<div class="row">
								<div class="col-md-12 mx-auto">

							<form id="editDcForm" method="POST" action="{{ route('Dcs.dcs.update', $dc->id) }}">

								@method('PUT')
								@csrf
						
								<div class="form-group row">
									<div class="col-md-3">
										<div class="row">
											<label for="serialNumber" class="col-md-12 col-form-label">@lang('laryl-dcs.form.label.dcSerial')</label>

											<div class="col-4 mr-auto pr-0">
												<input type="text" id="serialPrefix" class="form-control t-cap" name="serialPrefix" value={{ $dc->serialPrefix }} readonly>
											</div>
					
											<div class="col-8 ml-auto">
												<input id="serialNumber" type="text" class="form-control t-cap" name="serialNumber" value="{{ $dc->serialNumber }}" readonly>
											</div>
		
											@if ($errors->has('serialNumber'))
												<span class="col-md-12 form-error-message">
													<small for="serialNumber">{{ $errors->first('serialNumber') }}</small>
												</span>
											@endif
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="row">
											<label for="issueDate" class="col-md-12 col-form-label">@lang('laryl-dcs.form.label.issueDate')</label>
					
											<div class="col-md-12">
												<div id="date" data-name="issueDate" class="bfh-datepicker" data-input="form-control" data-min="01-01-2000" data-max="today"  data-format="y-m-d" data-date="today">
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="row">
											<label for="dueDate" class="col-md-12 col-form-label">@lang('laryl-dcs.form.label.dueDate')</label>
					
											<div class="col-md-12">
												<div id="duedate" data-name="dueDate" class="bfh-datepicker" data-min="01-01-2000" data-format="y-m-d" data-date="today">
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="row">
											<label for="placeOfSupply" class="col-md-12 col-form-label">@lang('laryl-dcs.form.label.placeOfSupply')</label>
					
											<div class="col-md-12">
												<select id="placeOfSupply" name="placeOfSupply" class="form-control bfh-states" data-country="India" data-state="{{ old('placeOfSupply', $dc->placeOfSupply) }}"></select>
											</div>
		
											@if ($errors->has('placeOfSupply'))
												<span class="col-md-12 form-error-message">
													<small for="placeOfSupply">{{ $errors->first('placeOfSupply') }}</small>
												</span>
											@endif
										</div>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<label for="customerName" class="col-auto col-form-label">@lang('laryl-dcs.form.label.customerName')</label>
			
													<div class="col-md-12">
														<input id="customerName" type="text" class="form-control t-cap" name="customer[name]" value="{{ old('customer.name', $dc->customer['name']) }}" autofocus>
													</div>
				
													@if ($errors->has('customer.name'))
														<span class="col-md-12 form-error-message">
															<small for="customer.name">{{ $errors->first('customer.name') }}</small>
														</span>
													@endif
													<input type="hidden" name="customer[customerId]" id="customerId" value="{{$dc->customer['customerId']}}">
												</div>
											</div>
											<div class="col-sm-6 col-md-6">
												<div class="row">
													<label for="customerGstin" class="col-md-12 col-form-label">@lang('laryl-dcs.form.label.customerGstin')</label>
		
													<div class="col-md-12">
														<input id="customerGstin" type="text" class="form-control t-up" name="customer[gstin]" value="{{ old('customer.gstin', $dc->customer['gstin']) }}" maxlength="15" >
													</div>
												</div>												
											</div>
											<div class="col-sm-6 col-md-6">
												<div class="row">
													<label for="customerMobile" class="col-md-12 col-form-label">@lang('laryl-dcs.form.label.customerMobile')</label>
		
													<div class="col-md-12">
														<input id="customerMobile" type="text" class="form-control t-up bfh-phone" data-country="India" name="customer[mobile]" value="{{ old('customer.mobile', $dc->customer['mobile']) }}" >
													</div>
				
													@if ($errors->has('customer.mobile'))
														<span class="col-md-12 form-error-message">
															<small for="customer.mobile">{{ $errors->first('customer.mobile') }}</small>
														</span>
													@endif
												</div>												
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
											<div class="col-sm-6 col-md-6">
												<div class="row">
													<label for="billingAddress" class="col-auto col-form-label">@lang('laryl-dcs.form.label.billingAddress')</label>

													<span id="billingaddress_edit" class="col-auto align-self-center ml-auto"><a data-remodal-target="editBillingAddress" href="javascript:;">Edit</a></span>
			
													<div class="col-md-12">
														<textarea id="billingAddress" rows=4 class="form-control autosize t-cap" name="customer[billingAddress]" readonly> {{ $dc->customer['billingAddress'] }} </textarea>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-md-6">
												<div class="row">
													<label for="shippingAddress" class="col-auto col-form-label">@lang('laryl-dcs.form.label.shippingAddress')</label>

													<span id="editShippingAddress" class="d-none col-auto align-self-center ml-auto"><a data-remodal-target="editShippingAddress" href="javascript:;">Edit</a></span>
			
													<div class="col-md-12">
														<textarea id="shippingAddress" rows=4 class="form-control autosize t-cap" name="customer[shippingAddress]" readonly>{{ $dc->customer['shippingAddress'] }}</textarea>
													</div>
												</div>
											</div>
											<div class="col-auto ml-auto mt-3 form-group">
												<div class="pure-checkbox">
													<input name="customer[sameAsBilling]" type="text" value="off" hidden>
													<input class="newinv_form_event" id="sameAsBilling" name="customer[sameAsBilling]" type="checkbox" {{( $dc->customer['sameAsBilling'] === "on" ) ? 'checked' : '' }}>
													<label for="sameAsBilling">Same as Billing Address</label>
												</div>										
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-12">
										<div class="dc-products-table">
											<div class="table-body-scrollable">
												<div class="table-responsive dc-products-list-table">
													<table id="table" class="table text-center">
														<thead>
															<tr>
																<th rowspan=2>#</th>
																<th rowspan=2>Product Description</th>
																<th rowspan=2>HSN / SAC</th>
																<th rowspan=2>Qty</th>
																<th rowspan=2>Unit</th>
																<th rowspan=2>Rate<br>/ Unit</th>
																<th rowspan=1>Discount</th>
																<th rowspan=1 colspan=2>Taxable</th>
																<th rowspan=1 colspan=2>Values</th>
															</tr>
															<tr>
																<th rowspan=1>
																	<div class="row no-gutters">
																		<div class="col-6">
																			<label for="discountType">%</label>
																		</div>
																		<div class="col-6">
																			<label for="discountType">Rs.</label>
																		</div>
																	</div>
																	<div class="row no-gutters">
																		<div class="col-6">
																			<input type="radio" value="discountrate" id="discount_percent" name="discountType" {{ ( $dc->discountType === "discountrate" ) ? 'checked' : '' }}>
																		</div>
																		<div class="col-6">
																			<input type="radio" value="discountvalue" id="discount_value" name="discountType" {{ ( $dc->discountType === "discountvalue" ) ? 'checked' : '' }}>
																		</div>
																	</div>
																</th>
																<th rowspan=1>Value</th>
																<th rowspan=1>Rate</th>
																<th rowspan=1>CGST</th>
																<th rowspan=1>SGST</th>
															</tr>
														</thead>
														<tbody>

															@foreach ($dc->product as $dcProduct)

															<tr class="product-details-row-scrollable" row-index="{{$dcProduct['dcSerial']}}"> 
																<td class="product-detail-cell" id="dcSerial">
																	<input type="text" class="table-cell-input text-center" id="dcSerial" name="dcProducts[{{$dcProduct['dcSerial']}}][dcSerial]"
																		value="{{$dcProduct['dcSerial']}}" readonly>
																</td>
																<td class="product-detail-cell" id="description">
																	<input type="text" class="table-cell-input" id="description" name="dcProducts[{{$dcProduct['dcSerial']}}][description]" value="{{$dcProduct['description']}}">
																	<a href="javascript:;" id="search_product">
																		<i class="fa fa-search"></i>
																	</a>
																</td>
																<td class="product-detail-cell" id="hsn">
																	<input type="text" class="table-cell-input" id="hsn" name="dcProducts[{{$dcProduct['dcSerial']}}][hsn]" value="{{$dcProduct['hsn']}}"> </td>
																<td class="product-detail-cell" id="quantity">
																	<input type="text" class="table-cell-input" id="quantity" name="dcProducts[{{$dcProduct['dcSerial']}}][quantity]" value="{{$dcProduct['quantity']}}"> </td>
																<td class="product-detail-cell" id="unit">
																	<select id="unit" name="dcProducts[{{$dcProduct['dcSerial']}}][unit]" class="table-cell-input">
																		<option {{ ( $dcProduct['unit'] === "NOS" ) ? 'selected' : '' }} value="NOS">NOS</option>
																		<option {{ ( $dcProduct['unit'] === "BGS" ) ? 'selected' : '' }} value="BGS">Bags</option>
																		<option {{ ( $dcProduct['unit'] === "Brass" ) ? 'selected' : '' }} value="Brass">Brass</option>
																		<option {{ ( $dcProduct['unit'] === "BTL" ) ? 'selected' : '' }} value="BTL">Bottles</option>
																		<option {{ ( $dcProduct['unit'] === "CAN" ) ? 'selected' : '' }} value="CAN">Cans</option>
																		<option {{ ( $dcProduct['unit'] === "KG" ) ? 'selected' : '' }} value="KG">Kilograms</option>
																		<option {{ ( $dcProduct['unit'] === "LTR" ) ? 'selected' : '' }} value="LTR">liter</option>
																		<option {{ ( $dcProduct['unit'] === "MTR" ) ? 'selected' : '' }} value="MTR">Meter</option>
																		<option {{ ( $dcProduct['unit'] === "CH" ) ? 'selected' : '' }} value="CH">Chhota Hatti</option>
																	</select>
																</td>
																<td class="product-detail-cell" id="saleValue">
																	<input type="text" class="table-cell-input" id="saleValue" name="dcProducts[{{$dcProduct['dcSerial']}}][saleValue]" value="{{$dcProduct['saleValue']}}"> </td>
																<td class="product-detail-cell" id="discountRate">
																	<input type="text" class="table-cell-input" id="discountRate" name="dcProducts[{{$dcProduct['dcSerial']}}][discountRate]" value="{{$dcProduct['discountRate']}}"> </td>
																<td class="product-detail-cell d-none" id="discountValue">
																	<input type="text" class="table-cell-input" id="discountValue" name="dcProducts[{{$dcProduct['dcSerial']}}][discountValue]" value="{{$dcProduct['discountValue']}}"> </td>
																<td class="product-detail-cell readonly-cell" id="taxableValue">
																	<input type="text" class="table-cell-input" id="taxableValue" name="dcProducts[{{$dcProduct['dcSerial']}}][taxableValue]" value="{{$dcProduct['taxableValue']}}"
																		readonly> </td>
																<td class="product-detail-cell" id="taxRate">
																	<select name="dcProducts[{{$dcProduct['dcSerial']}}][taxRate]" id="taxRate" class="table-cell-input">
																		<option value="0.00" {{ ( $dcProduct['taxRate'] === "0.00" ) ? 'selected' : '' }}>0 %</option>
																		<option value="0.10" {{ ( $dcProduct['taxRate'] === "0.10" ) ? 'selected' : '' }}>0.10 %</option>
																		<option value="0.25" {{ ( $dcProduct['taxRate'] === "0.25" ) ? 'selected' : '' }}>0.25 %</option>
																		<option value="3.00" {{ ( $dcProduct['taxRate'] === "3.00" ) ? 'selected' : '' }}>3.00 %</option>
																		<option value="5.00" {{ ( $dcProduct['taxRate'] === "5.00" ) ? 'selected' : '' }}>5.00 %</option>
																		<option value="12.00" {{ ( $dcProduct['taxRate'] === "12.00" ) ? 'selected' : '' }}>12.00 %</option>
																		<option value="18.00" {{ ( $dcProduct['taxRate'] === "18.00" ) ? 'selected' : '' }}>18.00 %</option>
																		<option value="28.00" {{ ( $dcProduct['taxRate'] === "28.00" ) ? 'selected' : '' }}>28.00 %</option>
																	</select>
																</td>
																
																<td class="product-detail-cell readonly-cell" id="cgstValue">
																	<input type="text" class="table-cell-input" id="cgstValue" name="dcProducts[{{$dcProduct['dcSerial']}}][cgstValue]" value="{{$dcProduct['cgstValue']}}" readonly>
																	<input type="text" class="table-cell-input " id="cgstRate" name="dcProducts[{{$dcProduct['dcSerial']}}][cgstRate]" value="{{$dcProduct['cgstRate']}}" readonly> </td>
																<td class="product-detail-cell readonly-cell" id="sgstValue">
																	<input type="text" class="table-cell-input" id="sgstValue" name="dcProducts[{{$dcProduct['dcSerial']}}][sgstValue]" value="{{$dcProduct['sgstValue']}}" readonly>
																	<input type="text" class="table-cell-input " id="sgstRate" name="dcProducts[{{$dcProduct['dcSerial']}}][sgstRate]" value="{{$dcProduct['sgstRate']}}" readonly> </td>
																</tr>

															@endforeach

															<tr class="dc-totals-row-scrollable">
																<td colspan="5" class=""><a href="javascript:;" id="add-empty-row-button">+ Add another line</a></td>
																<td colspan="2" class="">Total Inv. Val</td>
																<td class="dc-total-cell readonly-cell" id="taxableValue">
																	<input type="text" 	class="table-cell-total" id="taxableValue" name="totalTaxablevalue" value="{{$dc->totalTaxableValue}}" readonly>
																</td>
																<td colspan="1" class=""></td>
																<td class="dc-total-cell readonly-cell" id="totalCgstValue">
																	<input type="text" 	class="table-cell-total" id="cgstValue" name="totalCgstvalue" value="{{$dc->totalCgstValue}}" readonly>
																</td>
																<td class="dc-total-cell readonly-cell" id="sgstValue">
																	<input type="text" 	class="table-cell-total" id="sgstValue" name="totalSgstvalue" value="{{$dc->totalSgstValue}}" readonly>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>

											<div class="table-body-fixed table-shadow">
												<div class="table-fixed">
													<table id="table" class="table">
														<thead>
															<tr>
																<th rowspan=2 data-field="total_amount">
																	<div class="th-inner text-right">Total<br>Amount</div>
																</th>
															</tr>
														</thead>
														<tbody>

															@foreach($dc->product as $dcProduct)

																<tr class="product-details-row-fixed" row-index="{{$dcProduct['dcSerial']}}">
																	<td class="product-detail-cell readonly-cell" id="grossvalue" rowspan="1">
																		<input type="text" class="table-cell-input" id="grossvalue" name="dcProducts[{{$dcProduct['dcSerial']}}][grossvalue]" value="{{$dcProduct['grossValue']}}" readonly>
																	</td>
																	<td class="delete-row-cell" colspan="1" rowspan="1">
																		<a href="javascript:;" class="delete-row-link">
																			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
																				<g fill="none" fill-rule="evenodd">
																					<path fill="#FFF" d="M5.308 5.348l5.384 5.304"></path>
																					<path stroke="#FF4949" stroke-linecap="round" d="M5.308 5.348l5.384 5.304"></path>
																					<path fill="#FFF" d="M10.692 5.348l-5.384 5.304"></path>
																					<path stroke="#FF4949" stroke-linecap="round" d="M10.692 5.348l-5.384 5.304M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
																				</g>
																			</svg>
																		</a>
																	</td>
																</tr>

															@endforeach

															<tr class="dc-totals-row-fixed">
																<td class="dc-total-cell readonly-cell" id="netValue">
																	<input type="text" 	class="table-cell-total" id="netValue" name="netValue" value="{{$dc->netValue}}" readonly>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-12 text-right" style="max-width: calc(100% - 160px);">
										<div class="pure-checkbox">
											<input name="roundOffState" type="text" value="off" hidden>
											<input class="" id="roundOffState" name="roundOffState" type="checkbox" {{ ( $dc->roundOffState === "on" ) ? 'checked' : '' }}>
											<label for="roundOffState">Round Off : </label>
										</div>
									</div>
									<div class="col-auto m-0 p-0">
										<input class="roundOffValue" type="text" id="roundOffValue" name="roundOffValue" value="{{$dc->roundOffValue}}" readonly>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-12 text-right" style="max-width: calc(100% - 160px);">
										<label for="grandValue">Net Total : </label>
									</div>
									<div class="col-auto m-0 p-0">
										<input class="grandValue" type="text" id="grandValue" name="grandValue" value="{{$dc->grandValue}}" readonly>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-12 text-right my-auto" style="max-width: calc(100% - 160px);">
										<label for="amountRecieved">Amount Recieved : </label>
									</div>
									<div class="col-auto m-0 p-0" style="max-width: 108px;">
										<input class="form-control numeric-p8d2" type="text" id="amountRecieved" name="amountRecieved" value={{$dc->grandValue}} readonly>
									</div>
								</div>

								
								<div class="form-group row mt-5 mb-0">
									<!-- <div class="col-12 col-md-4 mb-3 mb-md-0">
										<div class="row">
											<label for="dcStatus" class="col-md-12 col-form-label">@lang('laryl-dcs.form.label.dcStatus')</label>
					
											<div class="col-md-12">
												<select id="dcStatus" name="dcStatus" class="form-control">
													<option value="quote"{{ ( $dc->dcStatus === "quote" ) ? 'selected' : '' }}>Quote</option>
													<option value="unpaid"{{ ( $dc->dcStatus === "unpaid" ) ? 'selected' : '' }}>Unpaid</option>
													<option value="partial"{{ ( $dc->dcStatus === "partial" ) ? 'selected' : '' }}>Partial</option>
													<option value="paid"{{ ( $dc->dcStatus === "paid" ) ? 'selected' : '' }}>Paid</option>
												</select>
											</div>
		
											@if ($errors->has('dcStatus'))
												<span class="col-md-12 form-error-message">
													<small for="dcStatus">{{ $errors->first('dcStatus') }}</small>
												</span>
											@endif
										</div>
									</div> -->
									<div class="row">
											<label for="otherCharges" class="col-auto col-form-label">@lang('laryl-dcs.form.label.otherCharges')</label>

											<div class="col-md-12">
												<input id="otherCharges" type="text" class="form-control digit-8" name="otherCharges" value="{{ old('otherCharges') ?? $dc->otherCharges }}" autofocus onblur="setTotalsRow();finalRoundingoff();">
											</div>

											@if ($errors->has('otherCharges'))
												<span class="col-md-12 form-error-message">
													<small for="otherCharges">{{ $errors->first('otherCharges') }}</small>
												</span>
											@endif
										</div>
									<div class="col-auto ml-auto my-auto">
										<button type="submit" class="btn btn-success  ml-auto">
											@lang('laryl-dcs.buttons.save-dc')
										</button>
									</div>
								</div>
							</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="remodal" data-remodal-id="editBillingAddress" aria-labelledby="modalTitle" aria-describedby="modalDesc" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div>
		<h2 id="modalTitle">Edit Billing Address</h2>
		<form id="edit_billingaddress_form">
			<div class="row">
				<div class="col-12 form-group mx-auto">
					<textarea name="editBillingAddress" id="editBillingAddress" type="text" class="form-control" style="height: 180px;"> {{ $dc->customer['billingAddress'] }}</textarea>
					<small for="editBillingAddress" class="validate-text" style="display: none;">Error Text.</small>
				</div>
				<div class="form-group col-auto ml-auto">
					<button type="reset" data-remodal-action="cancel" class="btn btn-danger ml-auto">Close</button>
					<button type="submit" class="btn btn-success">OK</button>
				</div>
			</div>
		</form>			
	</div>
</div>

<div class="remodal" data-remodal-id="editShippingAddress" aria-labelledby="modalTitle" aria-describedby="modalDesc" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div>
		<h2 id="modalTitle">Edit Shipping Address</h2>
		<form id="edit_shippingaddress_form">
			<div class="row">
				<div class="col-12 form-group mx-auto">
					<textarea name="editShippingAddress" id="editShippingAddress" type="text" class="form-control" style="height: 180px;"> {{ $dc->customer['shippingAddress'] }} </textarea>
					<small for="editShippingAddress" class="validate-text" style="display: none;">Error Text.</small>
				</div>
				<div class="form-group col-auto ml-auto">
					<button type="reset" data-remodal-action="cancel" class="btn btn-danger ml-auto">Close</button>
					<button type="submit" class="btn btn-success">OK</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="remodal" data-remodal-id="selectProductModal" aria-labelledby="modalTitle" aria-describedby="modalDesc" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div>
		<h2 id="modalTitle">Search Product</h2>
		<form id="selectProduct_form">
			<div class="form-group row align-items-center">
				<label class="col-sm-3 col-form-label">Product Description</label>
				<div class="col-sm-9">
					<input name="ProductDescription" id="searchProductDescription" type="text" placeholder="Product's Description" class="form-control" autofocus>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-auto ml-auto" style="text-align: left;">
					<button type="reset" data-remodal-action="cancel" class="btn btn-danger ml-auto">Close</button>
				</div>
			</div>	
		</form>			
	</div>
</div>

<script>
	window.dc_product_serial = 1;
	window.workingRowIndex = 0;

	window.tableScrollable = $(".table-body-scrollable");
	window.tableFixed = $('.table-fixed');

	$(function() {
		
		// add_empty_productrow();
		setRowHeight();
		renumber_productrow();

		$('select#dcStatus').change();

		@foreach($dc->product as $dcProduct)
			new_product_added( {{$dcProduct['dcSerial']}} );
		@endforeach
		
		autosize($('textarea.autosize'));

		//Declaring select customer remodal as JS obj. Used when closing the modal after customer selection
		var remodal_options = {
			hashTracking: false, closeOnOutsideClick: false,
		};

		window.selectProductModal = $('[data-remodal-id=selectProductModal]').remodal(remodal_options);

	});

</script>

<script src="{{ asset('js/new-dc.js') }}"></script>

<script>
	$('#editDcForm').on('submit', function(e){

		$('.input-error').removeClass('input-error');

		$.ajaxSetup({
			header:$('meta[name="_token"]').attr('content')
		});

		e.preventDefault();

		var formdata = $(this).serializeArray();
		var posturl = $(this).attr('action');

		console.log(formdata);
		console.log(posturl);

		$.ajax({
			type	:"POST",
			url		: posturl,
			data	: formdata,
			dataType: 'json',
			success: function(response){

				swal_message("Dc Saved.", "success");
				
			},
			error: function(response){

				var responseText = JSON.parse(response['responseText']);
				var responseErrors = responseText['errors'];

				$.each( responseErrors, function( key, value ) {
					var splitKey = key.split(".");
					console.log(splitKey);
					if((splitKey.length) > 1) {
						$('[name="'+splitKey[0]+'['+splitKey[1]+']'+'"]').addClass('input-error');
					} else {
						$('[name="'+splitKey[0]+'"]').addClass('input-error');
					}
				});

				swal_message("Error in Submission. Re-Submit", "error");

			}
		})
	});

	function swal_message(message_set, type_set, toast_set="true") {
		swal({
				title: message_set,
				type: type_set,
				toast:	toast_set,
				showConfirmButton:false,
				showCloseButton: true,
				timer: 3000,
				grow: false,
				position: 'top-right',
			});
	}
</script>


@endsection