<div class="row">
	<div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
		<h2 style="font-weight:200; margin:0px;"><?php echo $system_name;?></h2>
    </div>
	<!-- Raw Links -->
	<div class="col-md-12 col-sm-12 clearfix ">
		
        <ul class="list-inline links-list pull-left">
        <!-- Language Selector -->			
           <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        	<i class="entypo-user"></i>Customer
                    </a>
				<ul class="dropdown-menu pull-left">
					<li>
						<a href="">
                        	<i class="entypo-info"></i>
							<span>Edit Profile</span>
						</a>
					</li>
					<li>
						<a href="">
                        	<i class="entypo-key"></i>
							<span>Change Password</span>
						</a>
					</li>
				</ul>
			</li>
        </ul>
		<ul class="list-inline links-list pull-right">
			<li>
				<a href="<?php echo base_url();?>index.php?login/logout">
					Logout <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
	</div>
	
</div>

<hr style="margin-top:0px;" />