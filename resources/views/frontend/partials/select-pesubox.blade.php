<div class="cbs-main-list-item-section-header cbs-clear-fix">
    <span class="cbs-main-list-item-section-header-step">
        <span>2</span>
        <span>/4</span>
    </span>
    <h4 class="cbs-main-list-item-section-header-header">
        <span>Pesuboxs menu</span>			
    </h4>
    <h5 class="cbs-main-list-item-section-header-subheader">
        <span>Pesuboxs Menu.</span>				
    </h5>
</div>						
<div class="cbs-main-list-item-section-content cbs-clear-fix">
    <ul class="cbs-pesubox-list cbs-list-reset cbs-clear-fix cbs-state-to-hidden">
        @foreach ($location_pesuboxs as $index => $location_pesubox)
            <li class="cbs-clear-fix cbs-pesubox-id-{{$index}}">
                <div class="cbs-pesubox-name">
                    <div class="cbs-title-link">
                        <span>{{ $location_pesubox->name }}</span>
                    </div>
                </div>
                <div class="cbs-button-box">
                    <a class="cbs-button" href="#" data-pesubox-name="{{ $location_pesubox->name }}" data-pesubox-id="{{ $location_pesubox->id }}">Select</a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
<input type="hidden" name="pesubox_id">