<!-- Main content -->
<div class="card" style="margin: 10px 55px 50px 50px">
    <div class="card-header">
        <div class='col-1' style="float:right; ">
            <a type='button' class="btn btn-block btn-secondary" href='<?= base_url('index.php?Module_Controller/edit/'.$moduleId)?>'><i class="entypo-pencil">Edit</i></a>
        </div>
        <div class='col-1' style="float:right;">
            <a type='button' class="btn btn-block btn-secondary" style=" margin-right: 20px;" href="<?= base_url('index.php?Module_Controller/delete/'.$moduleId) ?>" onclick="return confirm('Are You sure ,want to delete this record?');"><i class="entypo-trash">Delete</i></a>
        </div>
    </div>
    <!-- form start -->
    <div class="card-body">
        <div class="row">
            <div class="col-6"> 
                <div class="table-responsive">
                    <table class="table" style="border:none;">
                    <?php echo $modules_data; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.content -->
