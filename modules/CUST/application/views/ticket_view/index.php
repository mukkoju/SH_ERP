<div class="span9 cstmr_layout">
    <?php $viewTicket = $this -> viewTicket; ?>
    <div class="shw-tckt">
        <div class="actn-btns">
            <button class="btn btn-success" id="ttl-edt-btn">Edit<i class="icon-pencil"></i></button>
            <a href="/customer_ticket"><button class="btn btn-primary" id="nw-tckt-btn">New ticket</button></a>
        </div>
        <div class="tckt-ttl" data-tcktid='<?= $viewTicket[0][0]['_Id_'] ?>'><h2><?= $viewTicket[0][0]['_cust_servs_tckt_ttl'] ?></h2>
            <div class="edt-ttl">
                <div class="actn-btns">
                <button class="btn btn-success" id="actn-sve">Save</button>
                <button class="btn btn-danger" id="actn-cncl">Cancel</button></div>
                <input id="edt-ttl-inpt" data-tcktid='<?= $viewTicket[0][0]['_Id_'] ?>' type="text" value="<?= $viewTicket[0][0]['_cust_servs_tckt_ttl'] ?>">
            </div>    
        <div class="shw-tckt-opndby"  data-ownreml='<?= $viewTicket[0][0]['_cust_servs_tckt_holder']?>'><b><?= $viewTicket[0][0]['_emp_name']?></b> opened this ticket on <?= date('M j Y', $viewTicket[0][0]['_cust_servs_tckt_addedon'])?>
            <span class="tckt-sts">
                <?php if($viewTicket[0][0]['_cust_servs_tckt_sts'] == 0){?>
                <!--<button style="background-color: #f44336; color: white; border-color: #f44336;"><i class="icon-watch"></i> <b>Closed</b></button>-->
                <?php } else { ?>
                <!--<button style="background-color: #0f9d58; color: white; border-color: #0f9d58;"><i class="icon-watch"></i> <b>Open</b></button>-->
                <?php }?>
            </span>
        </div>
        </div>
        <div class="tckt-bdy">
            <div class="tckt-atrbts tckt-atrbts-shw">
                <div class="atrbt-itm "><button id="atr-cat" class="attr-lst"><i class="icon-list"></i>Category</button>
                    <div class="atr-slctd atr-slctd-shw" id="cat-selctd"><?= $viewTicket[0][0]['_cust_servs_tckt_catg']?></div>
                    <div class="select-list" id="cat-list">
                        <div class="select-list-header">
                            <span class="select-list-title">All Categories</span>
                            <a href="#" class="select-list-rmv" >X</a>
                        </div>
                        <div class="select-menu-item" style="">
                            <ul class="slct-itms">
                                <li>Category1</li>
                                <li>Category2</li>
                                <li>Category3</li>
                                <li>Category4</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="atrbt-itm"><button id="atr-sb-cat"  class="attr-lst"><i class="icon-list"></i>Sub category</button>
                    <div class="atr-slctd atr-slctd-shw" id="sb-cat-selctd"><?= $viewTicket[0][0]['_cust_servs_tckt_sbcatg']?></div>
                    <div class="select-list" id="sb-cat-lst">
                        <div class="select-list-header">
                            <span class="select-list-title">All Sub-categories</span>
                            <a href="#" class="select-list-rmv" >X</a>
                        </div>
                        <div class="select-menu-item" style="">
                            <ul class="slct-itms">
                                <li>Sub Category1</li>
                                <li>Sub Category2</li>
                                <li>Sub Category3</li>
                                <li>Sub Category4</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="atrbt-itm"><button id="atr-asgn-to" class="attr-lst"><i class="icon-list"></i>Asign to</button>
                <div class="atr-slctd atr-slctd-shw" id="asgn-selctd" data-slctmail2='<?= $viewTicket[0][0]['_cust_servs_tckt_asigni']?>' data-slctmail="<?= $viewTicket[0][0]['_cust_servs_tckt_asigni']?>"><?= $viewTicket[1][0]['_emp_name']?></div>
                    <div class="select-list" id="asgn-lst">
                        <div class="select-list-header">
                            <span class="select-list-title">Assignee</span>
                            <a href="#" class="select-list-rmv" >X</a>
                        </div>
                        <div class="select-menu-item" style="">
                            <ul class="slct-itms"></ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php $tckt_owner = $viewTicket[0][0]['_cust_servs_tckt_holder']; 
                                   $tckt_owner_pimg_path = APP_PATH."/uploads/$email/profile_pic";
                                   $tckt_owner_pimg = scandir($tckt_owner_pimg_path);
                                   $tckt_owner_pimg = $tckt_owner_pimg[2];
                                   ?>
            <div class="comnt-prfle-img"><?php if(!file_exists("$tckt_owner_pimg_path/$tckt_owner_pimg")){ ?><img src="/images/avtr.jpg"><?php } else {  ?><img src="/uploads/<?php echo $tckt_owner?>/profile_pic/<?php echo $tckt_owner_pimg?>"><?php }?></div>
            <div class="tckt-desc">
                <div class="tckt-desc-hdr"><b><?= $viewTicket[0][0]['_emp_name']?></b><span class="edt-cmnt"><i class="icon-pencil"></i></span></div>
                <span class="cmnt-bdy"><p><?=$viewTicket[0][0]['_cust_servs_tckt_desc']?><p></span>
            
            </div>
        </div>
        <div class="cmnt-sctn">
            <div class="old-cmnts-sctn">
            <?php if(sizeof($viewTicket) > 1){ ?>
            <?php for($i=0; $i<sizeof($viewTicket[2]); $i++){?>
            <div class="old-cmnts">
                        <?php
                        $mail = $viewTicket[2][$i]['_servs_cmnts_tckt_cmntby'];
                        $profile_img = APP_PATH . "/uploads/$mail/profile_pic";
                        $image_name = scandir($profile_img);
                        $image_name = $image_name[2];
                        ?>
                        <div class="comnt-prfle-img"><?php if (!file_exists("$profile_img/$image_name")) { ?><img src="/images/avtr.jpg"><?php } else { ?><img src="/uploads/<?php echo $mail ?>/profile_pic/<?php echo $image_name ?>"><?php } ?></div>
                        <div class="comnt_old_inpt">
                            <div class="comnt_old_hdr">
                                <b><?= $viewTicket[2][$i]['_emp_name'] ?></b>
                                <span class="cmntd_on"> Commented on <?= date("M j Y", $viewTicket[2][$i]['_servs_cmnts_tckt_cmnton']) ?></span>
                                <?php if($viewTicket[2][$i]['_servs_cmnts_tckt_cmntby'] == $_SESSION['loggedIn']){ ?>
                                <span class="edt-cmnt"><i class="icon-pencil"></i></span>
                                <?php }?>
                            </div>
                            <span class="cmnt-bdy"><p><?= $viewTicket[2][$i]['_servs_cmnts_tckt_cmnt'] ?></p></span>
                            <textarea class="cmnt_edt_vlue" placeholder="Post a comment" data-cmnt_id="<?= $viewTicket[2][$i]['_id_'] ?>"><?= $viewTicket[2][$i]['_servs_cmnts_tckt_cmnt'] ?></textarea>
                            <div class="cmnt-actns cmnt-edt-actns">
                            <button class="btn btn-success updt-edt-cmnt">Update comment</button>
                            <button class="btn btn-warning cls-opn-tckt cncl-cmnt-updt" data-type="clse">Cancel</button>
                            </div>
                        </div>
                    </div>
            
            <div class="clearfix"></div>
            <?php } }?>
            </div>
            <?php $email = $_SESSION['loggedIn']; 
                                   $profileimg = APP_PATH."/uploads/$email/profile_pic";
                                   $flnme = scandir($profileimg);
                                   $flnme = $flnme[2];
                                   ?>
            
            <div class="comnt-prfle-img" id="lgdin_prfl_img"><?php if(!file_exists("$profileimg/$flnme")){ ?><img src="/images/avtr.jpg"><?php } else {  ?><img src="/uploads/<?php echo $email?>/profile_pic/<?php echo $flnme?>"><?php }?></div>
            <div class="comnt_inpt">
                <div class="comnt_hdr" id="lgdin_nme"><b><?= $_SESSION['loggedInName']?></b></div>
                <textarea id="cmnt_vlue" placeholder="Post a comment"></textarea>
                <div class="cmnt-actns">
                    <button id="cmnt-tckt" class="btn btn-success">Comment</button>
                    <?php if($viewTicket[0][0]['_cust_servs_tckt_sts']  == 1) {?>
                    <button class="cls-opn-tckt btn btn-danger" id="clse-cmnt-tckt" data-type="clse">Close Ticket</button>
                    <?php } else { ?>
                    <button class="cls-opn-tckt btn btn-warning" id="ropn-cmnt-tckt" data-type="ropn">Reopen Ticket</button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
<!--        <div class="updt-actns">
            <button id="updt-tckt">Update ticket</button>
            <button id="updt-cncl-tckt">Cancel</button>
        </div>-->
    </div>
</div>

<script type="text/javascript" src="/public/js/customer.js"></script>