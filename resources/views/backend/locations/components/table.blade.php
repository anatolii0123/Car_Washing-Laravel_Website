<!-- Responsive Datatable -->
<section id="vehicleType-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Locations</h4>
                    <Button class="btn btn-primary waves-effect waves-float waves-light" data-toggle="modal" data-target="#location_modal" onclick="addNewLocation()">Add New Location</Button>
                </div>
                <div class="card-datatable col-12">
                    <table class="table datatables-ajax" id="location_table">
                        <thead>
                            <tr>
                                <th></th>
                                <th width="80%">Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Responsive Datatable -->
<script>
    function addNewLocation() {
        $("#location_modal #id").val(0);
    }
</script>