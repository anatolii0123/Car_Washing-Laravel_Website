<div class="cbs-main-list-item-section-header cbs-clear-fix">
    <span class="cbs-main-list-item-section-header-step">
        <span>2</span>
        <span>/4</span>
    </span>
    <h4 class="cbs-main-list-item-section-header-header">
        <span>Services menu</span>			
    </h4>
    <h5 class="cbs-main-list-item-section-header-subheader">
        <span>Services Menu.</span>				
    </h5>
</div>						
<div class="cbs-main-list-item-section-content cbs-clear-fix">
    <ul class="cbs-service-list cbs-list-reset cbs-clear-fix cbs-state-to-hidden">
        @foreach ($location_services as $index => $location_service)
            <li class="cbs-clear-fix cbs-service-id-{{$index}}">
                <div class="cbs-service-name">
                    <div class="cbs-title-link">
                        <span>{{ $location_service->name }}</span>
                        <a class="cbs-more-link" href="#">
                            <span>More...</span>
                            <span class="cbs-state-hidden">Less...</span>
                        </a>
                    </div>
                    <div class="cbs-more-content cbs-state-hidden">
                        {{ $location_service->description }}
                    </div>
                </div>
                <div class="cbs-service-duration">
                    <span class="cbs-meta-icon cbs-meta-icon-duration"></span>
                    {{ $location_service->duration }} min				
                </div>
                <div class="cbs-service-price">
                    <span class="cbs-meta-icon cbs-meta-icon-price"></span>
                    {{ $location_service->price }} €
                </div>
                <div class="cbs-button-box">
                    <a class="cbs-button" href="#" data-service-price="{{ $location_service->price }}" data-service-duration="{{ $location_service->duration }}" data-service-id="{{ $location_service->id }}">Select</a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
<input type="hidden" name="service_id" id="selected-service-value" />