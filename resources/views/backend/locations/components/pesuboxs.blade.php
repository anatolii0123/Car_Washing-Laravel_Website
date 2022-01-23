<div class="row" id="table-hover-row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Location Pesuboxs</h4>
        <button class="btn btn-primary waves-effect waves-float waves-light" data-toggle="modal" data-target="#edit_pesubox_modal" onclick="addNewPesubox()">Create New Pesubox</button>
      </div>
      <div class="table-responsive">
        <table class="table table-hover" id="location_pesubox_table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Active</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($location_pesuboxs as $location_pesubox)
                <tr>
                  <td>{{ $location_pesubox->name }}</td>
                  <td>
                    {{ $location_pesubox->description }}
                  </td>
                  <td>
                    <div class="custom-control custom-switch custom-control-inline">
                      <input type="checkbox" class="custom-control-input status" id="customSwitch{{ $location_pesubox->id }}" data-id="{{ $location_pesubox->id }}"
                      @if ($location_pesubox->status)
                        checked
                      @endif />
                      <label class="custom-control-label" for="customSwitch{{ $location_pesubox->id }}"></label>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                        <i data-feather="more-vertical"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item edit-pesubox" href="javascript:void(0);" data-toggle="modal" data-target="#edit_pesubox_modal" data-id="{{ $location_pesubox->id }}">
                          <i data-feather="edit-2" class="mr-50"></i>
                          <span>Edit</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="deletePesubox({{ $location_pesubox->id }})">
                          <i data-feather="trash" class="mr-50"></i>
                          <span>Delete</span>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade text-left" id="edit_pesubox_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel18">Add New Pesubox</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form id="edit_pesubox_form">
              @csrf
              <input type="hidden" name="location_pesubox_id" id="location_pesubox_id">
              <input type="hidden" name="location_id" id="location_id" value="{{ $location_id }}">
              <div class="modal-body">
                  <div class="form-group">
                      <label for="defaultInput">Name</label>
                      <input class="form-control" type="text" placeholder="pesubox Name" name="name"  id="name"/>
                  </div>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="defaultInput">Description</label>
                    <textarea class="form-control" type="text" placeholder="pesubox Name" name="description"  id="description"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="save_location_pesubox">Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
          </form>
      </div>
  </div>
</div>
<script>
  $(function() {
    if (feather) {
      feather.replace({
        width: 14,
        height: 14
      });
    };

    $("#location_pesubox_table .edit-pesubox").click(function() {
      $.ajax({
        type: "get",
        url: appUrl + '/admin/locations/getLocationPesubox',
        data: {id: $(this).data("id")},
        success: (res) => {
          var res = JSON.parse(res);
          $("#edit_pesubox_form #location_pesubox_id").val(res.data.id);
          $("#edit_pesubox_form input#name").val(res.data.name);
          $("#edit_pesubox_form #description").val(res.data.description);
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

    $("#location_pesubox_table .status").change(function() {
      $.ajax({
        type: 'post',
        url: appUrl + '/admin/locations/saveLocationPesuboxStatus',
        data: {id: $(this).data("id"), status: $(this).prop("checked")},
        success: (res) => {
          Swal.fire({
            icon: 'success',
            title: 'Save',
            text: 'Successfully Done!',
            customClass: {
            confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
          });
        },
        error: () => {
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

    $("#save_location_pesubox").click(function() {
      var formdata = new FormData($("#edit_pesubox_form")[0]);
      $.ajax({
        type: "post",
        url: appUrl + '/admin/locations/saveLocationPesubox',
        data: formdata,
        dataType:"JSON",
        processData: false,
        contentType: false,
        cache: false,
        success: (res) => {
          $("#edit_pesubox_modal .close").trigger("click");
          $.ajax({
            type: 'get',
            url: appUrl + "/admin/locations/getLocationPesuboxs",
            data: {id: $(".location-edit #location_id").val()},
            success: (res) => {
              $(".location-edit .tab-content #pesubox").html(res)
            },
            error: (err) => {
              console.log(err)
            }
          })
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
    });
  });

  function addNewPesubox () {
    $("#location_pesubox_id").val(0);
  }

  function deletePesubox(id) {
    $.ajax({
      type: 'post',
      url: appUrl + '/admin/locations/deleteLocationPesubox',
      data: {id: id},
      success: (res) => {
        window.location.reload();
      },
      error: () => {
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
  }
</script>
          