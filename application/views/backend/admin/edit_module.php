<!-- Main content -->
<div class="card" style="margin: 10px 55px 50px 50px">
    <!-- form start -->
    <form method="post" action="<?php if ($page_title == "Create View") { base_url('index.php?Module_Controller/create'); } else { base_url('index.php?Module_Controller/edit/'.$moduleId); } ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <?php echo $modules_data; ?>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<!-- /.content -->
