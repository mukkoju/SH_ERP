 <div class="span10 cstmr_layout">
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