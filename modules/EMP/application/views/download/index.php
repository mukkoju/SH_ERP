
<!--            <div class="span7 left-cntnt">
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
            </div>-->
            <div class="span7 cstmr_layout">
                <div class="dwnld-clps"><h2>Pay slips<i class="mdi-navigation-expand-more"></i></h2>
                 <table border="2" class="table table-hover table-condensed table-bordered" style="opacity: 0">
                <tr><th>Payslip</th>
                    <th>Get</th>
                </tr>
                <?php $row = $this->get_slips; ?>
                <?php for ($i = 0; $i < sizeof($row); $i++) { ?>
                    <tr><td align="center"><?php echo $row[$i]['_emp_payslip_title']; ?></td>
                        <td class='dwnld'><a href="/download/down_slips/<?php echo $row[$i]['_emp_payslip_title']; ?>"><i class="icon-download"></i></a></td>
                    </tr>
                <?php } ?>
            </table>
                </div>
                <div class="dwnld-clps"><h2>Form 16 <i class="mdi-navigation-expand-more"></i></h2></div>
                <div class="dwnld-clps"><h2>Employment letter <i class="mdi-navigation-expand-more"></i></h2></div>
                <div class="dwnld-clps"><h2>Bonafide certificate <i class="mdi-navigation-expand-more"></i></h2></div>
                
            
            </div>
        </div>
    </div>
</div>