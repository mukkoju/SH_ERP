<?php require 'views/header.php';?>
           <?php // if (!$this->user_details[0]['_emp_level'] == 0){?>
           <?php // if ($this->user_details[0]['leaves_alert'] == 1){?>
            <div class="alert alert-info alert-dismissable alert-leaves">
                <button type="button" class="close" data-dismiss="alert" 
                        aria-hidden="true">
                    &times;
                </button>
                <?php $row = $this->getLeavesDeatilsByHr;?>
                <b><?php // echo $row[0]['emp_name']; ?></b> Applied a leave. On <span><?php // echo date("j-M-Y" ,$row[0]['apply_date']); ?></span>
                <span class="alert-desc" style="display: block"><?php // echo $row[0]['description']; ?></span>
            </div>
           <?php //}?>
           <?php // }?>
            <div class="span7 left-cntnt">
                <div id="myCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="active item">
                            <img src="/images/item1.jpg" alt="Slide1" />
                        </div>
                        <div class="item">
                            <img src="/images/item2.jpg" alt="Slide2" />
                        </div>
                        <div class="item">
                            <img src="/images/item3.jpg" alt="Slide3" />
                        </div>
                    </div>
                    <a class="carousel-control left " href="#myCarousel" data-slide="prev">
                        <i class="icon-chevron-left-sign"></i></a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                        <i class="icon-chevron-right-sign"></i>
                    </a>
                </div>
            </div>
            <div class="span5">
            <div id="all_leaves_hr" data-complete = <?php echo "'" . json_encode($this->getLeavesDeatilsByHr) . "'"; ?> >
            <div id="all_leaves" data-complete = <?php echo "'" . json_encode($this->getLeavesDeatils) . "'"; ?> >
            </div>  
            </div>
        <?php if ($_SESSION['loggedInLevel'] == HR_MANAGER) { ?>
            <div class="dash_table">
                <div class="overflow">
                    <div class="tbl-hdr"><h2>Leave Applications</h2></div>
                    <table class="table table-hover table-condensed table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Manager Status</th>
                            <th>HR Status</th>
                        </tr>
                        <?php
                        $row = $this->getLeavesDeatilsByHr;
                        for ($i = 0; $i < sizeof($row); $i++) {
                            ?>
                            <tr>
                                <td align="center"><a id="<?php echo $i; ?>" href="#payslip-popup" class="modal_trigger6 hr-lev prsnl-levs-list"><?php echo $row[$i]['_emp_per_name']; ?></a></td>
                                <td align="center"><?php echo date("j-m-Y", $row[$i]['_emp_leaves_applyedon']); ?></td>
                                <td align="center"><?php if($row[$i]['_emp_leaves_manager_status'] == 1){
                                    echo 'Approved';
                                }           ?></td>
                                <td align="center"><a id="<?php echo $i; ?>" href="#payslip-popup" class="modal_trigger6 hr-lev prsnl-levs-list"><i class="icon-eye-open"></i>
                                            <?php
                                            
                                            if ($row[$i]['_emp_leaves_final_status'] == 'pending') {
                                                echo "Pending";
                                            } elseif ($row[$i]['_emp_leaves_final_status'] == 1) {
                                                echo "Approved";
                                            } elseif ($row[$i]['_emp_leaves_final_status'] == 0) {
                                                echo "Rejected";
                                            }
                                            
                                            ?></a></td>
                               </tr>
                                            <?php } ?>
                    </table>
                </div>
            </div>
            
<?php } ?>
<?php if ($_SESSION['loggedInLevel'] == PROJECT_MANAGER) { ?>
            <div class="dash_table">
                <div class="overflow">
                    <div class="tbl-hdr"><h2>Leave Applications</h2></div>
                    <table class="table table-hover table-condensed table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>manager status</th>
                        </tr>
                        <?php
                        $row = $this->getLeavesDeatils;
                        for ($i = 0; $i < sizeof($row); $i++) {
                            ?>
                            <tr>
                                <td  align="center"><a id="<?php echo $i; ?>" href="#leave_manager" class="modal_trigger6 maneger-lev prsnl-levs-list"><?php echo $row[$i]['_emp_per_name']; ?></a></td>
                                <td  align="center"><?php echo date("j-m-Y", $row[$i]['_emp_leaves_applyedon']); ?></td>
                                <td  align="center"><a id="<?php echo $i; ?>" href="#leave_manager" class="modal_trigger6 maneger-lev prsnl-levs-list"><i class="icon-eye-open"></i>
                                            <?php
                                            if ($row[$i]['_emp_leaves_manager_status'] == 'pending') {
                                                echo "Pending";
                                            } elseif ($row[$i]['_emp_leaves_manager_status'] == 1) {
                                                echo "Approved";
                                            } elseif ($row[$i]['_emp_leaves_manager_status'] == 0) {
                                                echo "Rejected";
                                            }
                                            ?></a></td>
                            </tr>
    <?php } ?>
                    </table>
                </div>
            </div>
<?php } ?>
        </div>
           <?php if ($this->user_details[0]['_emp_level'] == 0) { ?>
           <div class="span3"><div class="dash_table">
                   <?php $time = time()?>
                    <div class="tbl-hdr"><h2>This month Birthdays</h2></div>
                    <table class="table table-hover table-condensed table-bordered bdy-rmindr">
                        <tr>
                            <th>Name</th>
                            <th>Birthday</th>
                        </tr>
                    </table></div></div>
           <?php }?>
        </div>
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
        <!--success pop up area close-->
        <!--Hr leave pop up area start-->
        <div id="payslip-popup" class="popupContainer6 pop_cont" style="display:none;">
                <header class="popupHeader6">
                <span class="header_title">Leave application</span>
                <span class="modal_close"></span>
               </header>
               <section class="popupBody6">
               <div class="hr"><i>
                       Place : Hyderabad,<br>
                       <p><span>Date:</span> <span id="hrlev-date"></span></p>  

                        To:<br>
                        HR Department <br>
                        SADDAHAQ <br><br>
                        <span><b>SUB: </b><p id="hrlev-sub"></p></span>
                        <b>For:</b> <span id="frmdat"></span> <span id="to-dat"></span><br>
                        Dear Sir,
                        <p id="hrlev-desc"></p>
                        Sincerely.,
                        <b><p id="hrlev-emp-name"></p></b>
                        <b class="hidden"><p id="hrlev-emp-email"></p></b>
                    </i></div>
                <button name="hr_status" value="Rejected" class="btn btn-info lev-rejct-btn hr_status">Reject</button>
                <button name="hr_status" value="Approved" class="btn btn-info lev-aprv-btn hr_status">Approve</button>
            </section>
        </div>
     <!--Hr leave pop up area close-->


        <!--manager leave pop up area--> 
        <div id="leave_manager" class="popupContainer6 pop_cont" style="display:none;">
            <header class="popupHeader6">
                <span class="header_title">Leave application</span>
                <span class="modal_close"></span>
            </header>

            <section class="popupBody6">

                <div class="mngr"><i>
                        Place : Hyderabad, 
                        <p><span>Date:</span> <span id="mngrlev-date"></span></p>  
                        To:<br>
                        HR Department <br>
                        SADDAHAQ <br>
                        <b>SUB:</b> <p id="mngrlev-sub"></p>
                        <b>For:</b> <span id="frmdat"></span> <span id="to-dat"></span><br> 
                        Dear Sir,
                        <p id="mngrlev-desc"></p>
                        Sincerely.,
                        <p id="mngrlev-emp-name"> </p>
                        <p class="hidden" id="mngrlev-emp-email"> </p>
                    </i></div>
                <button name="mngr_status" value="0" class="btn btn-info lev-rejct-btn mngr_status">Reject</button>
                <button name="mngr_status" value="1" class="btn btn-info lev-aprv-btn mngr_status">Approve</button>
            </section>
        </div>
        <!--manager leave pop up area close-->
    </div>
