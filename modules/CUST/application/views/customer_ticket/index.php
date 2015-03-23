        <div class="span10 left-cntnt cstmr_layout">
            <div class="apply_form" id="aply">
                <div class="tckt-hdr"><span>New Ticket</span>
                    <a href="/tickets" class="cntnt"><button class="actn-edit btn btn-primary" id="nw-tckt-btn">Tickets</button></a>
                </div><br>
                <form name="leave_apply_form" id="new_tckfrm">
                    <div class="form_txt"><input type="text" name="sub" placeholder="Subject" id="ticket-subjct"></div>
                    <div class="tckt-desc-bx"><textarea name="dec" id="ticket-description" placeholder="Write"></textarea>
                    <div class="atch-strp">
                    <a href="#"><i class="mdi-editor-attach-file"></i></a>
                    <a href="#"><i class="mdi-action-delete"></i></a>
                    <input type="file" id="tckt-attcmnt">
                    </div>
                    </div>
                    <div class="fine_atchmnts"></div>
                    <button id="nw_tckt_btn" class="btn btn-success">Submit new ticket</button> 
                </form>
            </div>
            <div class="tckt-atrbts">
                <div class="atrbt-itm"><button id="atr-cat" class="attr-lst"><i class="mdi-action-settings"></i>Category</button>
                    <div class="atr-slctd" id="cat-selctd" data-slctcat="">Nothing for now</div>
                    <div class="select-list" id="cat-list">
                        <div class="select-list-header">
                            <span class="select-list-title">All Categories</span>
                            <a href="#" class="select-list-rmv"><i class="mdi-content-clear"></i></a>
                        </div>
                        <div class="select-menu-item">
                            <ul class="slct-itms">
                                <li data-asgncat="Category1">Category1</li>
                                <li data-asgncat="Category2">Category2</li>
                                <li data-asgncat="Category3">Category3</li>
                                <li data-asgncat="Category4">Category4</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="atrbt-itm"><button id="atr-sb-cat"  class="attr-lst"><i class="mdi-action-settings"></i>Sub category</button>
                    <div class="atr-slctd" id="sb-cat-selctd">Nothing for now</div>
                    <div class="select-list" id="sb-cat-lst">
                        <div class="select-list-header">
                            <span class="select-list-title">All Sub-categories</span>
                            <a href="#" class="select-list-rmv" ><i class="mdi-content-clear"></i></a>
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
                <div class="atrbt-itm"><button id="atr-asgn" class="attr-lst"><i class="mdi-action-settings"></i>Assign to</button>
                    <div class="atr-slctd" id="asgn-selctd" data-slctmail="">Nothing for now</div>
                    <div class="select-list" id="asgn-lst">
                        <div class="select-list-header">
                            <span class="select-list-title">Managers</span>
                            <a href="#" class="select-list-rmv" ><i class="mdi-content-clear"></i></a>
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
        </div>
        <div class="span2">
            
        </div>

        <!--success pop up's area-->
        <a id= "btn-trgr" href="#resp-popup" class="modal_trigger_status" hidden></a>
        <div id="resp-popup" class="popupContainer_status" style="display:none;">
            <header class="popupHeader7">
                <span class="header_title"></span>
                <span class="modal_close"></span>
            </header>
            <section class="popupBody"></section>
        </div>
        </div>
        </div>

        <script type="text/javascript">
            $(".modal_trigger5").leanModal({top: 50, overlay: 0.2, closeButton: ".modal_close"});
            $(".modal_trigger_status").leanModal({top: 150, overlay: 0.2, closeButton: ".modal_close"});
        </script>
        
        <script type="text/javascript" src="/public/js/customer.js"></script>
        