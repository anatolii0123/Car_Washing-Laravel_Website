/**
 * Created by janar on 15.09.15.
 */
var webStorage = {
    elemList: [
        'Bookings_driver',
        'Vehicles_number',
        'Bookings_email',
        'Makes_id',
        'Vehicles_model_id',
        'Bookings_phone',
        'Bookings_summary'
    ],

    init: function() {
        if(typeof(Storage) !== "undefined") {
            this.loadData();
            this.saveData();
        } else {
           console.log(Yii.t('js', 'No local storage support!'));
        }
    },

    loadData: function() {
        $.each(this.elemList, function(index, value) {
            if(localStorage.getItem(value) != undefined && $('#' + value) != undefined) {
                $('#' + value).val(localStorage.getItem(value));

                if(value == 'Makes_id') {
                    console.log($('#' + value).change());
                }
            }
        });
    },

    saveData: function() {
        $(document).on('change', '#Bookings_driver, #Vehicles_number, #Bookings_email, #Makes_id, #Vehicles_model_id, #Bookings_phone, #Bookings_summary', function() {
            localStorage.setItem($(this).attr('id'), $(this).val());
        });
    }
};