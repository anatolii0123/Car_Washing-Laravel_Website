<div class="col-sm-10 text-center" style="margin: -35px auto;">
    <h1>{{ $year }}</h1>
</div>

<div id="calendar"></div>
<input type="hidden" id="next_start_date" value="{{ date("Y-m-d", strtotime($start_date. ' + 3 days')) }}">
<input type="hidden" id="prev_start_date" value="{{ date("Y-m-d", strtotime($start_date. ' - 3 days')) }}">
<script type="text/javascript">
    $(function() {
        var pesuboxs = @json($pesuboxs);
        var data = @json($data);
        var resources = {};
        pesuboxs.map(box => {
            resources[box.id] = box.name;
        })
        $('#calendar').cal({
            resources : resources,
            // allowresize		: true,
            // allowmove		: true,
            allowselect		: true,
            // allowremove		: true,
            // allownotesedit	: true,
            daytimestart    : '08:00:00',
            startdate       : '{{ $start_date }}',
            daystodisplay   : 3,
            eventselect : function( uid ){
                getOrder(uid)
            },
            // Load events as .ics
            events : //'http://staff.digitalfusion.co.nz.local/time/calendar/leave/'
            data
        });

        $("#calendar .ui-cal-wrapper .ui-cal-date .ui-cal-time").click(function() {
            var date = $(this).parent().attr("date");
            var time = $(this).attr("time");
            var pesubox = $(this).parent().attr("resource");
            getOrder(0, date + " " + time, pesubox);
        })
    });
</script>