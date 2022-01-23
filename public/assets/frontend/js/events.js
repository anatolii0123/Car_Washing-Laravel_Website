$(function () {
	$('body').on('change','input:checkbox:checked',function (e) {
		$(this).closest('.checkbox').addClass('active');
		console.log(e);
	}).on('change','input:checkbox:not(:checked)',function (e) {
		$(this).closest('.checkbox').removeClass('active');
		console.log(e);
	});

	$('#slotChoose').hammer().on('swipeleft swiperight',function (e) {
		e.stopPropagation();
		var aResource=$('.day',this).attr('data-activeresource');
		var resources=$('.day',this).data('resources');
		if(e.type==='swipeleft'){
			if(aResource<resources)
				aResource++;
		}else if(e.type==='swiperight'){
			if(aResource>1)
				aResource--;
		}

		$('button[data-trigger]',this).removeClass('disabled');
		if(aResource==1)
			$('button[data-trigger=swiperight]',this).addClass('disabled');
		if(aResource==resources)
			$('button[data-trigger=swipeleft]',this).addClass('disabled');
		$('body').addClass('androidFix').removeClass('androidFix');
		$('.day',this).attr('data-activeresource',aResource);
	}).on('click','button[data-trigger]',function (e) {
		console.log(e);
		$('#slotChoose').trigger($(this).data('trigger'));
	});

	$('#yw0').bootstrapValidator({
		excluded:[':disabled'],
		submitButtons: 'button[type="submit"]',
        live: true,
		fields: {
			'Bookings[started_at]':{
				validators: {
					notEmpty: {
					},
					momentDate:{
						format: 'L LT',
					}
				}
			},
			'Bookings[ended_at]':{
				validators: {
					notEmpty: {
						message: ''
					},
					momentDate:{
						format: 'L LT',
					}
				}
			},
			'BookingResources[resource_id]':{
				validators: {
					notEmpty: {
						message: ''
					},
					integer: {}
				}
			},
			'Bookings[driver]':{
				validators: {
					notEmpty: {
						message: ''
					}
				}
			},
			'Bookings[email]':{
				validators: {
					notEmpty: {
						message: ''
					},
					emailAddress:{}
				}
			},
			'Bookings[phone]':{
				validators: {
					notEmpty: {
						message: ''
					}
				}
			},
			'Vehicles[number]':{
				validators: {
					notEmpty: {
						message: ''
					}
				}
			},
			'Vehicles[model_id]':{
				validators: {
					notEmpty: {
						message: ''
					}
				}
			},
			'Makes[id]':{
				validators: {
					notEmpty: {
						message: ''
					}
				}
			}
		}
	}).on('status.field.revalidate','input',function (e) {
		var name=$(this).attr('name');
		$(e.delegateTarget).data('bootstrapValidator').revalidateField(name);
	});
});