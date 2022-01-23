
<div class="cbs-main-list-item-section-header cbs-clear-fix">
    <span class="cbs-main-list-item-section-header-step">
      <span>3</span>
      <span>/4</span>
    </span>
    <h4 class="cbs-main-list-item-section-header-header">
      <span>Select date and time</span>			
    </h4>
    <h5 class="cbs-main-list-item-section-header-subheader">
      <span>Click on any time to make a booking.</span>				
    </h5>
</div>
<div id="picker"></div>

<div class="cbs-main-list-item-section-content cbs-clear-fix">
  <div class="cbs-main-list-item-section-content cbs-clear-fix">
    <div class="cbs-calendar-header">
      <a href="#" class="cbs-calendar-header-arrow-left cbs-meta-icon cbs-meta-icon-arrow-horizontal" data-advance-period="7" data-nsfw-filter-status="swf"></a>
      <span class="cbs-calendar-header-caption" data-nsfw-filter-status="swf">
        <span class="cbs-calendar-month-number-10" style="display: inline;" data-nsfw-filter-status="swf">{{ $slots_data[0]['strdate'] }}</span>				
      </span>
      <a href="#" class="cbs-calendar-header-arrow-right cbs-meta-icon cbs-meta-icon-arrow-horizontal" data-advance-period="7" data-nsfw-filter-status="swf"></a>
    </div>
    <div class="cbs-calendar-table-wrapper" style="width: 1021px;">
      <table class="cbs-calendar" cellpadding="0" cellspacing="0" border="0">
        <tbody>
          <tr class="cbs-calendar-subheader">
            @foreach ($slots_data as $slots1)
              <th class="cbs-date-id-{{ $slots1['fulldate'] }} cbs-active" data-date-full="{{ $slots1['strdate'] }}" style="display: table-cell;">
                <div class="cbs-clear-fix">
                  <span class="cbs-calendar-subheader-day-number" data-nsfw-filter-status="swf">{{ $slots1['date'] }}</span>
                  <span class="cbs-calendar-subheader-day-name" data-nsfw-filter-status="swf">{{ $slots1['day'] }}</span>
                </div>
              </th>
            @endforeach
          </tr>
          <tr class="cbs-calendar-data">
          @foreach ($slots_data as $slots)
            <td style="display: table-cell;">
              <div>
                <ul class="cbs-list-reset cbs-state-to-hidden cbs-date-list">
                  @foreach ($slots['slots'] as $slot)
                    <?php 
                      $time = strtotime(substr($slots['fulldate'], 4, 4) . "-" . substr($slots['fulldate'], 2, 2) . "-" . substr($slots['fulldate'], 0, 2) . " " . $slot);
                      
                    ?>
                    <li class="@if ($usedtime == 'none')
                      disable
                      @elseif (in_array($time, $usedtime))
                      disable
                      @else
                      
                      @endif">
                      <a href="#" data-nsfw-filter-status="swf" data-value="{{ $slots['fulldate'] }}{{ $slot }}" >{{ substr($slot, 0, 5) }}</a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </td>
          @endforeach
          </tr>
        </tbody>
      </table>
      
      <input type="hidden" name="cbs-calendar-column-count" value="7">
    </div>
  </div>
</div>