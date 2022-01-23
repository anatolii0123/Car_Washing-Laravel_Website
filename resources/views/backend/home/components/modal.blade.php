    <style>
        .order-form #duration button {
            margin: 8px;
            width: 75px;
        }

        .order-form #duration button.selected {
            background-color: #0c838e;
            color: white;
        }
    </style>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Add New Vehicle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="order-form">
                @csrf
                <input type="hidden" name="id" value={{ $id }}>
                <input type="hidden" name="location_id" value="{{ $location_id }}">
                <input type="hidden" name="duration" value="@if ($order != null)
                {{ $order->duration }}
            @else 30 @endif">
                <input type="hidden" name="service_id" value="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="start_time">Start Time</label>
                            <input type="text" id="start_time" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" value='@if ($order != null)
                                {{ $order->date . " " . $order->time }}
                            @endif' name="datetime" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="end_time">End Time</label>
                            <input type="text" id="end_time" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" value='@if ($order != null)
                                {{ $end_time }}
                            @endif' name="enddatetime" disabled/>
                        </div>
                        <div class="col-md-12 form-group" id="duration">
                            <label for="start_time">Duration</label>
                            <div class="flex">
                                <button type="button" class="btn btn-default item @if($order != null && $order->duration == 30) selected @endif" data-value="30">0.5H</button>
                                <button type="button" class="btn btn-default item @if($order != null && $order->duration == 60) selected @endif" data-value="60">1H</button>
                                <button type="button" class="btn btn-default item @if($order != null && $order->duration == 90) selected @endif" data-value="90">1.5H</button>
                                <button type="button" class="btn btn-default item @if($order != null && $order->duration == 120) selected @endif" data-value="120">2H</button>
                                <button type="button" class="btn btn-default item @if($order != null && $order->duration == 150) selected @endif" data-value="150">2.5H</button>
                                <button type="button" class="btn btn-default item @if($order != null && $order->duration == 180) selected @endif" data-value="180">3H</button>
                                <button type="button" class="btn btn-default item @if($order != null && $order->duration == 210) selected @endif" data-value="210">3.5H</button>
                                <button type="button" class="btn btn-default item" data-value="600">Max</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="selectDefault">Vechiles</label>
                                <select class="form-control mb-1" id="icon" name="vehicle_id">
                                    @foreach ($location_vehicles as $vehicle)
                                        <option value={{ $vehicle->id }} @if ($order != null && $order->vehicle_id == $vehicle->id)
                                            selected
                                        @endif >{{ $vehicle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <button type="button" class="btn btn-round" id="services">Services</button>
                                    <ul class='list-style text-left' style="margin-top: 10px">
                                        @foreach ($location_services as $service)
                                            @if ($order != null && in_array($service->id, explode(",", $order->service_id)))
                                                <li>{{ $service->name }}</li>
                                            @endif 
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6 text-center">
                                    <button type="button" class="btn btn-round" id="pesuboxs">Pesuboxs</button>
                                    <ul class='list-style text-left' style="margin-top: 10px">
                                        @foreach ($location_pesuboxs as $pesubox)
                                            @if ($order != null && $order->pesubox_id == $pesubox->id)
                                                <li>{{ $pesubox->name }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <label>Services</label>
                            <div class="form-group">
                                <select class="select2 form-control" multiple="multiple" id="service_id" name="service_id[]">
                                    @foreach ($location_services as $service)
                                        <option value={{ $service->id }} @if ($order != null && in_array($service->id, explode(",", $order->service_id)))
                                            selected
                                        @endif >{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="selectDefault">Pesubox</label>
                                <select class="form-control mb-1" id="icon" name="pesubox_id">
                                    @foreach ($location_pesuboxs as $pesubox)
                                        <option value={{ $pesubox->id }} @if ($order != null && $order->pesubox_id == $pesubox->id)
                                            selected
                                        @endif >{{ $pesubox->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-6 form-group">
                            <label for="start_time">Nimi</label>
                            <input type="text" class="form-control" name="driver" value="@if ($order != null) {{ $order->driver }} @endif" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="start_time">Email</label>
                            <input type="text" class="form-control" name="email" value="@if ($order != null) {{ $order->email }} @endif" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="start_time">Phone</label>
                            <input type="text" class="form-control" name="phone" value="@if ($order != null) {{ $order->phone }} @endif" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="start_time">Number</label>
                            <input type="text" class="form-control" name="number" value="@if ($order != null) {{ $order->number }} @endif" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="start_time">Vehicle Make</label>
                            <select class="form-control mb-1" id="mark" name="mark_id">
                                @foreach ($location_marks as $mark)
                                    <option value={{ $mark->id }} @if ($order != null && $order->mark_id == $mark->id)
                                        selected
                                    @endif >{{ $mark->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="start_time">Vehicle Make model</label>
                            <select class="form-control mb-1" id="model" name="model_id">
                                @foreach ($location_mark_models as $model)
                                    <option value={{ $model->id }} @if ($order != null && $order->model_id == $model->id)
                                        selected
                                    @endif >{{ $model->model }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="start_time">Message</label>
                            <textarea type="text" class="form-control" name="summary">@if ($order != null) {{ $order->summary }} @endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit" class="btn btn-primary">Save</button>
                    @if ($order != null)
                    <button type="button" id="delete" class="btn btn-primary" data-id="{{ $order->id }}">Delete</button>
                    @endif
                    <button type="button" class="btn btn-red text-white" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade text-left" id="service_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Services</h4>
                    <button type="button" class="close" onclick="closeServiceModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($location_services as $service)
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{ $service->id }}" data-duration="{{ $service->duration }}" data-value="{{ $service->id }}" @if ($order != null && in_array($service->id, explode(",", $order->service_id)))
                                        checked
                                    @endif 
                                    >
                                    <label class="custom-control-label" for="{{ $service->id }}">{{ $service->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeServiceModal()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="pesubox_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Pesubox</h4>
                    <button type="button" class="close" onclick="closePesuboxModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($location_pesuboxs as $pesubox)
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="inlineRadioOptions"
                                        id="radio{{ $pesubox->id }}"
                                        value="{{ $pesubox->id }}"
                                        data-value="{{ $pesubox->id }}"
                                        @if ($order != null && $order->pesubox_id == $pesubox->id)
                                            checked
                                        @endif
                                    />
                                    <label class="form-check-label" for="radio{{ $pesubox->id }}">{{ $pesubox->name }}</label>
                                    {{-- <input type="radio" class="custom-control-input" id="{{ $pesubox->id }}" data-value="{{ $pesubox->id }}"/>
                                    <label class="custom-control-label" for="{{ $pesubox->id }}">{{ $pesubox->name }}</label> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closePesuboxModal()">Save</button>
                </div>
            </div>
        </div>
    </div>
<script>
    var location_lasttimes = '{{ $location_lasttimes }}';
    location_lasttimes = location_lasttimes.replace(/&quot;/g, '"');
    location_lasttimes_array = JSON.parse(location_lasttimes);
    $(function() {
        $("#start_time").flatpickr({
            enableTime: true
        });

        $('.select2').select2();

        $(".order-form #submit").click(function() {
            var formdata = new FormData($(".order-form")[0]);
            var service_id = [];

            if ($("#start_time").val() == "") {
                return alert("Please select the time")
            }

            // console.log(formdata.get("service_id"));
            $("#service_modal input[type=checkbox]").each(function() {
                if ($(this).prop("checked")) {
                    service_id.push($(this).data("value"))
                }
            })
            // if (service_id.length == 0) {
            //     return alert("Please select the service")
            // }
            formdata.set("service_id", service_id)

            var pesubox_id = [];
            $("#pesubox_modal input[type=radio]").each(function() {
                if ($(this).prop("checked")) {
                    pesubox_id.push($(this).data("value"))
                }
            })
            if (pesubox_id.length == 0) {
                return alert("Please select the Pesubox")
            }
            formdata.set("pesubox_id", pesubox_id)
            // console.log(formdata.get("service_id"));
            // return;
            $.ajax({
                type: "post",
                url: appUrl + '/admin/updateOrder',
                data: formdata,
                dataType:"JSON",
                processData: false,
                contentType: false,
                cache: false,
                success: (res) => {
                    if (res.success) {
                        window.location.reload();
                    } else {
                        if (res.message) {
                            alert(res.message);
                        } else {
                            alert('Something is Wrong');
                        }
                    }
                },
                error: (err) => {
                    console.log(err);
                }
            });
        })

        $("#mark").change(function() {
            $.ajax({
                type: "post",
                url: appUrl + '/admin/getModel',
                data: {mark_id: $(this).val()},
                success: (res) => {
                    console.log(res)
                    $("#model").html(res);
                },
                error: (err) => {
                    console.log(err);
                }
            });
        })

        $("#duration .item").click(function() {
            $("#duration").find(".selected").removeClass("selected");
            if (navigator.userAgent.toLowerCase().indexOf("iphone") ==-1) {
                var d = new Date($("#start_time").val());
            } else {
                var t = $("#start_time").val().split(/[- :]/);
                // Apply each element to the Date function
                var actiondate = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                var d = new Date(actiondate);
            }
            if ($(this).data("value") != '600') {
                $(".order-form [name=duration]").val($(this).data("value"));
                d.setMinutes(d.getMinutes() * 1 + $(".order-form [name=duration]").val() * 1);
                $("#end_time").val(d.getFullYear() + "-" + String(d.getMonth() + 1).padStart(2, '0') + "-" + String(d.getDate()).padStart(2, '0') + " " + String(d.getHours()).padStart(2, '0') + ":" + String(d.getMinutes()).padStart(2, '0'))
                $(this).addClass("selected");
            } else {
                if ($("#start_time").val() == "") {
                    return alert("please select the start date");
                }
                $.ajax({
                    type: "post",
                    url: appUrl + '/admin/getDayEndTime',
                    data: {date: $("#start_time").val(),location_id: $("input[name=location_id]").val()},
                    success: (res) => {
                        res = JSON.parse(res)
                        $(".order-form [name=duration]").val(res.difference);
                        $("#end_time").val(res.end_time)
                        $(this).addClass("selected");
                    },
                    error: (err) => {
                        console.log(err);
                    }
                });
            }
            
        })

        $("#start_time").change(function() {
            var d = new Date($(this).val());
            d.setMinutes(d.getMinutes() + $(".order-form [name=duration]").val());
            $("#end_time").val(d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate() + " " + d.getHours() + ":" + d.getMinutes())
        });

        $("#services").click(function() {
            $("#service_modal").modal("show");
        });

        $("#pesuboxs").click(function() {
            $("#pesubox_modal").modal("show");
        });

        $("#delete").click(function() {
            $.ajax({
                type: "post",
                url: appUrl + '/admin/deleteOrder',
                data: {id: $(this).data("id")},
                success: (res) => {
                    console.log(res)
                    res = JSON.parse(res);
                    if (res.success) {
                        window.location.reload();
                    } else {
                        alert("Something is wrong");
                    }
                },
                error: (err) => {
                    console.log(err);
                }
            });
        });

        $("#service_modal").find("input[type=checkbox]").change(function() {
            var duration = 0;
            $("#service_modal input[type=checkbox]").each(function() {
                if ($(this).prop("checked")) {
                    duration += ($(this).data("duration") / 30) != Math.floor($(this).data("duration") / 30) ? ((Math.floor($(this).data("duration") / 30) + 1) * 30) : $(this).data("duration");
                }
            })
            $("#duration").find("button.selected").removeClass("selected");
            $("#duration").find("button").each(function() {
                if ($(this).data("value") == duration) {
                    $(this).addClass("selected");
                }
            });
            $(".order-form [name=duration]").val(duration);
            var d = new Date($("#start_time").val());
            d.setMinutes(d.getMinutes() * 1 + $(".order-form [name=duration]").val() * 1);
            $("#end_time").val(d.getFullYear() + "-" + String(d.getMonth() + 1).padStart(2, '0') + "-" + String(d.getDate()).padStart(2, '0') + " " + String(d.getHours()).padStart(2, '0') + ":" + String(d.getMinutes()).padStart(2, '0'))
        })
    });

    function closeServiceModal() {
        $("#service_modal").modal("hide");
    }

    function closePesuboxModal() {
        $("#pesubox_modal").modal("hide");
    }
</script>
