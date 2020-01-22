<?php include_once $root.'/head.php';?>
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo $base_url;?>plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="<?php echo $base_url;?>plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="<?php echo $base_url;?>plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="<?php echo $base_url;?>plugins/fullcalendar-bootstrap/main.min.css">
<script src="<?php echo $base_url;?>plugins/moment/moment.min.js"></script>
<script src="<?php echo $base_url;?>plugins/fullcalendar/main.min.js"></script>
<script src="<?php echo $base_url;?>plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="<?php echo $base_url;?>plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="<?php echo $base_url;?>plugins/fullcalendar-interaction/main.min.js"></script>
<script src="<?php echo $base_url;?>plugins/fullcalendar-bootstrap/main.min.js"></script>
<div class="card card-primary">
  <div class="card-body p-0">
    <!-- THE CALENDAR -->
  	<div id="calendar"></div>
  </div>
  <!-- /.card-body -->
</div>

<script type="text/javascript">
var date = new Date()
var d    = date.getDate(),
    m    = date.getMonth(),
    y    = date.getFullYear()
var Calendar = FullCalendar.Calendar;
var calendarEl = document.getElementById('calendar');
var calendar = new Calendar(calendarEl, {
    plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
    locale : 'ko',
    buttonText : {
    	  today:    '오늘',
    	  month:    '1달',
    	  week:     '1주',
    	  day:      '1일',
    	  list:     '리스트'
    	},
    header    : {
      left  : 'prev,next today',
      center: 'title',
      right : 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    //Random default events
    events    : [
      {
        title          : 'All Day Event',
        start          : new Date(y, m, 1),
        backgroundColor: '#f56954', //red
        borderColor    : '#f56954' //red
      },
      {
        title          : 'Long Event',
        start          : new Date(y, m, d - 5),
        end            : new Date(y, m, d - 2),
        backgroundColor: '#f39c12', //yellow
        borderColor    : '#f39c12' //yellow
      },
      {
        title          : 'Meeting',
        start          : new Date(y, m, d, 10, 30),
        allDay         : false,
        backgroundColor: '#0073b7', //Blue
        borderColor    : '#0073b7' //Blue
      },
      {
        title          : 'Lunch',
        start          : new Date(y, m, d, 12, 0),
        end            : new Date(y, m, d, 14, 0),
        allDay         : false,
        backgroundColor: '#00c0ef', //Info (aqua)
        borderColor    : '#00c0ef' //Info (aqua)
      },
      {
        title          : 'Birthday Party',
        start          : new Date(y, m, d + 1, 19, 0),
        end            : new Date(y, m, d + 1, 22, 30),
        allDay         : false,
        backgroundColor: '#00a65a', //Success (green)
        borderColor    : '#00a65a' //Success (green)
      },
      {
        title          : 'Click for Google',
        start          : new Date(y, m, 28),
        end            : new Date(y, m, 29),
        url            : 'http://google.com/',
        backgroundColor: '#3c8dbc', //Primary (light-blue)
        borderColor    : '#3c8dbc' //Primary (light-blue)
      }
    ],
    editable  : true,
    droppable : true, // this allows things to be dropped onto the calendar !!!
    drop      : function(info) {
      // is the "remove after drop" checkbox checked?
      if (checkbox.checked) {
        // if so, remove the element from the "Draggable Events" list
        info.draggedEl.parentNode.removeChild(info.draggedEl);
      }
    }    
  });

  calendar.render();
</script>
<?php include_once $root.'/footer.php';?>