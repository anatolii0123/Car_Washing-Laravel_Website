@extends('layouts.frontend.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<h1>{{ $location->name }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12 navTabsHolder hidden-xs hidden-sm">
			<ul class="nav nav-tabs" role="tablist">
				<li class="active">
                    <a href="{{ route('index') }}?office={{ $office }}#step1" role="tab" data-toggle="tab" title="" data-show="#dataFetcherHolder"><span>1</span> Enne vali teenus ja siis aeg</a>
                </li>
				<li>
                    <a href="{{ route('index') }}?office={{ $office }}#step2" role="tab" data-toggle="tab" title="" data-hide="#dataFetcherHolder"><span>2</span> Sisesta kontaktandmed</a>
                </li>
				<!-- <li><a href="#step3" role="tab" data-toggle="tab" title="" data-hide="#dataFetcherHolder"><span>3</span> Kontrolli ja kinnita</a></li> -->
			</ul>
		</div>
		<div id="dataFetcherHolder" class="col-xs-12 col-md-12">
			<form id="dataFetcher" action="{{ route('home.booking') }}" method="get" class="">
				<div class="row dateTimeHolder">
                    <div class="col-xs-12 col-xs-12 col-md-12" style="padding-left: 0">
                        <button type="button" class="btn pull-left hidden-xs hidden-sm direction-btn" data-modify-dp="#datetimepicker" data-from="0" style="width: 240px; margin-right: calc(50% - 409px);">Täna</button>
                        
                        <button type="button" class="btn prev-day disabled" data-picktime="false" data-modify-dp="#datetimepicker" data-days="-1"><i class="fa fa-angle-left"></i></button>
                        
						<a href="{{ route('index') }}#" id="datetimepicker">
							<span class="hidden-xs hidden-sm" data-date-format="dddd, DD.MMMM - YYYY">reede, 29.oktoober - 2021</span>
							<span class="visible-xs-inline-block visible-sm-inline-block" data-date-format="dd, DD.MM.YYYY">R, 29.10.2021</span>
							<input type="hidden" name="start_date" data-date-format="YYYY-MM-DD" value="2021-10-29">
						</a>

						<input type="hidden" name="office" value="{{ $office }}">

						<button type="button" class="btn next-day" data-modify-dp="#datetimepicker" data-days="1"><i class="fa fa-angle-right"></i></button>

						<button type="button" class="btn pull-right hidden-xs hidden-sm" data-modify-dp="#datetimepicker" data-from="1" style="width: 240px;">Homme</button>

						<div class="clearfix"></div>
					</div>
				</div>
			</form>
			<div class="fixedClone" style="height: 58px;"></div>
		</div>
	</div>
<form class="form-horizontal bv-form" role="form" id="yw0" action="{{ route('index') }}/?office={{ $location_id }}" method="post" novalidate="novalidate"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>	<div class="tab-content">
    @csrf
    <input type="hidden" name="location_id" value="{{ $location_id }}" />
    <input type="hidden" name="duration" value="0" id="duration"/>
    <div class="tab-pane  active" id="step1" data-validate="false">
        <div class="row dataHolder">
            <div class="col-xs-12 col-md-3">
                <div class="row servicesHolder">
                    <nav class=" navbar navbar-default" role="navigation">
                        <div class="navbar-header visible-xs-block visible-sm-block collapsed" data-toggle="collapse" data-target="#services-collapse">
                            <button type="button" class="navbar-toggle">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span>
                                Vali broneeritav teenus
                            </span>
                        </div>

                        <div class="navbar-collapse collapse" id="services-collapse" style="height: 0px;">
                            <h4 class="hidden-xs hidden-sm">Enne vali teenus ja siis aeg</h4>
                            <ul>
                                @foreach ($location_services as $service)
                                <li class="checkbox">
                                    <label>
                                        <input type="checkbox" name="BookingService[service_id][]" class="serv_select_42" data-name="Survepesu" data-duration="{{ $service->duration }}" value="{{ $service->id }}">
                                        <i class="fa fa-check"></i>
                                        {{ $service->name }}<span class="pull-right">{{ $service->duration }}min</span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </nav>
                    <div class="hidden">

                        <div class="form-group">
                            
                            <label class="col-xs-12 col-md-2 control-label hidden-xs"></label>
                            <div class="col-xs-12 col-md-10">
                                <input name="Bookings[started_at]" class="form-control" placeholder="Loodud" id="Bookings_started_at" type="text" data-bv-field="Bookings[started_at]">								<small class="help-block" data-bv-validator="notEmpty" data-bv-for="Bookings[started_at]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small><small class="help-block" data-bv-validator="momentDate" data-bv-for="Bookings[started_at]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid date</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-md-2 control-label hidden-xs"></label>
                            <div class="col-xs-12 col-md-10">
                                <input name="Bookings[ended_at]" class="form-control" placeholder="bookings.ended_at" id="Bookings_ended_at" type="text" data-bv-field="Bookings[ended_at]">								<small class="help-block" data-bv-validator="notEmpty" data-bv-for="Bookings[ended_at]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small><small class="help-block" data-bv-validator="momentDate" data-bv-for="Bookings[ended_at]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid date</small></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-md-2 control-label hidden-xs"></label>
                            <div class="col-xs-12 col-md-10">
                                <input name="BookingResources[resource_id]" class="form-control" placeholder="booking_resources.resource_id" id="BookingResources_resource_id" type="text" maxlength="10" data-bv-field="BookingResources[resource_id]">								<small class="help-block" data-bv-validator="notEmpty" data-bv-for="BookingResources[resource_id]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small><small class="help-block" data-bv-validator="integer" data-bv-for="BookingResources[resource_id]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="BookingResources[resource_id]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value with valid length</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-9" id="slotChoose" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
            </div>
        </div>
    </div>
    <div class="tab-pane" id="step2" data-validate="#step1">
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 graybg">
                <div class="dateInfo">
                    <div class="month" style="font-size: 22px;">
                        <div style="display: inline-block" class="title">Broneeritud aeg: </div>
                        <div style="display: inline-block" class="time"><span data-showvalue="[name=&#39;Bookings[started_at]&#39;]" data-function="moment" data-format="L"></span> <span style="margin-left:10px" data-showvalue="[name=&#39;Bookings[started_at]&#39;]" data-function="moment" data-format="LT"></span> - <span data-showvalue="[name=&#39;Bookings[ended_at]&#39;]" data-function="moment" data-format="LT"></span></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <p>Sisesta broneeringu kinnituseks vajalikud andmed. Saadame broneeringu kinnituse Sinu sisestatud emaili aadressile.</p>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group form-group-lg">
                    {{-- <label class="col-xs-12 col-md-12 control-label text-left hidden-xs hidden-sm" for="Bookings_driver">Nimi</label>						 --}}
                    <div class="col-xs-12 col-md-12">
                        <input name="Bookings[driver]" class="form-control" placeholder="Nimi" id="Bookings_driver" type="text" data-bv-field="Bookings[driver]">						<small class="help-block" data-bv-validator="notEmpty" data-bv-for="Bookings[driver]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small>
                    </div>
                </div>
                <div class="form-group  form-group-lg">
                    {{-- <label class="col-xs-12 col-md-12 control-label text-left hidden-xs hidden-sm" for="Bookings_email">Email</label>						 --}}
                    <div class="col-xs-12 col-md-12">
                        <input name="Bookings[email]" class="form-control" placeholder="Email" id="Bookings_email" type="text" data-bv-field="Bookings[email]">						<small class="help-block" data-bv-validator="notEmpty" data-bv-for="Bookings[email]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small><small class="help-block" data-bv-validator="emailAddress" data-bv-for="Bookings[email]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid email address</small>
                    </div>
                </div>
                <div class="form-group  form-group-lg">
                    {{-- <label class="col-xs-12 col-md-12 control-label text-left hidden-xs hidden-sm" for="Bookings_phone">Telefoni number</label>						 --}}
                    <div class="col-xs-12 col-md-12">
                        <input name="Bookings[phone]" class="form-control" placeholder="Telefoni number" id="Bookings_phone" type="text" data-bv-field="Bookings[phone]">						<small class="help-block" data-bv-validator="notEmpty" data-bv-for="Bookings[phone]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group  form-group-lg">
                    {{-- <label class="col-xs-12 col-md-12 control-label text-left hidden-xs hidden-sm" for="Bookings_number">Number</label>						 --}}
                    <div class="col-xs-12 col-md-12">
                        <input name="Vehicles[number]" class="form-control" placeholder="Auto number" id="Vehicles_number" type="text" maxlength="30" value="" data-bv-field="Vehicles[number]">						<small class="help-block" data-bv-validator="notEmpty" data-bv-for="Vehicles[number]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="Vehicles[number]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value with valid length</small>
                    </div>
                </div>
                <div class="form-group  form-group-lg">
                    {{-- <label class="col-xs-12 control-label text-left control-label">Sõidukid:</label> --}}
                    <div class="input-holder selectContainer col-xs-12 col-md-12">
                        <select class="form-control col-xs-6" name="vehicle_id" required>
                            <option value="">Sõiduk</option>
                            @foreach ($location_vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                
                            @endforeach
                            
                        </select>						
                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="Makes[id]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small>
                    </div>
                </div>
                <div class="row" style="display: flex; justify-content: space-between; margin: 0 -30px">
                    <div class="form-group-lg col-xs-6 col-md-6">
                        {{-- <label class="control-label text-left control-label col-xs-12 col-md-12">Mark:</label> --}}
                        <div class="input-holder selectContainer col-xs-12 col-md-12">
                            <select class="form-control col-xs-6" name="Makes[id]" id="Makes_id" data-bv-field="Makes[id]">
                                <option value="">Mark</option>
                                @foreach ($location_marks as $mark)
                                    <option value="{{ $mark->id }}">{{ $mark->name }}</option>
                                    
                                @endforeach
                                
                            </select>						
                            <small class="help-block" data-bv-validator="notEmpty" data-bv-for="Makes[id]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small>
                        </div>
                    </div>
                    <div class="form-group-lg col-xs-6 col-md-6">
                        {{-- <label class="ontrol-label text-left control-label col-xs-12 col-md-12">Mudel:</label> --}}
                        <div class="input-holder selectContainer disabled col-xs-12 col-md-12">
                            <select data-url="{{ route('home.models') }}?id=" class="form-control col-xs-6" disabled="disabled" name="Vehicles[model_id]" id="Vehicles_model_id" data-bv-field="Vehicles[model_id]">
                                <option value="">Mudel</option>
                            </select>						
                            <small class="help-block" data-bv-validator="notEmpty" data-bv-for="Vehicles[model_id]" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value</small>
                        </div>
                    </div>
                </div>
                <div class="form-group  form-group-lg" style="clear:both; color: #5998b6; display: none;">
                    <label class="control-label col-xs-12 col-md-12 text-left">&nbsp;</label>
                    <div class="input-holder" style="font-size: 20px;display: none;">
                        Hind kokku: <span class="priceHolder" style="color: #2f627a; font-weight: bold;" data-url="/public/servicePrices"></span> EUR
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="form-group ">
                    {{-- <label class="control-label col-xs-12 col-md-12 text-left hidden-xs hidden-sm">Kommentaarid:</label> --}}
                    <div class="col-xs-12 col-md-12">
                        <textarea name="Bookings[summary]" rows="3" class="form-control" placeholder="Lisainfo" id="Bookings_summary" style="border-radius: 20px; padding: 20px; font-size: 20px"></textarea>						</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                                    <button class="btn btn-success btn-lg pull-right" type="submit">BRONEERIN</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    {{-- <div class="tab-pane" id="step3" data-validate="#step2">
        <div class="row">
            <h3 class="text-center">Kinnita broneering!</h3>
            <div class="col-xs-12 col-sm-12 graybg">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="dateInfo">
                            <div class="month">
                            <p>Asukoht: <span>Zeppelini Autopesula</span></p>
                            <p>Kuupäev: <span data-showvalue="[name=&#39;Bookings[started_at]&#39;]" data-function="moment" data-format="DD.MM.YYYY"></span></p>
                            </div>
                            <div class="start"><p>Algus: <span data-showvalue="[name=&#39;Bookings[started_at]&#39;]" data-function="moment" data-format="HH:mm"></span></p></div>
                            <div class="end"><p>Lõpp: <span data-showvalue="[name=&#39;Bookings[ended_at]&#39;]" data-function="moment" data-format="HH:mm"></span></p></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h4>Teenused: </h4>
                        <ul class="bronResrouces" data-showvalue="[name=&#39;BookingService[service_id][]&#39;]" data-filter=":checked" data-function="mustache" data-template="checkedService"></ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="row">
                    <div class="col-xs-12 col-sm-4"><p>Nimi: </p></div>
                    <div class="col-xs-12 col-sm-8" data-showvalue="[name=&#39;Bookings[driver]&#39;]"><p></p></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4"><p>E-mail: </p></div>
                    <div class="col-xs-12 col-sm-8" data-showvalue="[name=&#39;Bookings[email]&#39;]"><p></p></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4"><p>Telefon: </p></div>
                    <div class="col-xs-12 col-sm-8" data-showvalue="[name=&#39;Bookings[phone]&#39;]"><p></p></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4"><p>Auto nr: </p></div>
                    <div class="col-xs-12 col-sm-8" data-showvalue="[name=&#39;Vehicles[number]&#39;]"><p></p></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4"><p>Auto mark: </p></div>
                    <div class="col-xs-12 col-sm-8" data-showvalue="[name=&#39;Vehicles[model]&#39;]"><p></p></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="row">
                    <div class="col-xs-4"><p>Kommentaarid:</p></div>
                    <div class="col-xs-8" data-showvalue="[name=&#39;Bookings[summary]&#39;]"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 text-right">
                <button class="btn btn-success btn-lg" type="button">Saada</button>
                <input type="hidden" name="redirectTo" value="https://web.skype.com/">
            </div>
        </div>
    </div> --}}
</div>
</form>
</div>
<script type="text/html" id="day">
    <?php echo '{{=[[ ]]=}}';?>
	<div class="day" data-resources="[[resources.length]]" data-activeResource="1">
		<div class="visible-xs-block resourceHolder text-center">
			<button type="button" class="btn prev-resource pull-left" data-trigger="swiperight"><i class="fa fa-angle-left"></i></button>
				<div class="resourceHeaderWrap">
					<div class="resourceHeaderHolder">
						[[#resources]]
							<h2 class="pull-left">[[name]]</h2>
						[[/resources]]
						<div class="clearfix"></div>
					</div>
				</div>
			<button type="button" class="btn next-resource pull-right" data-trigger="swipeleft"><i class="fa fa-angle-right"></i></button>
		</div>
		<div class="fixedClone"></div>
		<div class="time">
			<div class="hidden-xs">Kell</div>
			[[#getSlots]]
			<span>[[getTime]]</span>
			[[/getSlots]]
		</div>
		<div>
			<div class="resources">
				[[#resources]]
					<div class="resource pull-left">
						<div class="name hidden-xs">
							[[name]]
						</div>
						<div class="slots">
							[[#getSlots]]
								<div class="slot" data-time="[[getTime]]" data-resource="[[parent.id]]" data-free="[[isFree]]" data-open="[[isOpen]]" data-place="[[place]]">
									[[#bookings]]
										<div class="booked" data-start="[[start]]" data-end="[[end]]" data-duration="[[duration]]" data-type="[[type]]"><p>Broneeritud</p></div>
									[[/bookings]]
									[[#plans]]
										<a href="#step2" title="Broneeri aeg" data-changeForm="#yw0" data-changeFormData='{"BookingResources[resource_id]":[[parent.id]],"Bookings[started_at]":"[[getFrom]]","Bookings[ended_at]":"[[getTo]]"}'>Broneeri aeg</a>
									[[/plans]]
								</div>
							[[/getSlots]]
						</div>
					</div>
				[[/resources]]
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</script>
<script type="text/html" id="checkedService">
	<li>[[name]]</li>
</script>
@endsection