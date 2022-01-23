(function (window, undefined) {
  'use strict';
  
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  // appUrl = "";
  const router = {
    getVehicle: appUrl + "/admin/vehicles/get_list",
    getService: appUrl + "/admin/services/get_list",
    removeService: appUrl + "/admin/services/remove",
    getLocation: appUrl + "/admin/locations/get_list",
    editLocation: appUrl + "/admin/locations/edit",
    removeLocation: appUrl + "/admin/locations/delete",
    saveLocationGeneral: appUrl + "/admin/locations/save_general",
    getLocationServices: appUrl + "/admin/locations/getLocationServices",
    getLocationVehicles: appUrl + "/admin/locations/getLocationVehicles",
    getLocationPesuboxs: appUrl + "/admin/locations/getLocationPesuboxs",
    getLocationUsers: appUrl + "/admin/locations/getLocationUsers",
  }

  var vehicleTypeTable = $('#vehicle_table');
  if (vehicleTypeTable.length) {
    vehicleTypeTable.DataTable({
      processing: true,
      serverSide: true,
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..',
        paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
        }
      },
      order:[2,'desc'],
      ajax: router.getVehicle,
      "lengthMenu": [[10, 50, 200, 1000000000], [10, 50, 200, "All"]],
      "pageLength": 10,
      columns: [
        { data: 'id', name: 'id', "visible": false },
        { data: 'name', name: 'name' },
        { data: 'icon', name: 'icon' },
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          targets: 2,
          render: function (data, type, full, meta) {
            var icon = full['icon'];
            return '<span class="cbs-vehicle-icon cbs-vehicle-icon-' + icon + '" id="preview_icon"></span>';
          }
        },
        {
          // Actions
          targets: 3,
          title: 'status',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="btn-group">' +
                  '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                      feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                  '</a>' +
                  '<div class="dropdown-menu dropdown-menu-right">' +
                      '<a data-toggle="modal" data-target="#vehicle_type_modal" class="dropdown-item edit-vehicle" >' +
                      feather.icons['archive'].toSvg({ class: 'font-small-4 mr-50' }) +
                      'Edit</a>' +
                  '</div>' +
              '</div>'
            );
          },
        }
      ],
    });

    var vehicleTypeData;

    vehicleTypeTable.on("click", 'tr', function() {
      vehicleTypeData = vehicleTypeTable.DataTable().row(this).data();
      $("#vehicle_type_modal #vehicle_id").val(vehicleTypeData.id);
      $("#vehicle_type_modal #name").val(vehicleTypeData.name);
      $("#vehicle_type_modal #icon").val(vehicleTypeData.icon);
    });

    $("#vehicle_type_modal #icon").change(function() {
      var prefix = "cbs-vehicle-icon-";
      var oldIcon = getValueFromClass($("#vehicle_type_modal #preview_icon"), prefix);
      $("#vehicle_type_modal #preview_icon").removeClass(prefix + oldIcon);
      $("#vehicle_type_modal #preview_icon").addClass(prefix + $("#vehicle_type_modal #icon").val());
    });
  }

  var serviceTable = $('#service_table');
  if ( serviceTable.length ) {
    serviceTable.DataTable({
      processing: true,
      serverSide: true,
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..',
        paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
        }
      },
      order:[2,'desc'],
      ajax: router.getService,
      "lengthMenu": [[10, 50, 200, 1000000000], [10, 50, 200, "All"]],
      "pageLength": 10,
      columns: [
        { data: 'id', name: 'id', "visible": false },
        { data: 'name', name: 'name' },
        { data: 'description', name: 'description' },
        { data: 'duration', name: 'duration' },
        { data: 'price', name: 'price' },
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          // Actions
          targets: 5,
          title: 'Action',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="btn-group">' +
                  '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                      feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                  '</a>' +
                  '<div class="dropdown-menu dropdown-menu-right">' +
                      '<a data-toggle="modal" data-target="#service_modal" class="dropdown-item edit-service" >' +
                      feather.icons['save'].toSvg({ class: 'font-small-4 mr-50' }) +
                      'Edit</a>' +
                      '<a class="dropdown-item delete-service" >' +
                      feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                      'Delete</a>' +
                  '</div>' +
              '</div>'
            );
          },
        }
      ],
    });

    var serviceData;

    serviceTable.on("click", 'tr', function() {
      serviceData = serviceTable.DataTable().row(this).data();
      $("#service_modal #id").val(serviceData.id);
      $("#service_modal #name").val(serviceData.name);
      $("#service_modal #description").val(serviceData.description);
      $("#service_modal #duration").val(serviceData.duration);
      $("#service_modal #price").val(serviceData.price);
    });

    serviceTable.on("click", "tr .delete-service", function() {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false,
        
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            url: router.removeService,
            type: 'post',
            data: {id: $("#service_modal #id").val()},
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
      });
    });
  }

  var locationTable = $('#location_table');
  if ( locationTable.length ) {
    locationTable.DataTable({
      processing: true,
      serverSide: true,
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..',
        paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
        }
      },
      order:[2,'desc'],
      ajax: router.getLocation,
      "lengthMenu": [[10, 50, 200, 1000000000], [10, 50, 200, "All"]],
      "pageLength": 10,
      columns: [
        { data: 'id', name: 'id', "visible": false },
        { data: 'name', name: 'name' },
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          // Actions
          targets: 2,
          title: 'Action',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="btn-group">' +
                  '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                      feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                  '</a>' +
                  '<div class="dropdown-menu dropdown-menu-right">' +
                      '<a class="dropdown-item" href="' + router.editLocation + '?id=' + full['id'] + '">' +
                      feather.icons['save'].toSvg({ class: 'font-small-4 mr-50' }) +
                      'Edit</a>' +
                      '<a class="dropdown-item delete-location" data-id="' + full['id'] + '" >' +
                      feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                      'Delete</a>' +
                  '</div>' +
              '</div>'
            );
          },
        }
      ],
    });
  }

  var locationGeneralForm = $("#location_general_form");
  if ( locationGeneralForm.length ) {
    // new Quill('#location_general_form #description_container .editor', {
    //   bounds: '#location_general_form #description_container .editor',
    //   modules: {
    //     formula: true,
    //     syntax: true,
    //     toolbar: '#location_general_form #description_container .quill-toolbar'
    //   },
    //   theme: 'snow'
    // });

    var locationGeneralForm = $("#location_general_form");

    $("#location_general_form #submit").click(function() {
      var formdata = new FormData($("#location_general_form")[0]);
      formdata.append('description', $("#location_general_form #description_container .editor").html());
      formdata.append('id', $("#location_id").val());
      $.ajax({
        url: router.saveLocationGeneral,
        type: 'post',
        data: formdata,
        dataType:"JSON",
        processData: false,
        contentType: false,
        cache: false,
        success: (res) => {
          Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: 'Saved general info.',
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
  }

  locationTable.on("click", "tr .delete-location", function() {
    var id = $(this).data("id");
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-outline-danger ml-1'
      },
      buttonsStyling: false,
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: router.removeLocation,
          type: 'post',
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
    });
  })

  // location service
  $(".location-edit #services-tab").click(function () {
    $.ajax({
      type: 'get',
      url: router.getLocationServices,
      data: {id: $(".location-edit #location_id").val()},
      success: (res) => {
        $(".location-edit .tab-content #services").html(res)
      },
      error: (err) => {
        console.log(err)
      }
    })
  });
  // end location service

  // location vehicle
  $(".location-edit #vehicles-tab").click(function () {
    $.ajax({
      type: 'get',
      url: router.getLocationVehicles,
      data: {id: $(".location-edit #location_id").val()},
      success: (res) => {
        $(".location-edit .tab-content #vehicles").html(res)
      },
      error: (err) => {
        console.log(err)
      }
    })
  });
  // end location vehicle

  // location pesubox
  $(".location-edit #pesubox-tab").click(function () {
    $.ajax({
      type: 'get',
      url: router.getLocationPesuboxs,
      data: {id: $(".location-edit #location_id").val()},
      success: (res) => {
        $(".location-edit .tab-content #pesubox").html(res)
      },
      error: (err) => {
        console.log(err)
      }
    })
  });
  // end location pesubox

  // location users
  $(".location-edit #user-tab").click(function () {
    $.ajax({
      type: 'get',
      url: router.getLocationUsers,
      data: {id: $(".location-edit #location_id").val()},
      success: (res) => {
        $(".location-edit .tab-content #user").html(res)
      },
      error: (err) => {
        console.log(err)
      }
    })
  });
  // end location users
})(window);


// help functions 
function getValueFromClass (object, pattern)
{
    try
    {
        var reg=new RegExp(pattern);
        var className=$(object).attr('class').split(' ');

        for(var i in className)
        {
            if(reg.test(className[i]))
                return(className[i].substring(pattern.length));
        }
    }
    catch(e) {}

    return(false);		
};	
