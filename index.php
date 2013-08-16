<?php

//
//
//      Copyright (C) 2012 Paul Halliday <paul.halliday@gmail.com>
//
//      This program is free software: you can redistribute it and/or modify
//      it under the terms of the GNU General Public License as published by
//      the Free Software Foundation, either version 3 of the License, or
//      (at your option) any later version.
//
//      This program is distributed in the hope that it will be useful,
//      but WITHOUT ANY WARRANTY; without even the implied warranty of
//      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//      GNU General Public License for more details.
//
//      You should have received a copy of the GNU General Public License
//      along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
//

include_once '.inc/session.php';
include_once '.inc/config.php';
include_once '.inc/functions.php';
include_once '.inc/countries.php';

dbC();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
<link rel="stylesheet" type="text/css" href=".css/squert.css" />
<link rel="stylesheet" type="text/css" href=".css/cal.css" />
<link rel="stylesheet" type="text/css" href=".css/jquery-jvectormap-1.2.2.css" />
<script type="text/javascript" src=".js/jq.js"></script>
<script type="text/javascript" src=".js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src=".js/cal.js"></script>
<script type="text/javascript" src=".js/squert.js"></script>
<script type="text/javascript" src=".js/charts.js"></script>
<script type="text/javascript" src=".js/jquery-jvectormap-1.2.2.min.js"></script>
<script type="text/javascript" src=".js/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.common.core.js" ></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.bar.js" ></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.pie.js" ></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.scatter.js" ></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.common.context.js" ></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.common.tooltips.js"></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.common.zoom.js"></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.common.key.js"></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.common.dynamic.js"></script>
<script type="text/javascript" src=".js/RGraph/libraries/RGraph.common.effects.js"></script>

<title>squert</title>
</head>
<body>
<div id=tab_group class=tab_group>
  <div id=t_dash class=tab>Dashboard</div>
  <div id=t_sum class=tab>Events</div>
  <div id=t_usr class=user data-c_usr=<?php echo $sUser;?>>
    Welcome&nbsp;&nbsp;<b><?php echo $sUser;?></b>&nbsp;&nbsp;|<span id=logout class=links>Logout</span>
  </div>
  <div id=t_search class=search>
    <div id=filters class=filter_show>filter</div>
    <input class=search id=search type=text size=75 maxlength=1000><span id=clear_search class=clear>&#x21BA;</span>
  </div>
  <div id=cal></div>
</div>

<div class=lr>
  <div class=content-left>

    <div class=event_cont_bar>
      <div class=label_l>Toggle</div>
      <div class=label>Event Queue Only:</div><div id=rt class=tvalue_off>off</div>
      <div class=label>Event Grouping:</div><div id=menu1 class=tvalue_on>on</div>
      <div class=label>Map:</div><div id=menu2 class=tvalue_off>off</div>
      <div class=label>Comments:</div><div id=menu3 class=tvalue_off>off</div>
    </div>

    <!--div id=rt class=menu_rt title="Queue">RT</div-->

    <div class=event_cont>
      <div class=label_l>Event Summary</div>
      <div class=label>Queued Events:</div><div id=qtotal class=value>-</div><div class=rt_notice title="update results">!</div>
      <div class=label>Total Events:</div><div id=etotal class=value>-</div>
      <div class=label>Total Signatures:</div><div id=esignature class=value>-</div>
      <div class=label>Total Sources:</div><div id=esrc class=value>-</div>
      <div class=label>Total Destinations:</div><div id=edst class=value>-</div>
    </div>

    <div class=event_cont>
      <div class=label_l>Event Count by Classification</div>
      <div class=label_c data-c=11>Admin Access:
      <div id=b_class-11 class=b_C1 title='Unauthorized Admin Access (F1)'>C1</div></div><div id=c-11 class=value>-</div>
      <div class=label_c data-c=12>User Access:
      <div id=b_class-12 class=b_C2 title='Unauthorized User Access (F2)'>C2</div></div><div id=c-12 class=value>-</div>
      <div class=label_c data-c=13>Attempted Access:
      <div id=b_class-13 class=b_C3 title='Attempted Unauthorized Access (F3)'>C3</div></div><div id=c-13 class=value>-</div>
      <div class=label_c data-c=14=>Denial of Service:
      <div id=b_class-14 class=b_C4 title='Denial of Service Attack (F4)'>C4</div></div><div id=c-14 class=value>-</div>
      <div class=label_c data-c=15>Policy Violation:
      <div id=b_class-15 class=b_C5 title='Policy Violation (F5)'>C5</div></div><div id=c-15 class=value>-</div>
      <div class=label_c data-c=16>Reconnaissance:
      <div id=b_class-16 class=b_C6 title='Reconnaissance (F6)'>C6</div></div><div id=c-16 class=value>-</div>
      <div class=label_c data-c=17>Malware:
      <div id=b_class-17 class=b_C7 title='Malware (F7)'>C7</div></div><div id=c-17 class=value>-</div>
      <div class=label_c data-c=1>No Action Req&#x2019;d.:
      <div id=b_class-1  class=b_NA title='No Action Req&#x2019;d. (F8)'>NA</div></div><div id=c-1 class=value>-</div>
      <div class=label_c data-c=2>Escalated Event:
      <div id=b_class-2  class=b_ES title='Escalate Event (F9)'>ES</div></div><div id=c-2 class=value>-</div>
    </div>

    <div class=event_cont>
      <div class=label_l>Event Count by Priority</div>
      <div class=label>High:</div><div id=pr_1 class=value>-</div>
      <div class=label>Medium:</div><div id=pr_2 class=value>-</div>
      <div class=label>Low:</div><div id=pr_3 class=value>-</div>
      <div class=label>Other:</div><div id=pr_4 class=value>-</div>   
    </div>

    <div class=event_cont>
      <div class=label_l>History</div>
      <div class=h_box></div>
    </div>

  </div>  

  <div class=content-right>
    <div id=t_dash_content class=content>
      <table width=950 align=right><tr><td>
      <h3>Events grouped by minute and hour</h3>
      <?php include_once '.charts/interval.php';?>
      <h3>Top signatures</h3>
      <?php include_once '.charts/sigsum.php';?>
      <h3>Top source and destination IPs</h3>
      <?php include_once '.charts/ip.php';?>
      <h3>Top source and destination Countries</h3>
      <?php include_once '.charts/country.php';?>
      </td></tr></table>
    </div>

    <div id=t_sum_content class=content>
      <div id=usr_filters></div>
      <div id=aaa-00 class=aaa></div>
    </div>
  </div>
</div>

<div class=cat_msg>
<div class=cm_top>Add a comment to the selected events: <input class=cat_msg_txt type=text maxlength=255></div>
<div class=cm_tbl></div>
</div>

<div id=bottom class=bottom>
<div id=b_tray class=b_tray><span id=loader class=loader>Working <img class=ldimg src=".css/load.gif"></span></div>
<div id=b_class class=b_class><span class=class_msg></span>&nbsp;</div>
<div id=b_event class=b_event></div>
<div id=b_update class=b_update>update</div>
<div id=b_top class=b_top>top</div>
</div>

<input id=event_sort type=hidden value="DESC">
<input id=event_sum type=hidden value="0">
<input id=cat_sum type=hidden value="0">
<input id=sel_tab type=hidden value="<?php echo $_SESSION['sTab'];?>">
</body>
</html>
<?php $_SESSION['LAST_ACTIVITY'] = time();?>
