var moveCalendar = function(event, step)
    {
        event.preventDefault();
        
        var calendarBox=container.find('.cbs-calendar-table-wrapper');
        var calendar=calendarBox.find('.cbs-calendar');
        var columnActive=Math.abs($('th.cbs-active').index());
        var visibleColumns=parseInt(container.find('input[name="cbs-calendar-column-count"]').val());
        var hiddenColumns;
        var calendarStep;
        var activeColumnStep;
        
        if(Math.abs(step)<=visibleColumns)
            calendarStep=step;
        else
            calendarStep=(step>0 ? visibleColumns : -visibleColumns);
        
        if(calendarStep>0)
        {
            if(isVisibleColumn('last'))
            {
                createCalendar(calendarStep);
                return;
            }
        }
        else
        {
            if(isVisibleColumn('first'))
            {
                createCalendar(calendarStep);
                return;
            }
        }
        
        if((columnActive===6) && (calendarStep>0)) return;
        if((columnActive===0) && (calendarStep<0)) return;
        
        if(calendarStep>0)
        {
            //count the number of hidden columns on the right side
            hiddenColumns=7-calendar.find('th:visible:last').index()-1;
        }
        else
        {
            //count the number of hidden columns on the left side
            hiddenColumns=calendar.find('th:visible:first').index();
        }
        
        if(Math.abs(calendarStep)>hiddenColumns)
            activeColumnStep=(calendarStep>0 ? hiddenColumns : -hiddenColumns);
        else
            activeColumnStep=calendarStep;

        columnActive+=activeColumnStep;
        
        calendar.find('th').removeClass('cbs-active');
        calendar.find('th:eq('+columnActive+')').addClass('cbs-active');
        
        hideCalendarColumn();
    };

var isVisibleColumn=function(number)
{
    var calendarBox=$this.find('.cbs-calendar-table-wrapper');
    var calendar=calendarBox.find('.cbs-calendar');
    
    if((calendar.find('th:first').css('display')!=='none') && (number==='first')) return(true);
    if((calendar.find('th:last').css('display')!=='none') && (number==='last')) return(true);
    
    return(false);
};