</div>
</div>
<script type="text/javascript">
    $(".modal_trigger6").leanModal({top: 10, overlay: 0.2, closeButton: ".modal_close"});
    $(".modal_trigger_status").leanModal({top: 150, overlay: 0.2, closeButton: ".modal_close"});
    $('li .menu-news').hover(function(){
       $('.news').show();
    });
    $('.news').mouseleave(function(){
       $('.news').hide(); 
    });
//    $('.menu-news').parents('li').hover(function(){
//           $('.news').hide();
//       });
     
    
    $(".hr-lev").click(function () {
        var i = $(this).attr("id");
        var data = $("#all_leaves_hr").data('complete');
        data = data[i];
        var time = $.datepicker.formatDate('dd-MM-yy.', new Date(data['_emp_leaves_applyedon']*1000));
        var frmdat = $.datepicker.formatDate('dd-MM-yy', new Date(data['_emp_leaves_fromdate']*1000));
        var todat = $.datepicker.formatDate('TO dd-MM-yy', new Date(data['_emp_leaves_todate']*1000));
       
        $("#payslip-popup").data("lid", data['_id_']);
        $("#payslip-popup").find("#hrlev-emp-addr").text(data['address']);
        $("#payslip-popup").find("#hrlev-emp-code").text(data['emp-code']);
        $("#payslip-popup").find("#frmdat").text(frmdat);
        if(data['todate']!= ''){
        $("#payslip-popup").find("#to-dat").text(todat);
    }
        $("#payslip-popup").find("#hrlev-date").text(time);
        $("#payslip-popup").find("#hrlev-sub").text(data['_emp_leaves_subject'].split("\\sq").join("'"));
        $("#payslip-popup").find("#hrlev-desc").text(data['_emp_leaves_description'].split("\\sq").join("'"));
        $("#payslip-popup").find("#hrlev-emp-name").text(data['_emp_per_name']);
        $("#payslip-popup").find("#hrlev-emp-email").text(data['_emp_leaves_email']);
    });

    $(".maneger-lev").click(function () {
        var i = $(this).attr("id");
        var data = $("#all_leaves").data('complete');
        data = data[i];
        var time = $.datepicker.formatDate('dd-MM-yy.', new Date(data['_emp_leaves_applyedon']*1000));
        var frmdat = $.datepicker.formatDate('dd-MM-yy', new Date(data['_emp_leaves_fromdate']*1000));
        var todat = $.datepicker.formatDate('TO dd-MM-yy', new Date(data['_emp_leaves_todate']*1000));
        $("#leave_manager").data("lid", data['_id_']);
        $("#payslip-popup").find("#frmdat").text(frmdat);
        if(data['todate']!= ''){
        $("#payslip-popup").find("#to-dat").text(todat);
    }
        $("#leave_manager").find("#mngrlev-date").text(time);
        $("#leave_manager").find("#mngrlev-sub").text(data['_emp_leaves_subject'].split("\\sq").join("'"));
        $("#leave_manager").find("#mngrlev-desc").text(data['_emp_leaves_description'].split("\\sq").join("'"));
        $("#leave_manager").find("#mngrlev-emp-name").text(data['_emp_per_name']);
        $("#leave_manager").find("#mngrlev-emp-email").text(data['_emp_leaves_email']);
    });


    $(".hr_status").click(function (e) {
        e.preventDefault();
        
        $.ajax({
            url: "/leaves/hr_approve",
            method: 'post',
            data: {
                "id": $(this).parents("#payslip-popup").data("lid"),
                "emp_name": $('#payslip-popup').find('#hrlev-emp-name').html(),
                "dec": $('#payslip-popup').find('#hrlev-desc').html(),
                "email": $('#payslip-popup').find('#hrlev-emp-email').html(),
                "hr_status": $(this).attr("value")
                 // "reject":regform.elements['reject'].value,
            },
            success: function (res) {
                $("#payslip-popup").css("display", "none");
                $("#resp-popup").find(".popupBody").html(res);
                $("#btn-trgr").trigger('click');
//                setTimeout(function () {
//                    window.location.reload();
//                }, 2000);
            }
        });
    });

    $(".mngr_status").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/leaves/manger_status",
            method: 'post',
            data: {
                "id": $(this).parents("#leave_manager").data("lid"),
                "emp_name": $('#leave_manager').find('#mngrlev-emp-name').html(),
                "dec": $('#leave_manager').find('#mngrlev-desc').html(),
                "email": $('#leave_manager').find('#mngrlev-emp-email').html(),
                "mngr_status": $(this).attr("value")
                        // "reject":regform.elements['reject'].value,
            },
            success: function (res) {
                $("#leave_manager").css("display", "none");
                $("#resp-popup").find(".popupBody").html(res);
                $("#btn-trgr").trigger('click');
//                setTimeout(function () {
//                    window.location.reload();
//                }, 2000);
            }
        });
    });
</script>

<?php require 'views/footer.php'; ?>
