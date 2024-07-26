<div class="row">
	<div class="col-md-12">
		<div class="row">
            <div class="col-md-4">
                <div class="tile-stats tile-cyan">
                    <div class="icon"><i class="entypo-credit-card"></i></div>
                    <div class="num" data-start="0" data-end="invoice" data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Fees Collected</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="entypo-graduation-cap"></i></div>
                    <div class="num" data-start="0" data-end=" data-postfix=" data-duration="1500" data-delay="0">0</div>
                    <h3>Student</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end=" data-postfix=" data-duration="800" data-delay="0">0</div>
                    <h3>Teacher</h3>
                </div>
            </div>
            <div class="col-md-4">
            
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-calendar"></i></div>
                    <div class="num" data-start="0" data-end="" data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Todays Attendance</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-purple">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="" data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Parent</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-black">
                    <div class="icon"><i class="entypo-flow-tree"></i></div>
                    <div class="num" data-start="0" data-end="" data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Available Classes</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-brown">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end=""	data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Unpaid Fees</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-pink">
                    <div class="icon"><i class="entypo-comment"></i></div>
                    <div class="num" data-start="0" data-end="admin-1" && read_status="0" data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Inbox</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-alert"></i></div>
                    <div class="num" data-start="0" data-end="" data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Notice</h3>
                </div>
            </div>
    	</div>
    </div>
    <div class="col-md-12">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
  $(document).ready(function() {
	  
	  var calendar = $('#notice_calendar');
				
				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,
					
					events: [
													
					]
				});
	});
  </script>

  
