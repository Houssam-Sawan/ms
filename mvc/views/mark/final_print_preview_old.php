<!DOCTYPE html5>
<html lang="en">
<head>
<title><?php echo $panel_title; ?></title>

<style type="text/css">
    #page-wrap {
        width: 700px;
        margin: 0 auto;
    }

    .page-break {
      page-break-after: always;
    }

    table.print-friendly tr td, table.print-friendly tr th {
        page-break-inside: avoid;
    }

    .center-justified {
        text-align: justify;
        margin: 0 auto;
        width: 30em;
    }
    /*ini starts here*/
    .list-group {
      padding-left: 0;
      margin-bottom: 15px;
      width: auto;
    }
    .list-group-item {
      position: relative;
      display: block;
      padding: 7.5px 10px;
      margin-bottom: -1px;
      background-color: #fff;
      border: 1px solid #ddd;
      /*margin: 2px;*/
    }
    table {
      border-spacing: 0;
      border-collapse: collapse;
      font-size: 12px;
    }
    th {
        background-color: #951200;
        color: #ffffff;
    }
    td,
    th {
      padding: 2px;
    }
    @media print {
      * {
        color: #000 !important;
        text-shadow: none !important;
        background: transparent !important;
        box-shadow: none !important;
      }
      a,
      a:visited {
        text-decoration: underline;
      }
      a[href]:after {
        content: " (" attr(href) ")";
      }
      abbr[title]:after {
        content: " (" attr(title) ")";
      }
      a[href^="javascript:"]:after,
      a[href^="#"]:after {
        content: "";
      }
      pre,
      blockquote {
        border: 1px solid #999;

        page-break-inside: avoid;
      }
      thead {
        display: table-header-group;
      }
      tr,
      img {
        page-break-inside: avoid;
      }
      img {
        max-width: 100% !important;
      }
      p,
      h2,
      h3 {
        orphans: 3;
        widows: 3;
      }
      h2,
      h3 {
        page-break-after: avoid;
        color: #951200;
      }
      select {
        background: #fff !important;
      }
      .navbar {
        display: none;
      }
      .table td,
      .table th {
        background-color: #fff !important;
      }
      .btn > .caret,
      .dropup > .btn > .caret {
        border-top-color: #000 !important;
      }
      .label {
        border: 1px solid #000;
      }
      .table {
        border-collapse: collapse !important;
      }
      .table-bordered th,
      .table-bordered td {
        border: 1px solid #ddd !important;
      }
    }
    table {
      max-width: 100%;
      background-color: transparent;
      font-size: 12px;
    }
    th {
      text-align: left;
    }
    .table {
      width: 100%;
      margin-bottom: 20px;
    }
    .table h4 {
      font-size: 15px;
      padding: 0px;
      margin: 0px;
    }
    .head {
       border-top: 0px solid #e2e7eb;
       border-bottom: 0px solid #e2e7eb;
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
      padding: 8px;
      line-height: 1.428571429;
      vertical-align: top;
      /*border-top: 1px solid #e2e7eb; */
    }
    /*ini edit default value : border top 1px to 0 px*/
    .table > thead > tr > th {
      font-size: 15px;
      font-weight: 500;
      vertical-align: bottom;
      /*border-bottom: 2px solid #e2e7eb;*/
      color: #242a30;


    }

    .table > caption + thead > tr:first-child > th,
    .table > colgroup + thead > tr:first-child > th,
    .table > thead:first-child > tr:first-child > th,
    .table > caption + thead > tr:first-child > td,
    .table > colgroup + thead > tr:first-child > td,
    .table > thead:first-child > tr:first-child > td {
      border-top: 0;
    }
    .table > tbody + tbody {
      border-top: 2px solid #e2e7eb;
    }
    .table .table {
      background-color: #fff;
    }
    .table-condensed > thead > tr > th,
    .table-condensed > tbody > tr > th,
    .table-condensed > tfoot > tr > th,
    .table-condensed > thead > tr > td,
    .table-condensed > tbody > tr > td,
    .table-condensed > tfoot > tr > td {
      padding: 5px;
    }
    .table-bordered {
      border: 1px solid #e2e7eb;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
      border: 1px solid #e2e7eb;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
      border-bottom-width: 2px;
    }
    .table-striped > tbody > tr:nth-child(odd) > td,
    .table-striped > tbody > tr:nth-child(odd) > th {
      background-color: #f0f3f5;
    }
    .panel-title {
      margin-top: 0;
      margin-bottom: 0;
      font-size: 20px;
      color: #fff;
      padding: 0;
    }
    .panel-title > a {
      color: #707478;
      text-decoration: none;
    }
    .text-center {
        text-align: center;
    }
    a {
      background: transparent;
      color: #707478;
      text-decoration: none;
    }
    strong {
        color: #707478;
    }
    td > p > span
    {
        display: block;
    }
