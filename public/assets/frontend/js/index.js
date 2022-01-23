if (!console) var console = {log: function() {}};
$(function () {
	moment.locale(Yii.translate.config.language);
    /*$('#Vehicles_model_id').select2({
        matcher: function(term, text, opt){
            return text.toUpperCase().indexOf(term.toUpperCase())>=0 || (opt.parent("optgroup").attr("label") != undefined && (opt.parent("optgroup").attr("label").toUpperCase() + ' ' + text.toUpperCase()).indexOf(term.toUpperCase())>=0)
        },
        formatSelection: function(state) {
            if(state.element[0].parentElement.label !== undefined)
                return $(state.element[0].parentElement).attr('label') + ' ' + state.text;
            else
                return state.text;
        }
    }).on('select2-open', function(e) {
		if( $(window).width() <= 480 ) {
			$('.select2-input').focus();
			$('html,body').animate({scrollTop: parseFloat($(this).offset().top)}, 800);
		}
	});*/
	moment.tz.setDefault('Europe/Tallinn');
	// $.Mustache.tags = ["[[", "]]"];

	$('#Makes_id').on('change', function(e) {
		var make_id = $(this).val();
		var elem = $('#Vehicles_model_id');
		elem.find("option:gt(0)").remove();

		if(make_id!==undefined && make_id!=0) {
			$.ajax({
				url:elem.data('url') + make_id,
				dataType:'json',
				success:function (data) {
					if(data){
						var sel = localStorage.getItem('Vehicles_model_id');
						$.each(data, function(key, value) {
							elem.append($('<option value="' + value.id + '" ' + ((sel && sel == value.id) ? 'selected="selected"' : '') + '>' + value.model  + '</option>'));
						});
						elem.attr('disabled', false);
						elem.change();
					}
				}
			});
		}
	});

    $('#Vehicles_model_id').change(function(e) {
        var model_id = $(this).val();
        var priceHolder = $('.priceHolder');
		console.log('changed', model_id);
        if(model_id!==undefined && model_id!=0) {
            var total = 0;
            // $.ajax({
            //     url:priceHolder.data('url'),
            //     data:$('form').serialize(),
            //     dataType:'json',
            //     success:function (data) {
            //         if(data){
            //             for(var i=0; i< data.length; i++) {
            //                 total += parseFloat(data[i].price);
            //             }
            //         }

            //         if(total>0) {
            //             priceHolder.text(total).parent().fadeIn();
            //         }
            //         else
            //             priceHolder.parent().hide();
            //     }
            // });
        }
    });

	$('#dataFetcher').submit(function (e) {
		e.preventDefault();
		var parent=this;
		if($(this).data('previous')){
			$(this).data('previous').abort();
		}
		$(this).data('previous',$.ajax({
			url:$(parent).attr('action'),
			data:$(parent).serialize(),
			type:$(parent).attr('method'),
			cache:false,
			success: function (data) {
				var data = JSON.parse(data);
				var dayData=new Builder(data);
				$('#slotChoose').data('builder',dayData);

				var dateTimePicker=$('#datetimepicker').data("DateTimePicker");

				var currentDate=dateTimePicker.getDate();

				var maxDate=moment().add(dayData.office.bookingMaxTime,'m').endOf('day');
				var minDate=moment().add(dayData.office.bookingMinTime,'m').startOf('day');

				dateTimePicker.setMaxDate(maxDate);
				dateTimePicker.setMinDate(minDate);


				$('[data-modify-dp="#datetimepicker"][data-days]').each(function () {
					
					var d=$(this).data('days');

					if(moment(currentDate).add(d,'d').isBefore(minDate) || moment(currentDate).add(d,'d').isAfter(maxDate)){
						$(this).addClass('disabled');
					}else{
						$(this).removeClass('disabled');
					}

				});

				$('#services-collapse').trigger('change');

			}
		}));
	});

	// $("#yw0").submit(function(e) {
	// 	e.preventDefault();
	// 	var parent=this;
	// 	var formdata = new FormData();
	// 	$.ajax({
	// 		type: 'post',

	// 	})
	// 	console.log(formdata)
	// })

	$('#datetimepicker').datetimepicker({
		pickTime:false,
		language:Yii.translate.config.language
	}).on('dp.change',function (e) {
		$('span',this).each(function  (o,i) {
			$(this).text(e.date.format($(this).data('date-format')));
		});

		$('#dataFetcher').submit();
	}).data('DateTimePicker').setDate(moment());


	$('body')
	.on('change','#services-collapse',function (e) {
		var sum=0;
		// $('.active',this).removeClass('active');
		$('input:checked',this).each(function () {
			sum +=$(this).data('duration');
			// $(this).closest('li').addClass('active');
		});
		
		var dayData=$('#slotChoose').data('builder');
		dayData.setRequiredLength(sum);
		$("#duration").val(sum);
		$('#slotChoose').empty().mustache('day',dayData.days).trigger('swiperight').trigger('append');
	})
	.on('click','#slotChoose a[data-changeformdata]',function (e) {
		var data=$(this).data('changeformdata');
		var $form=$($(this).data('changeform'));
		for(var dIn in data) {
			if(!data.hasOwnProperty(dIn)) continue;
			$('[name="'+dIn+'"]',$form).val(data[dIn]).trigger('status.field.revalidate').trigger('change');
		}
		$(".nav-tabs").find("li:nth-child(2) a").trigger("click");
	})
	.on('show.bs.tab','[role=tablist] a',function (e) {
		var validate;
		
		if($(this.hash).data('validate')){
			validate=$(this.hash).data('validate');
			$('input:not(:checkbox)',validate).trigger('status.field.revalidate');
			if(!$('#yw0').data('bootstrapValidator').isValidContainer(validate)){
				e.preventDefault();
				window.location.hash=validate;
			}
		}
	})
	.on('shown.bs.tab','[role=tablist] a',function (e) {
		$(window).scrollTop() > 0 ? $(window).scrollTop(0) : $('.container').scrollTop(0);
		window.location.hash=this.hash;
		if(this.hash == '#step2') {
			webStorage.init();
		}
	})
	.on('shown.bs.tab','[role=tablist] a[data-toggle="tab"][data-show]',function (e) {
		if(t=$(this).data('show'))
			$(t).show();
	})
	.on('shown.bs.tab','[role=tablist] a[data-toggle="tab"][data-hide]',function (e) {
		if(t=$(this).data('hide'))
			$(t).hide();
	})

	.on('click','[data-modify-dp]',function (e) {
		var $this=$(this);
		var dPicker=$($this.data('modify-dp')).data('DateTimePicker');
		var newDate=moment();
		if($this.data('days'))
			newDate=moment(dPicker.getDate()).add($this.data('days'),'d');
		else if($this.data('from'))
			newDate.add($this.data('from'),'d');

		$($this.data('modify-dp')).data('DateTimePicker').setDate(newDate);
	})
	.on('click','[data-click]',function (e) {
		$($(this).data('click')).click();
	});
	
	$(window).on('hashchange',function (e) {
		e.preventDefault();
		$('[role=tablist] :not(.active) a[href='+this.location.hash+']').tab('show');
	});

	$('[data-showValue]').each(function () {
		$('body').on('change',$(this).attr('data-showValue'),this,function (e) {
			if($(e.data).data('function')==='moment'){
				$(e.data).text(moment($(this).val(),'DD.MM.YYYY HH:mm').format($(e.data).data('format')));
			} else if($(e.data).data('function')==='mustache') {
				var d=[];
				var $elements=$($(e.data).data('showvalue')).filter($(e.data).data('filter'));
				$elements.each(function () {
					d.push($(this).data());
				});
				$(e.data).empty().mustache($(e.data).data('template'),d);
			}else{
				$(e.data).text($(this).val());
			}
		});
	});

	$('[role=tablist] a[data-toggle="tab"]:first').click();

	$.Mustache.addFromDom();
	

	$('#champaign_modal').modal({});
});

