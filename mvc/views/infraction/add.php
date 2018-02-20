
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-infraction"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("infraction/index")?>"></i> <?=$this->lang->line('menu_infraction')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_infraction')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-10">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post">

                    <div class='form-group <?= form_error('infraction_categoryID') ? "has-error" : ""?>' >
                        <label for="infraction_categoryID" class="col-sm-2 control-label">
                            <?=$this->lang->line("infraction_category")?>
                        </label>
                        <div class="col-sm-6">

                            <?php
                                $array = array();
                                $array[0] = $this->lang->line("infraction_select_category");

                                foreach ($infraction_categories as $category) {
                                    $array[$category->infraction_categoryID] = $category->infraction_category;
                                }
                                echo form_dropdown("infraction_categoryID", $array, set_value("infraction_categoryID"), "id='infraction_categoryID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('infraction_categoryID'); ?>
                        </span>
                    </div>

                    <div class='form-group <?= form_error('infraction_category_codeID') ? "has-error" : ""?>' >
                        <label for="infraction_category_codeID" class="col-sm-2 control-label">
                            <?=$this->lang->line("infraction_category_code")?>
                        </label>
                        <div class="col-sm-6">

                            <?php
                                $array = array();
                                $array[0] = $this->lang->line("infraction_select_category_code");
                                echo form_dropdown("infraction_category_codeID", $array, set_value("infraction_category_codeID"), "id='infraction_category_codeID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('infraction_category_codeID'); ?>
                        </span>
                    </div>

                    <div class='form-group <?= form_error('infraction_created_at') ? "has-error" : ""?>' >
                        <label for="infraction_created_at" class="col-sm-2 control-label">
                            <?=$this->lang->line("infraction_created_at")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="infraction_created_at" name="infraction_created_at" value="<?=set_value('infraction_created_at')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('infraction_created_at'); ?>
                        </span>
                    </div>

                    <div class='form-group <?= form_error('classesID') ? "has-error" : ""?>' >
                        <label for="classesID" class="col-sm-2 control-label">
                            <?=$this->lang->line("infraction_classes")?>
                        </label>
                        <div class="col-sm-6">
                            
                            <?php
                                $array = array();
                                $array[0] = $this->lang->line("infraction_select_classes");

                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID", $array, set_value("classesID"), "id='classesID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('classesID'); ?>
                        </span>
                    </div>

                    <div class='form-group <?= form_error('studentID') ? "has-error" : ""?>' >
                        <label for="studentID" class="col-sm-2 control-label">
                            <?=$this->lang->line("infraction_student")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array();
                                if($students != "empty") {
                                    foreach ($students as $student) {
                                        $array[$student->studentID] = $student->name;
                                    }
                                }

                                echo form_dropdown("studentID", $array, set_value("studentID"), "id='studentID' class='form-control select2'");
                            ?>
                        </div>

                        <span class="col-sm-4 control-label">
                            <?php echo form_error('studentID'); ?>
                        </span>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_infraction")?>" >
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(".select2" ).select2();
$('#infraction_created_at').datepicker();

$('#classesID').change(function(event) {
    var classesID = $(this).val();
    if(classesID === '0') {
        $('#studentID').val('');
    } else {
        $('#studentID').val('');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('infraction/studentCall')?>",
            data: "id=" + classesID,
            dataType: "html",
            success: function(data) {
               $('#studentID').html(data);
            }
        });
    }
});

$('#infraction_categoryID').change(function(event) {
    var infraction_categoryID = $(this).val();
    if(infraction_categoryID === '0') {
        $('#infraction_category_codeID').val('');
    } else {
        $('#infraction_category_codeID').val('');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('infraction/infraction_category_code_call')?>",
            data: "id=" + infraction_categoryID,
            dataType: "html",
            success: function(data) {
               $('#infraction_category_codeID').html(data);
            }
        });
    }
});
</script>
