<link rel="stylesheet" href="/public/css/chartstyle.css" />
<div class="span10 cstmr_layout">
     <div class="sb-nav">
         <ul class="sb-nav-ul">
             <?php if($_SESSION['loggedInLevel'] == 1 || $_SESSION['loggedInLevel'] == 2){?>
             <li data-tp="all" id="fltr_all" class="sb-nav-li" style="background-color: #009587; color: white;">All</li>
             <li data-tp="asgne" class="sb-nav-li" id="fltr-asgne">Assignee <i class="icon-chevron-down"></i>
             <div class="drpdwn-lst">
                     <div class="select-list-header">
                            <span class="select-list-title">Filter by Assignee</span>
                            <a href="#" class="select-list-rmv" >X</a>
                        </div>
                        <ul></ul>
                 </div>
             </li>
             <li data-tp="ctgry" class="sb-nav-li">Category <i class="icon-chevron-down"></i>
                 <div class="drpdwn-lst">
                     <div class="select-list-header">
                            <span class="select-list-title">Filter by category</span>
                            <a href="#" class="select-list-rmv" >X</a>
                        </div>
                     <ul>
                                <li data-slctd="Category1">Category1</li>
                                <li data-slctd="Category2">Category2</li>
                                <li data-slctd="Category3">Category3</li>
                                <li data-slctd="Category4">Category4</li>
                     </ul>
                 </div>
             </li>
             <li data-tp="sort" class="sb-nav-li">Sort <i class="icon-chevron-down"></i>
                 <div class="drpdwn-lst" style="margin-left: -206px;">
                     <div class="select-list-header">
                            <span class="select-list-title">Sort by</span>
                            <a href="#" class="select-list-rmv" >X</a>
                        </div>
                     <ul>
                                <li data-slctd="Newest">Newest</li>
                                <li data-slctd="Oldest">Oldest</li>
                     </ul>
                 </div>
             </li>
             <li class="sb-nav-li" id="fltr_anlytcs" data-tp="anlytcs">Analytics</li>
             <?php } ?>
             <li class="sb-nav-li"><a href="/customer_ticket">New ticket</a></li>
         </ul>
     </div>
     <div class="clearfix"></div>
     <?php $tckts = $this->get_tickets; ?>
     <div id="tckt-sts-dt">
     <div class="tbl-hdr"><h2>Total <?= sizeof($tckts) ?> tickets</h2></div>
     <table class="tckts-tbls table table-hover table-condensed table-bordered">
         <?php for  ($i=0;  $i<sizeof($tckts); $i++){ ?>
         <tr>
                <td>
                 <i class="icon-help"></i>
                 <a href="tickets/view/<?= $tckts[$i]['_Id_']; ?>">
                     <span class="ttl-lnk"><?= $tckts[$i]['_cust_servs_tckt_ttl']; ?></span>
                     <?php if(!empty($tckts[$i]['_cust_servs_tckt_catg'])){ ?>
                     <span class="ttl-lnk-cat"><?= $tckts[$i]['_cust_servs_tckt_catg']; }?></span>
                     <?php if(!empty($tckts[$i]['_cust_servs_tckt_sbcatg'])){ ?>
                     <span class="ttl-lnk-sbcat"><?= $tckts[$i]['_cust_servs_tckt_sbcatg']; }?></span>
                 </a>
                 <div class="tckt-opnd-by">ticket opened on <?= date('M j Y', $tckts[$i]['_cust_servs_tckt_addedon']);?> by <?= $tckts[$i]['_emp_name'];?></div>
             </td>
         </tr>
         <?php }?>
     </table>
     </div>
     <div class="lod_mre"><button class="btn btn-warning" id="tckt-loamre-btn">Load More</button></div>
     </div>

<style> /*Chart css*/
.svg2{
    margin-top: 8px !important;
}
input[type="radio"] {
    width: auto;
    
}

input[type="radio"]:checked + label:not(.no-dft), input[type="checkbox"]:checked + label:not(.no-dft), input[type="radio"]:checked + label:not(.no-dft) *, input[type="checkbox"]:checked + label:not(.no-dft) *{
    color: #000;
}
input[type="radio"] + label:not(.no-dft), input[type="checkbox"] + label:not(.no-dft) {
    position: relative;
    padding: 0 0 0 25px;
    font-size: 1em;
    line-height: 1.2em;
    color: #888;
}
input[type="radio"] + label:not(.no-dft), input[type="checkbox"] + label:not(.no-dft) {
    position: relative;
    padding: 0 0 0 25px;
    font-size: 1em;
    line-height: 1.2em;
    color: #888;
}
input[type="radio"] + label:not(.no-dft):before, input[type="checkbox"] + label:not(.no-dft):before {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    left: 4px;
    height: 14px;
    width: 14px;
    background: white;
    border: 1px solid gray;
    box-shadow: inset 0px 0px 0px 2px white;
    -webkit-box-shadow: inset 0px 0px 0px 2px white;
    -moz-box-shadow: inset 0px 0px 0px 2px white;
    -o-box-shadow: inset 0px 0px 0px 2px white;
    border-radius: 8px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    -o-border-radius: 8px;
}
input[type="radio"]:checked + label:not(.no-dft):before, input[type="checkbox"]:checked + label:not(.no-dft):before {
    background: #FF4141;
}
input[type="radio"]{
    position: absolute;
    opacity: 0;
}

#tckt-cht{
    border: 1px solid #cccccc;
    padding: 8px 0px 8px 0px;
    margin-bottom: 16px;
}</style>
<script type="text/javascript" src="/public/js/customer.js"></script>
<script type="text/javascript" src="/public/js/chart.js"></script>
<script type="text/javascript" src="https://saddahaq.blob.core.windows.net/v11/gbojd3.v3.min.js"></script>