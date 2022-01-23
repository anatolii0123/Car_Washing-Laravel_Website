<div class="vehicles-wrapper" style="padding: 30px 20px">
    @foreach ($vehicles as $vehicle)
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input location-vehicle" id="{{ $vehicle->id }}" type="checkbox" tabindex="3" data-location_id="{{ $location_id }}" data-vehicle_id="{{ $vehicle->id }}" @if (in_array($vehicle->id, $location_vehicle_array))
                  checked
                @endif/>
                <label class="custom-control-label" for="{{ $vehicle->id }}"> {{ $vehicle->name }} </label>
            </div>
        </div>
    @endforeach
</div>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(function() {
    $(".location-edit .vehicles-wrapper .location-vehicle").change(function() {
      $.ajax({
          type: 'post',
          url: appUrl + '/admin/locations/saveLocationVehicle',
          data: {location_id: $(this).data("location_id"), vehicle_id: $(this).data("vehicle_id"), is_checked: $(this).prop("checked")},
          success: (res) => {
              Swal.fire({
                  icon: 'success',
                  title: 'Saved!',
                  text: 'Successfully saved.',
                  customClass: {
                  confirmButton: 'btn btn-success'
                  }
              });
          },
          error: (err) => {
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!',
                  customClass: {
                  confirmButton: 'btn btn-primary'
                  },
                  buttonsStyling: false
              });
          }
      })
    })
  })
</script>