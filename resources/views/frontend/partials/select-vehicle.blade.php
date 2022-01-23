<div class="cbs-main-list-item-section-header cbs-clear-fix">
    <span class="cbs-main-list-item-section-header-step">
        <span>1</span>
        <span>/4</span>
    </span>
    <h4 class="cbs-main-list-item-section-header-header">
        <span>Vehicle type</span>			
    </h4>
    <h5 class="cbs-main-list-item-section-header-subheader">
        <span>Select vehicle type below.</span>				
    </h5>
</div>						
<div class="cbs-main-list-item-section-content cbs-clear-fix">
    <ul class="cbs-vehicle-list cbs-list-reset cbs-clear-fix">
        @foreach ($location_vehicles as $location_vehicle)
            <li class="cbs-vehicle-id-{{$location_vehicle->id}}" data-vehicle-id="{{ $location_vehicle->vehicle_id }}">
                <div class="cbs-vehicle-icon cbs-vehicle-icon-{{ $location_vehicle->icon }}"></div>
                <div>{{ $location_vehicle->name }}</div>
            </li>
        @endforeach
    </ul>
</div>
<input type="hidden" name="vehicle_id" id="selected-vehicle-value" />