function Builder (data) {
	this.days=[];
	this.office=null;
	this.init(data);
}
Builder.prototype.init = function(data) {
	this.office=new Office(data.office);
	for(var dIn in data.days){
		if(!data.days.hasOwnProperty(dIn)) continue;
		this.days.push(new Day(data.days[dIn],this));
	}
};
Builder.prototype.getSpan = function() {
	
	var min=this.days.map(function (day) {
		if(!day.openTime)
			return false;
		return day.openTime.start;
	}).reduce(function (prev,curr,index,val) {
		if(prev!==false || curr>=prev)
			return curr;
		return prev;
	});
	var max=this.days.map(function (day) {
		if(!day.openTime)
			return false;
		return day.openTime.end;
	}).reduce(function (prev,curr,index,val) {
		if(prev!==false || curr<=prev)
			return curr;
		return prev;
	});

	return {
		min:min,
		max:max
	};
};
Builder.prototype.setRequiredLength = function(minutes) {
	for(var dIn in this.days){
		for(var rIn in this.days[dIn].resources){
			if(this.days[dIn].resources.hasOwnProperty(rIn))
				this.days[dIn].resources[rIn].planBooking(minutes);
		}
	}
};


function Day (dayObject,parent) {
	this.parent=parent;
	this.date=moment.unix(dayObject.date);
	this.openTime=null;
	this.resources=[];

	this.init(dayObject);
}
Day.prototype.init = function(dayObject) {
	if(dayObject.openTimes)
		this.openTime=new OpenTime(dayObject.openTimes,this);
	for(var dIn in dayObject.resources){
		if(!dayObject.resources.hasOwnProperty(dIn)) continue;
		
		this.resources.push(new Resource(dayObject.resources[dIn],this));
	}
};
Day.prototype.resourceCount = function() {
	return this.resources.length;
};
Day.prototype.getSlots = function() {
	var span=this.parent.getSpan();
	var ret=[];
	for (var i = span.min; i < span.max; i++) {
		ret.push(this.openTime.slotIds[i]);
	}
	return ret;
};

