<div class="span7 left-cntnt">
            <div class="apply_form" id="aply">
                <h2 class="apply">Apply leave Here <i class="mdi-action-help"></i></h2><br>
                <p class="val_err"></p>
                <form name="leave_apply_form" id="leaveform">
                    <label class="form_txt">Subject:</br><textarea name="sub" style="width: 90%" placeholder="Ex: Request for leave" id="leve-subjct"></textarea></label>
                    <div style="float: left; padding-right: 15%; "><label>From:<br/><input type="text" id="datepicker-frm" name="from" class="datepicker" placeholder="From date" style="height: 30px; width: 250px;"></label></div>
                    <div style="float: left;"><label>To:<br/><input type="text" class="datepicker" name="to" placeholder="To date" style="height: 30px; width: 250px;" id="datepicker-to"/></label></div>
                    <div ><label>Description:</br><textarea name="dec" id="leve-description" style="width: 90%; height: 150px;"placeholder="Reason for leave"></textarea></label></div>    
                    <div class="ripc">
                    <button id="leave_apply_btn" class="btn btn-success">Apply</button>
                    </div>
                </form>
            </div>
            </div>
            <div class="span5">
            <div class="apply_left">
                <div class="overflow">
                    <div class="tbl-hdr"><h2>Previous leaves</h2></div>
                    <table class="table table-hover table-condensed table-bordered">
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>For</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <?php
                            $row = $this->getTakenLeaves;
                            for ($i = 0; $i < sizeof($row); $i++) {
                                ?>
                            <td><?php echo date("j-m-Y", $row[$i]['_emp_leaves_fromdate']); ?></td>
                                <td><?php echo $row[$i]['_emp_leaves_subject']; ?></td>
                                <td><a href="#<?php echo $i; ?>" class="modal_trigger5 prsnl-levs-list"><i class="icon-eye-open"></i>
                                        <?php
                                        if($row[$i]['_emp_leaves_manager_status'] != 'pending' && $row[$i]['_emp_leaves_manager_status'] == 0){
                                                echo "Rejected"; 
                                            }else{
                                        if ($row[$i]['_emp_leaves_final_status'] == 'pending') {
                                            echo "Pending";
                                        } elseif ($row[$i]['_emp_leaves_final_status'] == 1) {
                                            echo "Approved";
                                        } elseif ($row[$i]['_emp_leaves_final_status'] == 0) {
                                            echo "Rejected";
                                        }
                                            }
                                        ?>
                                    </a></td>
                                <div id="<?php echo $i; ?>" class="popupContainer6 pop_cont" style="display:none;">
                                <header class="popupHeader6">
                                    <span class="header_title">Leave Application</span>
                                    <span class="modal_close"></span>
                                </header>
                                <section class="popupBody6"><p><i><b><?= $_SESSION['loggedInName'] ?></b><br/>Address:<br/>Employee code:</i></p>
                                    <p><i>Date: <?php echo date("j-m-Y", $row[$i]['_emp_leaves_applyedon']) ?></i></p>
                                    <p><i>To:<br/>HR Department<br/>SADDAHAQ</i></p><br/>
                                    <p><b>SUB:</b><i><?php echo $row[$i]['_emp_leaves_subject']; ?></i></p>
                                    <b>FOR:</b><i> <?php echo date("j-m-Y", $row[$i]['_emp_leaves_fromdate']) ?>  <?php if($row[$i]['_emp_leaves_todate'] != ''){echo  date("- j-m-Y", $row[$i]['_emp_leaves_todate']);} ?></i>
                                    <p><i>Dear Sir,</i></p>
                                    <p><i><?php echo $row[$i]['_emp_leaves_description']; ?>......</i></p><br/>
                                    <p><i>Sincerely,<br/><?= $_SESSION['loggedInName'] ?>.</i></p>
                                    <?php if($row[$i]['_emp_leaves_manager_status'] != '' && $row[$i]['_emp_leaves_manager_status'] == 0) {
                                        ?><p style="color:#e3000f">Rejected by manager..<?php
                                    }?>
                                    <?php if($row[$i]['_emp_leaves_final_status'] != '' && $row[$i]['_emp_leaves_final_status'] == 0) {
                                        ?><p style="color:#e3000f">Rejected by HR manager..<?php
                                    }?>  
                                    <div>
                                    </div>
                                </section>
                            </div>
                            </tr>
<?php } ?>
                    </table>
                </div>
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
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
        $(".modal_trigger5").leanModal({top: 50, overlay: 0.2, closeButton: ".modal_close"});
        $(".modal_trigger_status").leanModal({top: 150, overlay: 0.2, closeButton: ".modal_close"});
        
        
</script>