</style>
</head>
  <body>
    <div id="page-wrap">
      <table width="100%" style="margin: 50px 0 20px 0;">
        <tr>
          <td width="45%">
              <table class="table-bordered table-condensed">
                <tr width="100%">
                    <th colspan="2">
                        Work with Grading key
                    </th>
                </tr>
                <?php foreach ($grades as $grade) { ?>
                <tr>
                    <td width="50%"><?=$grade->grade;?></td>
                    <td width="50%"><?=$grade->gradefrom;?>-<?=$grade->gradeupto;?></td>
                </tr>
                <?php } ?>
              </table>
          </td>
          <td width="10%" style="vertical-align: top; text-align: right;">
              <?php
                  if($siteinfos->photo) {
                      $array = array(
                          "src" => base_url('uploads/images/'.$siteinfos->photo),
                          'width' => '50px',
                          'height' => '50px',
                          "style" => "margin-right:0px;"
                      );
                      echo img($array)."<br>";
                  }
              ?>
          </td>
          <td width="45%" style="vertical-align: top; padding-top: 5px;">
              <h2>
                  <?php
                      echo $siteinfos->sname;
                  ?>
              </h2>
              <p>
                  <span><?=$siteinfos->address;?></span><br>
                  <span><?=$siteinfos->phone;?></span><br>
                  <span><?=$siteinfos->email;?></span>
              </p>
          </td>
        </tr>
      </table>
      <table width="100%" style="margin: 0px 0 20px 0;">
        <tr>
            <td width="45%">
                <table class="table-bordered table-condensed">
                    <tr width="100%">
                        <th><?=$this->lang->line('slno')?></th>
                        <th><?=$this->lang->line('infraction_category')?></th>
                        <th><?=$this->lang->line('infraction_category_code')?></th>
                        <th><?=$this->lang->line('infraction_created_at')?></th>
                    </tr>
                    <tbody>
                    <?php if(count($infractions)) {$i = 1; foreach($infractions as $infraction) { ?>
                        <tr width="100%">
                            <td data-title="<?=$this->lang->line('slno')?>">
                                <?php echo $i; ?>
                            </td>
                            <td data-title="<?=$this->lang->line('infraction_category')?>">
                                <?php echo $infraction->infraction_category; ?>
                            </td>
                            <td data-title="<?=$this->lang->line('infraction_category_code')?>">
                                <?php echo $infraction->infraction_category_code; ?>
                            </td>
                            <td data-title="<?=$this->lang->line('infraction_created_at')?>">
                                <?php echo date('d M Y', strtotime($infraction->infraction_created_at)); ?>
                            </td>
                        </tr>
                        <?php $i++; }} ?>
                    </tbody>
                </table>
            </td>
            <td  width="11%" style="vertical-align: top; text-align: right; margin-left: 5px;">
                <?php
                    if(count($student)) {
                        $array = array(
                            "src" => base_url('uploads/images/'.$student->photo),
                            'width' => '50px',
                            'height' => '50px',
                            "style" => "margin-bottom:5px; border: 1px solid #951200;"
                        );
                        echo img($array);
                    }
                ?>
            </td>
            <td width="44%" style="vertical-align: top;">
                <h2 style="margin:0;"> <strong><?php  echo $student->name; ?></strong></h2>
                <p>
                    <strong><?php  echo $this->lang->line("mark_classes")." ".$classes->classes; ?> </strong><br>
                    <strong><?php  echo "AY: ".$academic_year->schoolyear; ?></strong>
                </p>
            </td>
        </tr>
      </table>