function OpenTime (openTimeObj,parent) {
	this.parent=parent;
	this.timeSlots=0;
	this.start=0;
	this.end=0;

	this.slots=[];
	this.slotIds={};

	this.init(openTimeObj);
}
OpenTime.prototype.init = function(openTimeObj) {
	this.start=parseInt(openTimeObj.slot_start);
	this.end=parseInt(openTimeObj.slot_end);
	this.timeSlots=parseInt(24*60/(this.parent.parent.office.slot_length));
	this.buildSlots();
};
OpenTime.prototype.buildSlots = function() {
	for (var i = 0; i < this.timeSlots; i++) {
		this.slotIds[i]=new TimeSlot(i,this);
		this.slots.push(this.slotIds[i]);
	}
};
OpenTime.prototype.isOpen = function(timeSlot) {
	if(timeSlot>=this.start && timeSlot<this.end)
		return true;
	return false;
};
OpenTime.prototype.canBook = function(timeSlot) {
	var now=moment();
	return true;
};

function TimeSlot (place,parent) {
	this.parent=parent;
	this.place=place;
	this.init();
}
TimeSlot.prototype.init = function() {
	// body...
};
TimeSlot.prototype.isOpen = function() {
	if(!parent.openTime)
		return false;
	return parent.openTime.isOpen(this.place);
};
TimeSlot.prototype.getTime = function() {
	return moment().startOf('day').add(this.place*this.parent.parent.parent.office.slot_length,'m').format('HH:mm');
};
TimeSlot.prototype.canBook = function() {
	if(!parent.openTime)
		return false;
	return parent.openTime.canBook(this.place);
};

