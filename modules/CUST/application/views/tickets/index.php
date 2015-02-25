
<div class="span10 cstmr_layout">
     <div class="sb-nav">
         <ul class="sb-nav-ul">
             <li data-tp="all" id="fltr_all" class="sb-nav-li" style="background-color: rgba(0, 0, 0, 0.74902); color: white;">All</li>
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
         </ul>
     </div>
     <div class="clearfix"></div>
     <?php $tckts = $this->get_tickets; ?>
     <div class="tbl-hdr"><h2>Total <?= sizeof($tckts) ?> tickets</h2></div>
     <table class="tckts-tbls table table-hover table-condensed table-bordered">
         <tr><?php for  ($i=0;  $i<sizeof($tckts); $i++){ ?>
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
<script type="text/javascript" src="/public/js/customer.js"></script>
