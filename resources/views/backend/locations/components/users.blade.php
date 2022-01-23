<div class="row" id="table-hover-row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Location Users</h4>
          <button class="btn btn-primary waves-effect waves-float waves-light" data-toggle="modal" data-target="#edit_user_modal" onclick="addNewuser()">Add New User</button>
        </div>
        <div class="table-responsive">
          <table class="table table-hover" id="location_user_table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Active</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($location_users as $location_user)
                  <tr>
                    <td>{{ $location_user->name }}</td>
                    <td>
                      <div class="custom-control custom-switch custom-control-inline">
                        <input type="checkbox" class="custom-control-input user-status" id="userStatusSwitch{{ $location_user->id }}" data-id="{{ $location_user->id }}"
                        @if ($location_user->status)
                          checked
                        @endif />
                        <label class="custom-control-label" for="userStatusSwitch{{ $location_user->id }}"></label>
                      </div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                          <i data-feather="more-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item edit-user" href="javascript:void(0);" data-toggle="modal" data-target="#edit_user_modal" data-id="{{ $location_user->id }}">
                            <i data-feather="edit-2" class="mr-50"></i>
                            <span>Edit</span>
                          </a>
                          <a class="dropdown-item" href="javascript:void(0);">
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
  <div class="modal fade text-left" id="edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Add New User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_user_form" style="padding: 20px;">
                @csrf
                <input type="hidden" name="location_user_id" id="location_user_id">
                <input type="hidden" name="location_id" id="location_id" value={{ $location_id }}>
                <div class="form-group">
                    <label for="user">User List</label>
                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save_location_user">Save</button>
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
  
      $("#location_user_table .edit-user").click(function() {
        $.ajax({
          type: "get",
          url: appUrl + '/admin/locations/getLocationUser',
          data: {id: $(this).data("id")},
          success: (res) => {
            var res = JSON.parse(res);
            $("#edit_user_form #user_id").val(res.data.user_id);
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
  
      $("#location_user_table .user-status").change(function() {
        $.ajax({
          type: 'post',
          url: appUrl + '/admin/locations/saveLocationUserStatus',
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
  
      $("#save_location_user").click(function() {
        var formdata = new FormData($("#edit_user_form")[0]);
        $.ajax({
          type: "post",
          url: appUrl + '/admin/locations/saveLocationUser',
          data: formdata,
          dataType:"JSON",
          processData: false,
          contentType: false,
          cache: false,
          success: (res) => {
            $("#edit_user_modal .close").trigger("click");
            $.ajax({
              type: 'get',
              url: appUrl + "/admin/locations/getLocationUsers",
              data: {id: $(".location-edit #location_id").val()},
              success: (res) => {
                $(".location-edit .tab-content #user").html(res)
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
    function addNewuser () {
      $("#location_user_id").val(0);
    }
  </script>
            