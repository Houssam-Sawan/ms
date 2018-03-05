

<div class="box">

    <div class="box-header">

        <h3 class="box-title"><i class="fa icon-invoice"></i> <?=$this->lang->line('panel_title')?></h3>





        <ol class="breadcrumb">

            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>

            <li><a href="<?=base_url("invoice/index")?>"><?=$this->lang->line('menu_invoice')?></a></li>

            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_invoice')?></li>

        </ol>

    </div><!-- /.box-header -->

    <!-- form start -->

    <div class="box-body">

        <div class="row">

            <div class="col-sm-10">

                <form class="form-horizontal" role="form" method="post">



                    <?php

                        if(form_error('classesID'))

                            echo "<div class='form-group has-error' >";

                        else

                            echo "<div class='form-group' >";

                    ?>

                        <label for="classesID" class="col-sm-2 control-label">

                            <?=$this->lang->line("invoice_classesID")?>

                        </label>

                        <div class="col-sm-6">



                            <?php

                                $array = array('0' => $this->lang->line("invoice_select_classes"));

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



                    <?php

                        if(form_error('studentID'))

                            echo "<div class='form-group has-error' >";

                        else

                            echo "<div class='form-group' >";

                    ?>

                        <label for="studentID" class="col-sm-2 control-label">

                            <?=$this->lang->line("invoice_studentID")?>

                        </label>

                        <div class="col-sm-6">



                            <?php



                                $array = $array = array('0' => $this->lang->line("invoice_select_student"));

                                if($students != "empty") {

                                    foreach ($students as $student) {

                                        $array[$student->studentID] = $student->name;

                                    }

                                }



                                $stID = 0;

                                if($studentID == 0) {

                                    $stID = 0;

                                } else {

                                    $stID = $studentID;

                                }



                                echo form_dropdown("studentID", $array, set_value("studentID", $stID), "id='studentID' class='form-control select2'");

                            ?>

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('studentID'); ?>

                        </span>

                    </div>



                    <?php

                        if(form_error('feetype'))

                            echo "<div class='form-group has-error' >";

                        else

                            echo "<div class='form-group' >";

                    ?>

                        <label for="feetype" class="col-sm-2 control-label">

                            <?=$this->lang->line("invoice_feetype")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="hidden" id="feetype" name="feetype" value="" >

                           <?php

                                $array = array('0' => "Select Fee Type");
                                //store fee type info in array
                                $feetypes_info = array('0' => array("0", "Select Fee Type", "0", "0"));

                                foreach ($feetypes as $fee) {

                                    $array[$fee->feetypesID] = $fee->feetypes .'  ||  '. $fee->feeamount;
                                    $feetypes_info[$fee->feetypesID] = array($fee->feetypesID, $fee->feetypes, $fee->feeamount, $fee->note);

                                }

                                echo form_dropdown("feetypesID", $array, set_value("feetypesID"), "id='feetypesID' class='form-control'");

                            ?>



                        </div>

                       

                        <div class="col-sm-2">

                            <input onclick="add_fee()" type="button" id="add-fee" class="btn btn-success" value="Add Fee" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('feetype'); ?>

                        </span>

                    </div>

                    <div id="fee-table-wraper">
                        
                    </div>

                    <?php

                        if(form_error('amount'))

                            echo "<div class='form-group has-error' >";

                        else

                            echo "<div class='form-group' >";

                    ?>

                        <label for="amount" class="col-sm-2 control-label">

                            <?=$this->lang->line("invoice_amount")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="amount" name="amount" value="<?=set_value('amount')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('amount'); ?>

                        </span>

                    </div>



                    <?php

                        if(form_error('discount'))

                            echo "<div class='form-group has-error' >";

                        else

                            echo "<div class='form-group' >";

                    ?>

                        <label for="discount" class="col-sm-2 control-label">

                            <?=$this->lang->line("invoice_discount")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="discount" name="discount" value="<?=set_value('discount')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('discount'); ?>

                        </span>

                    </div>



                    <?php

                        if(form_error('date'))

                            echo "<div class='form-group has-error' >";

                        else

                            echo "<div class='form-group' >";

                    ?>

                        <label for="date" class="col-sm-2 control-label">

                            <?=$this->lang->line("invoice_date")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="date" name="date" value="<?=set_value('date')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('date'); ?>

                        </span>

                    </div>
                    <div class="form-group hidden">
                    <div id="selected_fees" class="">
                    <input type="number" id="f1" name="f1" value="1" >
                    <input type="number" id="f2" name="f2" value="2" >
                    </div>
                    </div>



                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-8">

                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_invoice")?>" >

                        </div>

                    </div>



                </form>

                <?php if ($siteinfos->note==1) { ?>

                    <div class="callout callout-danger">

                        <p><b>Note:</b> If you need any fee type then you can add before you create invoice and also you can write new fee type here into fee type input it will be saved.</p>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

</div>



<script type="text/javascript">

$('.select2').select2();

$('#classesID').change(function(event) {

    var classesID = $(this).val();

    if(classesID === '0') {

        $('#studentID').val(0);

    } else {

        $.ajax({

            type: 'POST',

            url: "<?=base_url('invoice/call_all_student')?>",

            data: "id=" + classesID,

            dataType: "html",

            success: function(data) {

               $('#studentID').html(data);

            }

        });

    }

});




/*

    $( function() {

        var availableTags = [

            <?php if(count($feetypes)) {

                foreach ($feetypes as $key => $feetype) {

                    echo '"'.$feetype->feetypes.'",';

                }

            } ?>

        ];

        $( "#feetype" ).autocomplete({

        source: availableTags

        });

    } );

*/

var types_amounts=[];
var table_arr = [];
var amounts = [];
var selected_fees = [];

$( function(){
    
        <?php
            foreach ($feetypes_info as $key => $idx) {
                
               echo 'types_amounts['.$key.']=['.$idx[0].',"'.$idx[1].'",'.$idx[2].'];';
            }
        ?>

} );


function add_fee(){

    var selected_fee = document.getElementById("feetypesID").selectedIndex;
    table_arr[selected_fee] = [types_amounts[selected_fee][1] , types_amounts[selected_fee][2]];
    refresh_fee_table();
    update_amount();

}

function remove_fee(index){
    table_arr[index] = null;
    refresh_fee_table();
    update_amount();
}

function update_amount(){
    
    if(table_arr != null){ 
        for(var i = 1; i <  table_arr.length; i++){
            if(table_arr[i] != null && table_arr[i][1] != undefined ){

                amounts[i] = table_arr[i][1];

            }else{
                amounts[i] = 0;
            }
        }
    }
    var total_amount = 0;
    $.each(amounts, function(idx, value){
        if(value != undefined){
            total_amount += value;
        }
        
    });

    $('#amount').val(total_amount);
}

function refresh_fee_table(){
    
    var t_content = ""; 
    var selected_types = "";    

    if(table_arr != null){    
        t_content = "<div class='form-group'>"+
            "<div class='col-sm-offset-2 col-sm-6'>"+
                "<table id='#example1' class='table table-striped table-bordered table-hover dataTable no-footer'>"+
                    "<tbody><tr><th>Fee Type</th><th>Amount</th><th></th></tr>";
                // '<tr><td>Fee Type</td><td>Amount</td><th style="width: 50px;padding:1px;"><input onclick="remove_fee()" type="button" id="remove-fee" class="btn btn-success btn-sm" value="Remove" ></th>'
        var count = 0;

        for(var i = 1; i <  table_arr.length; i++){
            if(table_arr[i] != null){
                count++;

                t_content += '<tr><td>' + table_arr[i][0] + '</td>'
                            + '<td>' + table_arr[i][1] + '</td>'
                            + '<td style="width: 50px;padding:1px;">'
                            + '<input onclick="remove_fee(' + i + ')"'
                            + 'type="button" id="remove-fee" class="btn btn-success btn-sm" value="Remove" ></td>'
                            + '</tr>';

                selected_types += table_arr[i][0]  + ',';
            }
        }                
        t_content +=  "</tbody>"+
                "</table></div></div>";
        if(count == 0)
        {
            t_content = "";
            selected_types = "";
        }else{
            selected_types = selected_types.replace(/,\s*$/, "");
        }
    }
    
    $('#fee-table-wraper').html(t_content);

    $('#feetype').val(selected_types);

    update_selected_fees();
    
}


function update_selected_fees() {
    var counts = 0;
    if(table_arr != null){ 
        for(var i = 1; i <  table_arr.length; i++){
            if(table_arr[i] != null && table_arr[i][0] != undefined ){

                selected_fees[i] = table_arr[i][0];
                
                counts++;

            }else{
                selected_fees[i] = null;
            }
        }
    }
    
    
if(counts == 0) {

   selected_fees = [];

} else {

    var fee_info = {};
        if(selected_fees != null){
            for(var i = 1; i< selected_fees.length ; i++){
                if(selected_fees[i] != null){
                    //alert(selected_fees[i]);
                    var idx = i +'';
                    fee_info[idx] = selected_fees[i];
                   // alert(fee_info[idx]);
                }
            }
        }

}


}


$('#date').datepicker();

</script>

<p id="demo2">

</p>
