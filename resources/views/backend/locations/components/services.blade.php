<div class="services-wrapper" style="padding: 30px 20px">
    @foreach ($services as $service)
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input location-service" id="{{ $service->id }}" type="checkbox" tabindex="3" data-location_id="{{ $location_id }}" data-service_id="{{ $service->id }}" @if (in_array($service->id, $location_service_array))
                  checked
                @endif/>
                <label class="custom-control-label" for="{{ $service->id }}"> {{ $service->name }} </label>
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
    $(".location-edit .services-wrapper .location-service").change(function() {
        
      $.ajax({
          type: 'post',
          url: appUrl + '/admin/locations/saveLocationService',
          data: {location_id: $(this).data("location_id"), service_id: $(this).data("service_id"), is_checked: $(this).prop("checked")},
          // dataType:"JSON",
          // processData: false,
          // contentType: false,
          // cache: false,
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