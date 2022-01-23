@extends('layouts.frontend.app')
@section('content')
<!-- Carousel Start -->
<div id="page-container" class="et-animated-content" style="padding-top: 80px; margin-top: -1px;">
    <div id="et-main-area">
        <div id="main-content">
            <article id="post-2209" class="post-2209 page type-page status-publish hentry">
                <div class="entry-content">
                    <div id="et-boc" class="et-boc">
                        <div class="et-l et-l--post">
                            <div class="et_builder_inner_content et_pb_gutters3">
                                <div class="et_pb_section et_pb_section_0 et_section_regular">
                                    <div class="et_pb_row et_pb_row_0">
                                        <div class="et_pb_column et_pb_column_4_4 et_pb_column_0  et_pb_css_mix_blend_mode_passthrough et-last-child">
                                            <div class="et_pb_module et_pb_code et_pb_code_0">
                                                <div class="et_pb_code_inner">		
                                                    <div class="cbs-main cbs-clear-fix cbs-template-public cbs-location-214 cbs-location-content-type-1 cbs-width-300" id="cbs_DEDDD26B1BFEF98749DB33CE250155F5">
                                                        <div class="cbs-notice cbs-notice-main">
                                                            <div class="cbs-notice-icon cbs-meta-icon">
                                                            </div>
                                                            <div class="cbs-notice-content">
                                                                <div class="cbs-notice-header"></div>
                                                                <div class="cbs-notice-text"></div>
                                                            </div>
                                                        </div>
                                                        <form class="cbs-form" method="post" action="{{ route('booking.store') }}">
                                                            <div class="alert alert-danger hide" style="display: none">
                                                                <ul>
                                                                </ul>
                                                            </div>
                                                            @if ($location != null)
                                                                <ul class="cbs-main-list cbs-clear-fix cbs-list-reset">
                                                                    <!-- Vehicle -->
                                                                    <li class="cbs-main-list-item cbs-main-list-item-vehicle-list cbs-clear-fix cbs-scroll-to-next-step">
                                                                        @include('frontend.partials.select-vehicle')
                                                                    </li>
                                                                    <!-- Service -->
                                                                    <li class="cbs-main-list-item cbs-main-list-item-service-list cbs-clear-fix">
                                                                        @include('frontend.partials.select-service')
                                                                    </li>
                                                                    {{-- pesubox --}}
                                                                    <li class="cbs-main-list-item cbs-main-list-item-service-list cbs-clear-fix">
                                                                        @include('frontend.partials.select-pesubox')
                                                                    </li>
                                                                    <!-- Date and time -->
                                                                    <li class="cbs-main-list-item cbs-main-list-item-calendar cbs-clear-fix cbs-scroll-to-next-step" id="calendar">
                                                                        @include('frontend.partials.calendar')
                                                                    </li>
                                                                    <!-- Booking summary -->
                                                                    <li class="cbs-main-list-item cbs-main-list-item-booking cbs-clear-fix">
                                                                        @include('frontend.partials.booking-summary')
                                                                    </li>
                                                                </ul>
                                                                <input type="hidden" name="location_id" id="location_id" value="{{ $location->id }}">
                                                            @else
                                                                <h1 style="text-align: center; font-size: 22px;">There is no location.</h1>
                                                            @endif
                                                        </form>
                                                    </div>
  
                                                </div>
                                            </div> <!-- .et_pb_code -->
                                        </div> <!-- .et_pb_column -->
                                    </div> <!-- .et_pb_row -->
                                </div> <!-- .et_pb_section -->		
                            </div><!-- .et_builder_inner_content -->
                        </div><!-- .et-l -->
                    </div><!-- #et-boc -->
                </div> <!-- .entry-content -->
            </article> <!-- .et_pb_post -->
        </div> <!-- #main-content -->
    </div>
</div>
<!-- Carousel End -->
<script>
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function() {
        $(".cbs-main").CBSPlugin();
    })
    $(".cbs-vehicle-list").on("click", "li", function () {
        $(".cbs-vehicle-list li").removeClass("active");
        $(this).addClass("active");
        $("#selected-vehicle-value").val($(this).data("vehicle-id"));
    });

    $(".cbs-form").submit(function(e) {
        var data = {};
        data.location_id = $(this).find("#location_id").val();
        data.first_name = $(this).find("[name=first_name]").val();
        data.last_name = $(this).find("[name=last_name]").val();
        data.company_name = $(this).find("[name=company_name]").val();
        data.email = $(this).find("[name=email]").val();
        data.phonenumber = $(this).find("[name=phonenumber]").val();
        data.vehicle_make_model = $(this).find("[name=vehicle_make_model]").val();
        data.message = $(this).find("[name=message]").val();
        data.vehicle_id = $(this).find("[name=vehicle_id]").val();
        data.pesubox_id = $(this).find("[name=pesubox_id]").val();
        // *** get service 
        data.service_id = [];
        $(this).find(".cbs-service-list li a.cbs-button.active").each(function() {
            data.service_id.push($(this).data("service-id"));
        });

        data.duration = $(this).find(".cbs-booking-summary-service-duration").text();
        data.price = $(this).find(".cbs-booking-summary-price-value").text();
        data.date = $(this).find(".cbs-date-list .cbs-state-selected a").data("value");

        $.ajax({
            type: 'post',
            url: appUrl + '/home/storeBooking',
            data: data,
            success: (res) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Your booking is ordered successfully.',
                    customClass: {
                    confirmButton: 'btn btn-success'
                    }
                });
                setTimeout(function() {
                    window.location.reload();
                }, 1000)
            },
            error: (err) => {
                var errHtml = "";
                for (key in err.responseJSON.errors) {
                    errHtml += "<li>" + err.responseJSON.errors[key][0] + "</li>";
                }
                $(".cbs-form").find(".alert").css("display", "block");
                $(".cbs-form").find(".alert ul").html(errHtml)
            }
        })
        e.preventDefault();
    });
</script>

@endsection