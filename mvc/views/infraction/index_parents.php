
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-infraction"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i><?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_infraction')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
               

                <?php if(permissionChecker('infraction_add') || $this->session->userdata('usertypeID') != 3) { ?>
                <h5 class="page-header">
                    <?php if(permissionChecker('infraction_add')) { ?>
                        <a href="<?php echo base_url('infraction/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    <?php } ?>

                    <?php if($this->session->userdata('usertypeID') != 3) { ?>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pull-right drop-marg">
                        <?php
                            $array = array("0" => $this->lang->line("infraction_select_student"));
                            if(count($students)) {
                                foreach ($students as $student) {
                                    $array[$student->studentID] = $student->name;
                                }
                            }
                            echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control select2'");
                        ?>
                    </div>
                    <?php } ?>
                </h5>
                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th><?=$this->lang->line('slno')?></th>
                                <th><?=$this->lang->line('infraction_category')?></th>
                                <th><?=$this->lang->line('infraction_category_code')?></th>
                                <th><?=$this->lang->line('infraction_created_at')?></th>
                                <th><?=$this->lang->line('infraction_classes')?></th>
                                <th><?=$this->lang->line('infraction_student')?></th>
                                <?php if(permissionChecker('infraction_edit') || permissionChecker('infraction_delete') || permissionChecker('infraction_view')) { ?>
                                    <th><?=$this->lang->line('action')?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($infractions)) {$i = 1; foreach($infractions as $infraction) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('infraction_category')?>">
                                        <?php echo $infraction->infraction_category; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('infraction_category_code')?>">
                                        <?php echo $infraction->infraction_category_code; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('infraction_date')?>">
                                        <?php echo date('d M Y', strtotime($infraction->created_at)); ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('infraction_date')?>">
                                        <?php echo $infraction->classes; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('infraction_student')?>">
                                        <?php echo getNameByUsertypeIDAndUserID(3, $infraction->studentID); ?>
                                    </td>
                                    <?php if(permissionChecker('infraction_edit') || permissionChecker('infraction_delete') || permissionChecker('infraction_view')) { ?>
                                        <td data-title="<?=$this->lang->line('action')?>">
                                            <?php echo btn_view('infraction/view/'.$infraction->infractionID.'/'.$set, $this->lang->line('view')) ?>
                                            <?php echo btn_edit('infraction/edit/'.$infraction->infractionID.'/'.$set, $this->lang->line('edit')) ?>
                                            <?php echo btn_delete('infraction/delete/'.$infraction->infractionID.'/'.$set, $this->lang->line('delete')) ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".select2").select2();
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#hide-table').hide();
            $('.nav-tabs-custom').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('infraction/infraction_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>
