<div class="row">
	<div class="col-md-12">
		<div class="row">
            <div class="col-md-4">
                <div class="tile-stats tile-cyan">
                    <div class="icon"><i class="entypo-credit-card"></i></div>
                    <div class="num" data-start="0" data-end=""data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Fees Collected</h3> 
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-calendar"></i></div>
                    <div class="num" data-start="0" data-end="0"data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Todays Attendance</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-black">
                    <div class="icon"><i class="entypo-flow-tree"></i></div>
                    <div class="num" data-start="0" data-end="0"data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Available Classes</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-brown">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="0"data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Unpaid Fees</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-pink">
                    <div class="icon"><i class="entypo-comment"></i></div>
                    <div class="num" data-start="0" data-end="0"data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Inbox</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-alert"></i></div>
                    <div class="num" data-start="0" data-end="0"data-postfix="" data-duration="500" data-delay="0">0</div>
                    <h3>Notice</h3>
                </div>
            </div>
    	</div>
    </div>
    <?php if (empty($modules_Data['error'])){?>
    <div class="tab-content">
        <!----TABLE LISTING STARTS-->
        <div class="tab-pane box active" id="list">
            <table class="table table-bordered datatable table-hover table-striped" id="table_export">
                <thead>
                    <tr>
                        <th><div>#</div></th>
                    <?php foreach ($modules_key as $colName) { if ($colName == 'id'){ continue; } ?>
                        <th><div><?= ucfirst(str_replace("_", " ", $colName)); ?></div></th>
                    <?php } ?>
                        <th><div>ACTION</div></th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1; foreach ($modules_data as $key => $row) { ?>
                    <tr>
                        <td><?= $count++; ?></td>
                        <?php foreach ($row as $key => $val){ if ($key == 'id'){ continue; } ?>
                            <td><?= $val; ?></td>
                        <?php }; ?>
                        <td class="text-center">
                            <a href="<?= base_url('index.php?Module_Controller/view/'.$row['id']) ?>"><i class='entypo-eye'></i></a>
                            <a href="<?= base_url('index.php?Module_Controller/edit/'.$row['id']) ?>"><i class='entypo-pencil'></i></a>
                            <a href="<?= base_url('index.php?Module_Controller/delete/'.$row['id']) ?>" onclick="return confirm('Are You sure ,want to delete this record?');"><i class="entypo-trash"></i></a>
                        </td>
                    </tr>
                <?php }; ?>
                </tbody>
            </table>
        </div>
            <!----TABLE LISTING ENDS--->
    </div>
<?php }else{
    ?> 
    <div class="row">
            <div class="col-md-12">
                <div class="tile-stats tile-white">
                    <h3>
           <?php  print_r($modules_Data->error);  ?> 
        </h3> 
                </div>
            </div>          
    <?php } ?>
</div>