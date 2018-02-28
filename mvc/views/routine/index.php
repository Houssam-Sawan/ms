<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-routine"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_routine')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <p id="demo">dcsdcs</p>
    <div class="box-body">
        <div class="row">

<div class="col-sm-12">
<!--
<p id="t_start" >this is start</p>
<p id="t_end" >this is end</p>
-->
<?php 
/*
echo count($routines);
if(count($routines) > 0) 
{
    $countss = 0;
foreach ($times as $key => $routine) {
    echo '<p>'.$routine->start_time. '</p>';
    echo $countss++;
    if($countss > 50){break;}
}
}
*/
?>
</div>
            <div class="col-sm-12">


                <?php 
                    $usertypeID = $this->session->userdata("usertypeID");
if ($usertypeID == 3) {
                ?>

                    <?php if (permissionChecker('routine_add')) {?>
                        <h5 class="page-header" style="margin-bottom: 0px !important;" >
                            <a href="<?php echo base_url('routine/add') ?>">
                                <i class="fa fa-plus"></i> 
                                <?=$this->lang->line('add_title')?>
                            </a>
                        </h5>
                    <?php }?>

                    <?php if (count($routines) > 0) {?>
                        <div id="hide-table-2">
                            <table id="table" class="table table-bordered">
                                <tbody>
                                    <?php
                                        $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                        $flag = 0;
        $map = function ($r) {return $r->day;};
                                        $count = array_count_values(array_map($map, $routines));
                                        $max = max($count);
                                        foreach ($us_days as $key => $us_day) {
                                            $row_count = 0;
                                            foreach ($routines as $routine) {
                if ($routine->day == $key) {
                    if ($flag == 0) {
                                                        echo '<tr>';
                        echo '<td>' . $us_day . '</td>';
                                                        $flag = 1;
                                                    } 
                    echo '<td id=' . $routine->start_time . '>';
                                                    echo 'test';
                                                    echo '<div class="btn-group">';
                                                    echo "<span type=\"button\" class=\"btn btn-success\">"; 
                    echo $routine->start_time . '-' . $routine->end_time . '<br/>';
                    echo $routine->subject . ' | ';
                    echo $routine->name . '<br/>';
                    if (permissionChecker('routine_edit')) {
                        echo btn_edit('routine/edit/' . $routine->routineID . '/' . $routine->classesID, $this->lang->line('edit'));
                                                        }
                    if (permissionChecker('routine_delete')) {
                        echo btn_delete('routine/delete/' . $routine->routineID . '/' . $routine->classesID, $this->lang->line('delete'));
                                                        }

                                                    echo '</span>';
                                                    echo '</div>';
                                                    echo '</td>'; 
                                                    $row_count++;
                                                } 
                                            }

            if ($flag == 1) {
                while ($row_count < $max) {
                                                  // echo "<td></td>";
                                                  $row_count++;
                                                }
                                                echo '</tr>';
                                                $flag = 0;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else {?>
                        <div id="hide-table-2">
                            <table id="table" class="table table-striped ">
                                <tbody>

          
                                    <?php
                                        $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                        $flag = 0;
                                        foreach ($us_days as $key => $us_day) {
                                            echo '<tr>';
            echo '<td>' . $us_day . '</td>';
                                            echo '</tr>';
                                        }  
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    <?php }?>




                <?php } else {?>
                    <h5 class="page-header" style="margin-bottom: 0px !important;" >
                        <?php if (permissionChecker('routine_add')) {?>
                            <a href="<?php echo base_url('routine/add') ?>">
                                <i class="fa fa-plus"></i> 
                                <?=$this->lang->line('add_title')?>
                            </a>
                        <?php }?>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pull-right drop-marg">
                            <?php
                                $array = array("0" => $this->lang->line("routine_select_classes"));
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control select2'");
                            ?>
                        </div>
                    </h5>
<!-- Form start -->
<div class="box-body" style="padding: 3px 15px;">
    <div class="row">
        <div class="col-sm-10">
            <form class="form-vertical" role="form" method="post">
                <label for="start_time" class="col-sm-1 control-label">

                <?=$this->lang->line("routine_start_time")?>

                </label>

                <div class="col-sm-3">

                <input onchange="filter_time()" type="text" class="form-control" id="start_time" name="start_time" value="<?=set_value('end_time')?>" >

                </div>

                <label for="end_time" class="col-sm-1 control-label">

                <?=$this->lang->line("routine_end_time")?>

                </label>

                <div class="col-sm-3">

                <input onchange="filter_time()" type="text" class="form-control" id="end_time" name="end_time" value="<?=set_value('end_time')?>" >

                </div>

                    <div class="col-sm-2">

                    <input onclick="clear_filters()"  type="button" class="btn btn-success" id="clear_filter" name="clear_filter" value="Clear" >

                    </div>

            </form>
        </div>
    </div>
</div>
                    <?php if (count($routines) > 0) {?>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("routine_all_routine")?></a></li>
                                <?php foreach ($sections as $key => $section) {
        echo '<li class=""><a data-toggle="tab" href="#' . $section->sectionID . '" aria-expanded="false">' . $this->lang->line("routine_section") . " " . $section->section . " ( " . $section->category . " )" . '</a></li>';
    }?>
                            </ul>


                            <div class="tab-content" id="scrolling">
                                <div id="all" class="tab-pane active">
                                    <div id="hide-table-2">
                                        <table id="table" class="table table-bordered ">
                                            <tbody>
<?php
    $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
    $flag = 0;
        $map = function ($r) {return $r->day;};
    $count = array_count_values(array_map($map, $routines));
    $max = max($count);
    foreach ($us_days as $key => $us_day) {
        $row_count = 0;
        foreach ($routines as $routine) {
                if ($routine->day == $key) {
                    if ($flag == 0) {
                    echo '<tr>';
                        echo '<td>' . $us_day . '</td>';
                    $flag = 1;
                } 
                /*
                $this->load->helper('url');
                $start_id =  url_title($routine->start_time, 'dash', TRUE);
                $start_id =strtotime($routine->start_time);
                echo '<td id=st' . $start_id .'>';
                echo $routine->start_time;
                echo strtotime($routine->start_time);//, hh:MM meridian);
                */
                $str_time = $routine->start_time;
                    $end_time = $routine->end_time;
                $start_sec = $this->routine_m->timetosecond($str_time);
                    $end_sec = $this->routine_m->timetosecond($end_time);

                    $fullID = 'st' . $start_sec . 'end' . $end_sec;
                    echo '<td id=' . $fullID . '>';
                    //echo $str_time . ' ' . $fullID;

                echo '<div class="btn-group">';
                echo "<span type=\"button\" class=\"btn btn-success\">"; 
                    echo $routine->start_time . ' - ' . $routine->end_time . ' | ';
                    echo $routine->section . '<br/>';
                    echo $routine->subject . ' | ';
                    echo $routine->name . '<br/>';
                    echo btn_edit('routine/edit/' . $routine->routineID . '/' . $set, $this->lang->line('edit'));
                    echo ' ';
                    echo btn_delete('routine/delete/' . $routine->routineID . '/' . $set, $this->lang->line('delete'));
                echo '</span>';
                echo '</div>';
                echo '</td>'; 
                $row_count++;
            } 
        }

            if ($flag == 1) {
                while ($row_count < $max) {
                // echo "<td></td>";
                $row_count++;
            }
            echo '</tr>';
            $flag = 0;
        }
    }
?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <?php foreach ($sections as $key => $section) {?>
                                    <div id="<?=$section->sectionID?>" class="tab-pane">
                                        <div id="hide-table-2">
                                            <table id="table" class="table table-bordered ">
                                                <tbody>
<?php
if (count($allsection[$section->section])) {

        $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
        $flag = 0;
            $map = function ($r) {return $r->day;};
        $count = array_count_values(array_map($map, $routines));
        $max = max($count);
        foreach ($us_days as $key => $us_day) {
            $row_count = 0;
                foreach ($allsection[$section->section] as $routine) {
                    if ($routine->day == $key) {
                        if ($flag == 0) {
                        echo '<tr>';
                            echo '<td>' . $us_day . '</td>';
                        $flag = 1;
                    } 
                    echo '<td style="font-size:8px">';
                    echo '<div class="btn-group">';
                    echo "<span type=\"button\" class=\"btn btn-success\">"; 
                        echo $routine->start_time . '-' . $routine->end_time . '<br/>';
                        echo $routine->subject . ' | ';
                        echo $routine->name . '<br/>';
                        if (permissionChecker('routine_edit')) {
                            echo btn_edit('routine/edit/' . $routine->routineID . '/' . $set, $this->lang->line('edit'));
                        }
                        if (permissionChecker('routine_delete')) {
                            echo btn_delete('routine/delete/' . $routine->routineID . '/' . $set, $this->lang->line('delete'));
                        }
                    echo '</span>';
                    echo '</div>';
                    echo '</td>'; 
                    $row_count++;
                } 
            }
 
                if ($flag == 1) {
                    while ($row_count < $max) {
                    // echo "<td></td>";
                    $row_count++;
                }
                echo '</tr>';
                $flag = 0;
            }
        }
    }
?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    <?php } else {?>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("routine_all_routine")?></a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="all" class="tab-pane active">
                                    <div id="hide-table-2">
                                        <table id="table" class="table table-striped ">
                                            <tbody>
                                                <?php
                                                    $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                                    $flag = 0;
                                                    foreach ($us_days as $key => $us_day) {
                                                        echo '<tr>';
            echo '<td>' . $us_day . '</td>';
                                                        echo '</tr>';
                                                    }  
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php }?>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#table').hide();
            $('.nav-tabs-custom').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('routine/routine_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });

    $('.select2').select2();
    var mainWidth = $('html').width();
    if(mainWidth >= 980) {
        $('.tab-pane').mCustomScrollbar({
            axis:"x" // horizontal scrollbar
        });
    } 
</script>
<!-- Filter time script -->
<script type="text/javascript">

function timeToSeconds(str) {
    var res = str.split(/[ :]/g);
    var hour = parseInt(res[0]);
    var min = parseInt(res[1]);
    var med = res[2];
     hour = (med == "AM")? hour : (hour + 12);

   return hour * 3600 + min * 60;
}
/*
function filter_time_start() {

    var start = $('#start_time').val();
    var id = 'st' + timeToSeconds(start);
    $('#t_start').html(start + ' ' + id);

}

function filter_time_end() {
    var end = $('#end_time').val();
    var id = 'st' + timeToSeconds(end);
    $('#t_end').html(end + ' ' + id);
}
*/
function filter_time() {
    var start = $('#start_time').val();
    var end = $('#end_time').val();
    var id1 = 'st' + timeToSeconds(start);
    var id2 = 'end' + timeToSeconds(end);
    var id =  id1 + id2;
    $("#demo").html(id);

    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");
        if(filter != "ALL"){
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[culNum];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                   // if (td.innerHTML.indexOf(filter) > -1) {
                       tr[i].style.display = "filtered";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }else{
            for (i = 0; i < tr.length; i++) {
                        tr[i].style.display = "";
            }
        }
    /*var table = document.getElementById("table");// $("#table");
    for(var row in table.rows)
    {
        for(var cell in row.cells)
        {
            if (cell.id == id)
            {
                $("td").css({'display':'table-cell'});
            }else{
                $("td").css({'display':'none'});
            }
        }
    }
    */
    //$('#t_start').html(id1);
    //$('#t_end').html(id2);
    //$(id).style("display:none;"); 
}
function clear_filters()
{
   /* $("td").css('display':'inline-block');*/
  $("td").css({'display':'table-cell'});
}

$('#start_time').timepicker();

$('#end_time').timepicker();

</script>
