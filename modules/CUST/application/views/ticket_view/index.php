<div class="span9 cstmr_layout">
    <?php $viewTicket = $this -> viewTicket;?>
    <div class="shw-tckt">
        <div class="actn-btns"><button class="actn-edit"><i class="icon-pencil"></i></button></div>
        <div class="tckt-ttl" data-tcktid='<?= $viewTicket[0]['_Id_'] ?>'><h2><?= $viewTicket[0]['_cust_servs_tckt_ttl'] ?></h2>
        <div class="shw-tckt-opndby"  data-ownreml='<?= $viewTicket[0]['_cust_servs_tckt_holder']?>'><b><?= $viewTicket[0]['_emp_name']?></b> opened this ticket on <?= date('M j Y', $viewTicket[0]['_cust_servs_tckt_addedon'])?></div>
        </div>
        <div class="tckt-bdy">
            <div class="tckt-atrbts tckt-atrbts-shw">
                <div class="atrbt-itm "><button id="atr-cat" class="attr-lst"><i class="icon-list"></i>Category</button>
                    <div class="atr-slctd atr-slctd-shw" id="cat-selctd"><?= $viewTicket[0]['_cust_servs_tckt_catg']?></div>
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
                    <div class="atr-slctd atr-slctd-shw" id="sb-cat-selctd"><?= $viewTicket[0]['_cust_servs_tckt_sbcatg']?></div>
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
                <div class="atr-slctd atr-slctd-shw" id="asgn-selctd" data-slctmail2='<?= $viewTicket[0]['_cust_servs_tckt_asigni']?>' data-slctmail="<?= $viewTicket[0]['_cust_servs_tckt_asigni']?>"><?= $viewTicket[1]['_emp_name']?></div>
                    <div class="select-list" id="asgn-lst">
                        <div class="select-list-header">
                            <span class="select-list-title">Assignee</span>
                            <a href="#" class="select-list-rmv" >X</a>
                        </div>
                        <div class="select-menu-item" style="">
                            <ul class="slct-itms">
                                <li>Asign 1</li>
                                <li>Asign 2</li>
                                <li>Asign 3</li>
                                <li>Asign 4</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tckt-desc"><?=$viewTicket[0]['_cust_servs_tckt_desc']?>
            
            </div>
            
        </div>
        <div class="clearfix"></div>
        <div class="updt-actns">
            <button id="updt-tckt">Update ticket</button>
            <button id="updt-cncl-tckt">Cancel</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="/public/js/customer.js"></script>