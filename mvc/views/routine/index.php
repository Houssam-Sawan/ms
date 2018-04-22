<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-routine"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_routine')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->

    <div class="box-body">
        <div class="row">
<!--
<div class="col-sm-12">
  <p id="demo">this is demo</p>
</div>
-->
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
                    $str_time = $routine->start_time;
                    $end_time = $routine->end_time;
                    $start_sec = $this->routine_m->timetosecond($str_time);
                    $end_sec = $this->routine_m->timetosecond($end_time);

                    $fullID = 'st' . $start_sec . 'end' . $end_sec;
                    echo '<td id=' . $fullID . '>';
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

                    $str_time = $routine->start_time;
                    $end_time = $routine->end_time;
                    $start_sec = $this->routine_m->timetosecond($str_time);
                    $end_sec = $this->routine_m->timetosecond($end_time);

                    $fullID = 'st' . $start_sec . 'end' . $end_sec;
                    echo '<td id=' . $fullID . '>';

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
                        $str_time = $routine->start_time;
                        $end_time = $routine->end_time;
                        $start_sec = $this->routine_m->timetosecond($str_time);
                        $end_sec = $this->routine_m->timetosecond($end_time);

                        $fullID = 'st' . $start_sec . 'end' . $end_sec;
                        echo '<td id=' . $fullID . '>';
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
        hour = (med == "AM" || hour == 12)? hour : (hour + 12);

    return hour * 3600 + min * 60;
    }

    function filter_time() {
        var start = $('#start_time').val();
        var end = $('#end_time').val();
        var st_sec = timeToSeconds(start);
        var end_sec = timeToSeconds(end);
        var id =  "start: " + st_sec + " End: " + end_sec;
        var F = idstrtosec("");
        //$("#demo").html(id+typeof st_sec );//+ typeof start +"to dyt"+typeof F +" F0 "+ typeof F[0] );

        //table = document.getElementById("table");
        //tables = document.getElementsByTagName("table");
        tables = document.getElementsByClassName("table");
       // $("#demo").html("1:" + tables.length );
        for(var k = 0; k < tables.length; k++)
        {
          table = tables[k];
            tr = table.getElementsByTagName("tr");
                    // Loop through all table rows, and hide those who don't match the search query
                    for (var i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td");
                        for (var j = 1; j < td.length; j++) {
                            var currID = td[j];
                            //if (currTd.id == id) {
                            var timesF = idstrtosec(currID.id)
                            //if(j == 1){ alert(timesF[0]);  }
                        // if(j == 1){ alert(st_sec); break; }
                            if(timesF[0] >= st_sec && timesF[1] <= end_sec){
                                currID.style.display = "table-cell";
                            } else {
                                currID.style.display = "none";
                            }
                        }
                    }
        }

    }

    function idstrtosec(idStr)
    {
        var startStr =  parseInt(idStr.substring(2, idStr.indexOf("end")));
        var endStr = parseInt(idStr.substring(idStr.indexOf("end")+3));
    // $("#demo").html("start: "+ startStr + " End: "+endStr);
        //st28800end39600
        return [startStr, endStr];
    }

    function clear_filters()
    {
        /* $("td").css('display':'inline-block');*/
        $("td").css({'display':'table-cell'});
    }

    $('#start_time').timepicker({'defaultTime': '8:00 AM'});

   // $('#start_time').val("8:00 AM");

    $('#end_time').timepicker({'defaultTime': '2:30 PM'});

  //  $('#end_time').val("2:30 PM");

    /*
 tables1 = document.getElementsByTagName("table");
 $("#demo").html("1:" + tables1.length );
 */
</script>
