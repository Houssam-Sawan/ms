
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-leaf"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("infraction_category_code/index")?>"><?=$this->lang->line('menu_infraction_category_code')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_infraction_category_code')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-10">
                <form class="form-horizontal" role="form" method="post">
                    <?php
                        if(form_error('infraction_categoryID'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="infraction_categoryID" class="col-sm-2 control-label">
                            <?=$this->lang->line("infraction_category")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array();
                                $array[0] = $this->lang->line("infraction_category_select");
                                foreach ($infraction_categories as $category) {
                                    $array[$category->infraction_categoryID] = $category->infraction_category;
                                }
                                echo form_dropdown("infraction_categoryID", $array, set_value("infraction_categoryID", $infraction_category_code->infraction_categoryID), "id='infraction_categoryID' class='form-control select2'");
                            ?>

                        </div>
                        <span class="col-sm-4 control-label">
                                <?php echo form_error('infraction_categoryID'); ?>
                        </span>
                    </div>


                    <?php
                        if(form_error('infraction_category_code'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="infraction_category_code" class="col-sm-2 control-label">
                            <?=$this->lang->line("infraction_category_code")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="infraction_category_code" name="infraction_category_code" value="<?=set_value('infraction_category_code', $infraction_category_code->infraction_category_code)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('infraction_category_code'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_infraction_category_code")?>" >
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.select2').select2();
</script>