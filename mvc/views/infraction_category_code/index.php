
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-leaf"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_infraction_category_code')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <?php if(permissionChecker('infraction_category_code_add')) { ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('infraction_category_code/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class=""><?=$this->lang->line('slno')?></th>
                                <th class=""><?=$this->lang->line('infraction_category')?></th>
                                <th class=""><?=$this->lang->line('infraction_category_code')?></th>
                                <?php if(permissionChecker('infraction_category_code_edit') || permissionChecker('infraction_category_code_delete')) { ?>
                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($infraction_category_codes)) {$i = 1; foreach($infraction_category_codes as $infraction_category_code) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('infraction_category')?>">
                                        <?php echo $infraction_category_code->infraction_category; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('infraction_category_code')?>">
                                        <?php echo $infraction_category_code->infraction_category_code; ?>
                                    </td>

                                    <?php if(permissionChecker('infraction_category_code_edit') || permissionChecker('infraction_category_code_delete')) { ?>
                                        <td data-title="<?=$this->lang->line('action')?>">
                                            <?php echo btn_edit('infraction_category_code/edit/'.$infraction_category_code->infraction_category_codeID, $this->lang->line('edit')) ?>
                                            <?php echo btn_delete('infraction_category_code/delete/'.$infraction_category_code->infraction_category_codeID, $this->lang->line('delete')) ?>
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

