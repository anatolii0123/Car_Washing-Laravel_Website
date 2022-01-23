<!-- Responsive Datatable -->
<section id="vehicleType-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Services</h4>
                    <Button class="btn btn-primary waves-effect waves-float waves-light" data-toggle="modal" data-target="#service_modal" onclick="addNewService()">Add New Service</Button>
                </div>
                <div class="card-datatable col-12">
                    <table class="table datatables-ajax" id="service_table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Duration</th>
                                <th>Price</th>
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
    function addNewService() {
        $("#vechileTypeModal #vehicle_id").val(0);
    }
</script>