<!--        mark new -->
      <div class="row">
            <?php $subjectExamMarks = []; if($marks && $exams) { ?>
                <?php

                            $map1 = function($r) { return intval($r->examID);};
                            $marks_examsID = array_map($map1, $marks);
                            $max_semester = max($marks_examsID);

                            $map2 = function($r) { return intval($r->examID);};
                            $examsID = array_map($map2, $exams);

                            $map3 = function($r) { return array("mark" => intval($r->mark), "semester"=>$r->examID);};
                            $all_marks = array_map($map3, $marks);

                            $map4 = function($r) { return array("gradefrom" => $r->gradefrom, "gradeupto" => $r->gradeupto);};
                            $grades_check = array_map($map4, $grades);

                            foreach ($exams as $exam) {
                                $allSubject = 0; $totalMark = 0;
                                if($exam->examID <= $max_semester) {

                                    $check = array_search($exam->examID, $marks_examsID);

                                    if($check>=0) {
                                        $f = 0;
                                        foreach ($grades_check as $key => $range) {
                                            foreach ($all_marks as $value) {
                                                if($value['semester'] == $exam->examID ) {
                                                    if($value['mark']>=$range['gradefrom'] && $value['mark']<=$range['gradeupto'])
                                                    {
                                                        $f=1;
                                                    }
                                                }
                                            }
                                            if($f==1)
                                            {
                                                break;
                                            }
                                        }

                                        $headerColor = ['bg-sky', 'bg-purple-shipu','bg-sky-total-grade', 'bg-sky-light', 'bg-sky-total' ];

                                        $headerCount = 1;
                                        foreach ($markpercentages as $value) {
                                            $color = 'bg-aqua';
                                            if($headerCount % 2 == 0) {
                                                $color = 'bg-aqua';
                                            }
                                            $headerCount++;
                                        }
                                    }
                                }

                                if(isset($separatedMarks[$exam->examID]) && is_array($separatedMarks[$exam->examID])) {
                                    foreach ($separatedMarks[$exam->examID] as $subjectID => $mark) {

                                        $totalSubjectMark = 0;
                                        foreach ($markpercentages as $markpercentage) {
                                            $totalSubjectMark += $mark[$markpercentage->markpercentageID];
                                        }
                                        $subjectExamMarks[$subjectID]['subject'] =  $mark['subject'];
                                        $subjectExamMarks[$subjectID]['exams'][$exam->examID]['total'] =  $totalSubjectMark;
                                        $finalPercentageMark = round(($totalSubjectMark*$exam->percentage)/100, 2);
                                        $subjectExamMarks[$subjectID]['exams'][$exam->examID]['mark_percentage'] =  $finalPercentageMark;
                                        $totalMark += $finalPercentageMark;
                                        $allSubject++;
                                    }

                                    $totalAverageMark = ($totalMark == 0) ? 0 :  ($totalMark/$allSubject);
                                }
                            }
                        ?>
            <?php } ?>

            <h3 class="box-title"><?=$this->lang->line('mark_summary')?></h3>
            <table width="100%" class="table-bordered">
                <thead>
                    <tr>
                        <th><?=$this->lang->line('mark_subject')?></th>
                        <?php
                            foreach ($exams as $exam) {
                                ?>
                                <th colspan="2"><?=$exam->exam?><span class="pull-right"><?=$exam->percentage?>%</span></th>
                                <?php
                            }
                        ?>
                        <th><?=$this->lang->line('mark_final')?></th>
                        <th><?=$this->lang->line('mark_gk')?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $finalResultMark = 0;
                    foreach ($subjectExamMarks as $mark) {
                        ?>
                        <tr>
                            <td data-title="<?=$this->lang->line('mark_subject')?>"><?=$mark['subject']?></td>
                            <?php
                                $subjectTotalExamFinalMark = 0;
                                foreach ($exams as $exam) {
                                    ?>
                                    <td data-title="<?=$exam->exam?>"><?php echo isset($mark['exams'][$exam->examID]['total']) ? $mark['exams'][$exam->examID]['total'] : ''?></td>
                                    <td data-title="<?=$exam->percentage?>%">
                                        <?php
                                            if(isset($mark['exams'][$exam->examID]['mark_percentage'])) {
                                                echo $mark['exams'][$exam->examID]['mark_percentage'];
                                                $subjectTotalExamFinalMark += $mark['exams'][$exam->examID]['mark_percentage'];
                                            }
                                        ?>
                                    </td>
                                    <?php
                                }
                            ?>
                            <td data-title="<?=$this->lang->line('mark_final')?>"><?=$subjectTotalExamFinalMark?></td>
                            <td data-title="<?=$this->lang->line('mark_gk')?>">
                                <?php
                                    $finalResultMark += $subjectTotalExamFinalMark;
                                    if(count($grades)) {
                                        foreach ($grades as $grade) {
                                            if($grade->gradefrom <= $subjectTotalExamFinalMark && $grade->gradeupto >= $subjectTotalExamFinalMark) {
                                                echo '<span class="text-bold">'.$grade->grade.'</span>';
                                                break;
                                            }
                                        }
                                    }

                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
            <br/>
            <div class="box-footer">
                <?php
                    $totalSubject = count($subjectExamMarks);
                    if($totalSubject) {
                        $result = ceilCustom($finalResultMark/$totalSubject);
                    }
                ?>
                <table class="table-bordered">
                    <tr>
                        <th><?=$this->lang->line('mark_g_key')?></th>
                        <td>
                            <?php
                                if(count($grades)) {
                                    if($grade = findingGrade($grades, $result)) {
                                        echo $grade;
                                    } else {
                                        echo '&nbsp;';
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?=$this->lang->line('mark_ay_final')?>
                        </th>
                        <td>
                            <?php
                                $totalSubject = count($subjectExamMarks);
                                if($totalSubject) {
                                    echo number_format((float)($result), 2, '.', '');
                                } else {
                                    echo '&nbsp;';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?=$this->lang->line('mark_final')?>
                        </th>
                        <td>
                            <?php
                                echo $finalResultMark;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <!--        mark new end-->
        <div id="page-footer">
            <table width="100%">
                <tr width="100%">
                    <td class="text-center">
                        <strong><?=$siteinfos->footer?></strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>
  </body>
</html>