function Resource (resourceObj,parent) {
	this.id=resourceObj.id;
	this.parent=parent;
	this.name=resourceObj.name;
	this.slots=[];
	this.slotIds={};
	this.bookings=[];

	this.init(resourceObj);
}
Resource.prototype.init = function(resourceObj) {
	if(this.buildSlots()){
		for(var bIn in resourceObj.bookings_slots){
			if(!resourceObj.bookings_slots.hasOwnProperty(bIn)) continue;

			this.addBooking(resourceObj.bookings_slots[bIn]);
		}
	}
};
Resource.prototype.addBooking = function(bookingObj) {
	this.bookings.push(new Booking(bookingObj,this));
};
Resource.prototype.planBooking = function(minutes) {
	this.cleanPlans();
	if(!minutes)
		return false;
	var slots=this.getSlots();
	for(var sId in slots){
		if(!slots.hasOwnProperty(sId)) continue;
		var slot=slots[sId];
		if(this.canFit(slot.place,Math.ceil(minutes/this.parent.parent.office.slot_length)+slot.place)){
			if(slot.canBook()){
				slot.addPlan({
					slot_start:slot.place,
					slot_end:Math.ceil(minutes/this.parent.parent.office.slot_length)+slot.place
				});
				
			}
		}
	}
};
Resource.prototype.cleanPlans = function() {
	for(var sId in this.slots){
		if(!this.slots.hasOwnProperty(sId)) continue;
		this.slots[sId].cleanPlans();
	}
};
Resource.prototype.buildSlots = function() {
	if(this.parent.openTime){
		for (var i = 0; i <= this.parent.openTime.timeSlots; i++) {
			this.slotIds[i]=new ResourceSlot(i,this);
			this.slots.push(this.slotIds[i]);
		}
		return true;
	}
	return false;
};
Resource.prototype.getSlots = function() {
	var span=this.parent.parent.getSpan();
	var ret=[];
	for (var i = span.min; i < span.max; i++) {
		ret.push(this.slotIds[i]);
	}
	return ret;
};
Resource.prototype.canFit = function(from,to) {
	for (var i = from; i < to; i++) {
		if(this.slotIds[i].bookings.length)
			return false;
		if(!this.slotIds[i].isOpen())
			return false;
	}
	return true;
};

function ResourceSlot (place,parent) {
	this.parent=parent;
	this.place=place;
	this.bookings=[];
	this.plans=[];

	this.time=moment(this.parent.parent.date).add(this.place*this.parent.parent.parent.office.slot_length,'m');
	this.init();
}
ResourceSlot.prototype.init = function() {
	// console.log(this);
};
ResourceSlot.prototype.addBooking = function(booking) {
	this.bookings.push(booking);
};
ResourceSlot.prototype.addPlan = function(plan) {
	this.plans.push(new BookingPlan(plan,this));
};
ResourceSlot.prototype.isOpen = function() {
	if(!this.parent.parent.openTime)
		return false;
	return this.parent.parent.openTime.isOpen(this.place);
};
ResourceSlot.prototype.isFree = function() {
	if(!this.bookings.length)
		return true;
	return !this.isOpen();
};
ResourceSlot.prototype.canBook = function() {
	var min=moment().add(this.parent.parent.parent.office.bookingMinTime,'m');
	var max=moment().add(this.parent.parent.parent.office.bookingMaxTime,'m');
	if(this.time.diff(min,'m')>0 && this.time.diff(max,'m')<0){
		return true;
	}

	return false;

};
ResourceSlot.prototype.cleanPlans = function() {
	this.plans=[];
};
ResourceSlot.prototype.getTime = function() {
	return this.time.format('DD.MM.YYYY');
};


function Booking (bookingObj,parent) {
	this.id=bookingObj.id;
	this.parent=parent;
	this.start=bookingObj.slot_start;
	this.end=(bookingObj.slot_end-1);
	this.duration=bookingObj.slot_duration;
	this.type='booking';

	this.init();
}
Booking.prototype.init = function() {
	for (var i = this.start; i <= this.end; i++) {
		this.parent.slotIds[i].addBooking(this);
	}
};

function BookingPlan (planObj,parent) {
	this.parent=parent;
	this.start=planObj.slot_start;
	this.end=(planObj.slot_end);
	this.type='plan';
}
BookingPlan.prototype.getFrom = function() {
	return moment(this.parent.parent.parent.date).add(this.parent.parent.parent.parent.office.slot_length*this.start,'m').format('DD.MM.YYYY HH:mm');
};
BookingPlan.prototype.getTo = function() {
	return moment(this.parent.parent.parent.date).add(this.parent.parent.parent.parent.office.slot_length*this.end,'m').subtract(1,'s').format('DD.MM.YYYY HH:mm');
};
//BookingPlan.prototype.init = Booking.prototype.init;

function Office (officeObj) {
	this.id=officeObj.id;
	this.slot_length=officeObj.slot_length;
	this.bookingMinTime=(officeObj.allow_brn_min_time==='0')?0:parseInt(officeObj.brn_min_time);
	this.bookingMaxTime=(officeObj.allow_brn_max_time==='0')?60*24*365:parseInt(officeObj.brn_max_time);
}
Office.prototype.getSlots = function() {
	return 3600*24/this.slot_length;
};