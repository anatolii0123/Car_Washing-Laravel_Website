<!-- Responsive Datatable -->
<section id="vehicleType-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Vehicle types</h4>
                    <Button class="btn btn-primary waves-effect waves-float waves-light" data-toggle="modal" data-target="#vehicle_type_modal" onclick="addNewVehicle()">Add New Vehicle</Button>
                </div>
                <div class="card-datatable col-12">
                    <table class="table datatables-ajax" id="vehicle_table">
                        <thead>
                            <tr>
                                <th></th>
                                <th width="45%">Name</th>
                                <th width="45%">Icon</th>
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
    function addNewVehicle() {
        $("#vechileTypeModal #vehicle_id").val(0);
    }
</script>