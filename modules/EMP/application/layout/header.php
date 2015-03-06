<?php $tct_notfcns = $this->tickets_notfcn;?>
<html>
    <head>
        <title>Saddahaq Employes</title>
        <link rel="icon" type="image/png" href="https://saddahaq.blob.core.windows.net/multimedia/favicon.ico">
        <link rel="stylesheet" href="/public/css/view_helper.css" />
        
        <link rel="stylesheet" href="/public/global/saddahaq/css/saddahaq-ie7.css" />
        <link rel="stylesheet" href="/public/global/saddahaq/css/saddahaq.css" />
        <link rel="stylesheet" href="/public/global/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="/public/global/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/public/global/bootstrap/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="/public/global/bootstrap/css/bootstrap-responsive.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Bitter:400,400italic,700.js' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/public/global/bootstrap/css/jquery-ui.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <script src="/public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/public/js/jquery.leanModal.min.js"></script>
        <link type="text/css" rel="stylesheet" href="/public/css/style.css"/>
        <link type="text/css" rel="stylesheet" href="/public/css/chkbx.css"/>
        <link type="text/css" rel="stylesheet" href="/public/css/form_control.css"/>
        <link type="text/css" rel="stylesheet" href="/public/global/saddahaq/css/material-wfont.css"/>
        <link rel="stylesheet" href="/public/css/customer.css" />
        <!--<link rel="stylesheet" href="/public/global/bootstrap/css/logout.css"/>-->
        <script src="/public/js/logout.js"></script>
        <script type="text/javascript" src="/public/global/bootstrap/js/bootstrap.js"></script>
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
        <script type="text/javascript" src="/public/global/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/public/global/bootstrap/js/jquery-ui.js"></script>
        <script type="text/javascript" src="/public/global/bootstrap/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/public/js/ripple.js"></script>
        <script type="text/javascript" src="/public/js/matrial.js"></script>
    </head>
    <body>
    <div class="ligt-box" style="margin-left: 0"><img src="/images/loading.gif"></div> 
        <header>
            <?php // echo $_SESSION['loggedIn']?>
         
            <a href="/home" id="logo"></a>

            <nav>
                <!--          Hidden desktop menu-->
                <ul class="hidden-desktop" style="float: right;">
                    <li class="dropdown hidn-dsktp-mnu pull-right"><a href="" id="dLabel" class="dropdown-toggle" role="button" data-toggle="dropdown" data-target="#" rel="nofollow"><i class="icon-navicon"></i></a>
                        <ul class="dropdown-menu hr-dropdwn" role="menu" aria-labelledby="dLabel">
                            <li class="dropdown"><a href="/home" class="current">HOME</a></li>
                            <li class="dropdown"><a href="/leaves">LEAVES</a></li>
                            <li class="dropdown"><a href="/download">DOWNLOADS</a></li>
                            <li><a href="#model_directory" class="modal_trigger6">DIRECTORY</a></li>
                            <li><a href="#model_holiday" class="modal_trigger6">HOLIDAY CAL</a></li>
                            <!--<li class="dropdown"><a href="" class="menu-news">NEWS</a></li>-->
                            <?php if($this->user_details[0]['_emp_level'] == HR_MANAGER){ ?>
                            <li class="dropdown-submenu"><a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" data-target="#" rel="nofollow">HR</a>
                                <ul class="dropdown-menu hr-dropdwn pull-right" role="menu" aria-labelledby="dLabel">
                                    <li class="dropdown"><a href="/salaries">SALARIES</a></li>
                                    <li class="dropdown"><a href="#model_reg" class="modal_trigger6">NEW EMP</a></li>
                                    <li class="dropdown"><a href="#model_doc" class="modal_trigger6">EMP DOCS</a></li>
                                    <li class="dropdown"><a href="#model_holiday_hr" class="modal_trigger6">HOLIDAYS</a></li>
                                    <!--<li class="dropdown"><a href="#">EXIT SETTILEMENT</a></li>-->
                                    <li class="dropdown"><a href="/emp_data">ALL EMP</a></li>
                                </ul>
                            </li>
                            <?php }?>
                            <li class="dropdown"><a href="/logout">LOGOUT</a></li>
                            <li class="usr-pic-name-hdr"><a href="#model" id="modal_trigger12">
                                   <?php $mail = $_SESSION['loggedIn']; 
                                   $profile_img = APP_PATH."/uploads/$mail/profile_pic";
                                   $image_name = scandir($profile_img);
                                   $image_name = $image_name[2];
                                   ?>
                                    <?php $email = $_SESSION['loggedIn']; ?>
                                    <?php if (!file_exists("$profile_img/$image_name")) { ?><img src='/images/avtr.jpg' class="profile-avtr"><?php } else { ?><img src='/uploads/<?php echo $email?>/profile_pic/<?php echo $image_name?>' class="profile-avtr"><?php } ?> <?php echo $this->user_details[0]['_emp_name']; ?></a>
                                <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#" rel="nofollow"><span class="caret"></span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--          Hidden phone menu-->
                <ul class="hidden-phone">
                    <li><a href="/home" data-pg="home">HOME</a></li>
                    <li><a href="/leaves" data-pg="leaves">LEAVES</a></li>
                    <li><a href="/download" data-pg="download">DOWNLOADS</a></li>
                    <li><a href="#model_directory" class="modal_trigger6">DIRECTORY</a></li>
                    <li><a href="#model_holiday" class="modal_trigger6">HOLIDAY CAL</a></li>
                    <li><a href="/tickets" class="modal_trigger6" data-pg="tickets">TICKETS</a></li>
                    <!--<li><a href="#" class="menu-news">NEWS<span class="caret"></span></a></li>-->
                    <?php if($this->user_details[0]['_emp_level'] == HR_MANAGER){ ?>
                    <li class="dropdown"><a href="" id="dLabel" class="dropdown-toggle" role="button" data-toggle="dropdown" data-target="#" rel="nofollow">HR<span class="caret"></span></a>
                        <ul class="dropdown-menu hr-dropdwn" role="menu" aria-labelledby="dLabel">
                            <li class="dropdown"><a href="/salaries">SALARIES</a></li>
                            <li class="dropdown"><a href="#model_reg" class="modal_trigger6">NEW EMP</a></li>
                            <li class="dropdown"><a href="#model_doc" class="modal_trigger6">EMP DOCS</a></li>
                            <li class="dropdown"><a href="#model_holiday_hr" class="modal_trigger6">HOLIDAYS</a></li>
                            <!--<li class="dropdown"><a href="#">EXIT SETTILEMENT</a></li>-->
                            <li class="dropdown"><a href="/emp_data">ALL EMP</a></li>
                        </ul>
                    </li>
                    <?php }?>
                    <li class="usr-pic-name-hdr hidden-phone">
                            <?php $mail = $_SESSION['loggedIn']; 
                        $profile_img = APP_PATH."/uploads/$mail/profile_pic";
                        if(file_exists($profile_img)){
                         $image_name = scandir($profile_img);
                        }
                         $image_name = $image_name[2];
                                ?>
                            <?php $email = $this->user_details[0]['_emp_email']; ?>
                        <?php if(sizeof($tct_notfcns) > 0){ ?>
                        <span class="notfcn" data-ntfnsize="<?= sizeof($tct_notfcns);?>"><?= sizeof($tct_notfcns); }?></span>
                            <div class="notfcn_vew span3">
                                <ul>
                                    <?php for($i=0; $i<sizeof($tct_notfcns); $i++) {?> 
                                    <li>
                                        <div class="tckt-icn"><i class="icon-help"></i></div>
                                        <div class="tckt-ntf-desc span16"><a class="spna5" href="/tickets/view/<?= $tct_notfcns[$i]['_servs_hstry_tckt_id']?>"><b><?= $tct_notfcns[$i]['_servs_hstry_tckt_asgn1'] ?></b> Assigned a ticket by  you</a></div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php if (!file_exists("$profile_img/$image_name")) { ?><img src='/images/avtr.jpg' class="profile-avtr"><?php } else { ?><img src='/uploads/<?php echo $email?>/profile_pic/<?php echo $image_name?>' class="profile-avtr"><?php } ?> <a href="#model" id="modal_trigger1"><?php echo $this->user_details[0]['_emp_name']; ?></a>
                        <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#" rel="nofollow"><span class="caret"></span></a>
                        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dLabel">
                        <li class="dropdown"><a href="/logout">LOGOUT</a></li><br>
                        </ul>
                    </li>
                </ul>
                
            </nav>
            <div class="sts-strp"><p></p></div>
        </header>
        <div id="model" class="popupContainer1 pop_cont" style="display:none;">
            <header class="popupHeader6">
                <span class="header_title"><?= $_SESSION['loggedInName'] ?></span>
                <span class="modal_close"></span>
                <!--</header>-->

                <section class="popupBody">
                    <div class="profile_img">
                        <?php $mail = $_SESSION['loggedIn']; 
                         $profile_img = APP_PATH."/uploads/$mail/profile_pic";
                        if(file_exists($profile_img)){
                         $image_name = scandir($profile_img);
                        }
                         $image_name = $image_name[2];?>
                        <?php if(file_exists("$profile_img/$image_name")){ ?>
                        <img src="/uploads/<?php echo $email?>/profile_pic/<?php echo $image_name?>" id="profile_image_style"/><input type="file" class="profile-img-change-input" id="p-pic-change"><i class="mdi-image-photo-camera"></i>
                        <?php }else{?>
                        <img src="/images/avtr.jpg" id="profile_image_style"/><input type="file" class="profile-img-change-input" id="p-pic-change"><i class="mdi-image-photo-camera"></i>
                        <?php }?>
                        <p class="profle-pop-degnatn"><?= $_SESSION['loggedInDesignation'] ?></p>
                        <div class="profile_pop_save">
                        </div>
                    </div>
                    
                    <div class="profile">
                        <p style="margin-left: 5px;">ID:<span style="padding-left: 10px" ><?= $_SESSION['loggedInId'] ?></span></p>
                        <p><i class="mdi-content-mail"></i><span><?= $_SESSION['loggedIn'] ?></span></p>
                        <!--<p><i class="icon-map-location"></i><span><?php // echo $this->emp_per_details[0]['_emp_per_adrs']; ?></span></p>-->
                        <p><i class="mdi-notification-phone-in-talk"></i><span><?= $_SESSION['loggedInPhone'] ?></span></p>
                    </div>

                </section>
        </div>
        <div id="model_reg" class="popupContainer" style="display:none;">
            <header class="popupHeader6">
                <span class="header_title">Register on portal</span>
                <span class="modal_close"></span>
            </header>
            <section class="popupBody">
                <form name="regform" id="resetform">
                    <p align="center" class="val_err"></p>
                    <div class="intial-form">
                        <div class="user_details">
                            <label>Name</label>
                            <input name="emp_name" id="emp_name_reg" value="nope" type="text" style="height: 30px; width: 250px;" placeholder="Name"/>
                            <br>
                            <label>Emp_id</label>
                            <input name="emp_id" id="emp_id_reg" type="text" value="nope" style="height: 30px; width: 250px;" placeholder="Emp id"/>
                            <br>
                            <label>Email Address</label>
                            <input name="emp_email" id="emp_email_reg" type="email" value="nope@gmail.com" style="height: 30px; width: 250px;" placeholder="Email"/>
                            <br>
                            <label>Password</label>
                            <input name="password" id="password_reg" type="password" value="nopedsvds" style="height: 30px; width: 250px;" placeholder="password"/>
                            <br>
                            <label>Fathername</label>
                            <input name="fathername" id="fathername_reg" type="text" value="nope" style="height: 30px; width: 250px;" placeholder="fathername"/>
                            <br>
                            <label>Mothername</label>
                            <input name="mothername" id="mothername_reg" type="text" value="nope" style="height: 30px; width: 250px;" placeholder="mothername"/>
                            <br>
                            <label>Gender</label>
                            <div class="radio" style="margin-top: -5px;">Male: <label><input name="gender" id="gender_reg" type="radio" value="Male"></label></div>
                            <div class="radio">Female: <label><input name="gender" value="Female" type="radio"></label></div>
                        </div>
                        <div class="emr_details">
                            <label>Phone no</label>
                            <input name="emp_phno" id="emp_phno_reg" type="text" value="9948983078" style="height: 30px; width: 250px;" placeholder="+9199948983078"/>
                            <br>
                            <label>DOB</label>
                            <input name="dob" id="dob_reg" class="datepicker-dob" value="10-2-2015" type="text" style="height: 30px; width: 250px;" placeholder="Date of birth"/>
                            <br>
                            <label>Age</label>
                            <input name="age" id="age_reg" type="text" value="25" style="height: 30px; width: 250px;" placeholder="Age"/>
                            <br>
                            <label>Bloodgroup</label>
                            <input name="bloodgroup" id="bloodgroup_reg" value="nope" type="text" style="height: 30px; width: 250px;" placeholder="Blood group"/>
                            <br>
                            <label>Address</label>
                            <textarea  name="address" id="address_reg" value="nope" cols="5" rows="3" style=" height: 50px; width: 250px;"></textarea>
                            <br>
                            <label>Spouse</label>
                            <input name="spousename" id="spousename_reg" type="text" value="nope" style="height: 30px; width: 250px;" placeholder="If not married type unmarried"/>
                            <br>
                            <select id="emptype_reg" name="department" style="width: 251px;">
                                <option>Employee type</option>
                                <option selected="true">Full time</option>   
                                <option>Content</option>   
                                <option>Internship</option>   
                                <option>Part time</option>   
                            </select>
                        </div>
                        <div class="action_btns">
                            <div class="one_half last">
                                <button class="btn btn-success" id="Next" value="Next" type="button" style="color: #FF7171;">Next<i class="mdi-navigation-chevron-right"></i></button></div>
                        </div>
                    </div>
                    <div class="slide_left">
                        <div class="user_details">
                            <label>Designation</label>
                            <input name="designation" id="designation_reg" value="nope" type="text" style="height: 30px; width: 250px;" placeholder="Role"/>
                            <br>
                            <label>Department</label>
                            <select id="department_reg" name="department">
                                <option selected="true">Content</option>   
                                <option>Tech</option>   
                                <option>Marketing</option>   
                                <option>Communications</option>   
                                <option>HR</option>
                                <option>Operations</option>   
                                <option>Management</option>
                            </select>
                            <!--<input name="department" id="department_reg" type="text" style="height: 30px; width: 250px;" placeholder="Department"/>-->
                            <br>
                            <h5>Emergency contact details</h5>
                            <label>Name</label>
                            <input name="emr_name" id="emr_name_reg" value="nope" type="text" style="height: 30px; width: 250px;"/>
                            <br>
                            <label>Relation</label>
                            <input name="emr_relation" id="emr_relation_reg" value="nope" type="text" style="height: 30px; width: 250px;" placeholder="Relation with emp"/>
                            <br>
                            <label>Ph no</label>
                            <input name="emr_phone" id="emr_phone_reg" value="9948983078" type="text" style="height: 30px; width: 250px;" placeholder="Ph no"/>
                            <br>
                            <label>Email</label>
                            <input name="emr_email" id="emr_email_reg" value="nope@gmail.com" type="text" style="height: 30px; width: 250px;" placeholder="Email"/>
                        </div>
                        <div class="emr_details">
                            <h5>Salaries details</h5>
                            <label>Bank Acc no</label>
                            <input name="bank_acc" id="bank_acc_reg" value="123456" type="text" style="height: 30px; width: 250px;" placeholder="Bank Acc no"/>
                            <br>
                            <label>PF ACC no</label>
                            <input name="pf_acc" id="pf_acc_reg" value="123456" type="text" style="height: 30px; width: 250px;" placeholder="PF ACC no"/>
                            <br>
                            <label>PAN</label>
                            <input name="pan" type="text" id="pan_reg" value="123456" style="height: 30px; width: 250px;" placeholder="PAN"/>
                            <br>
                            <label>Bank IFSC code</label>
                            <input name="ifsc" type="text" id="ifsc_reg"  value="123456" style="height: 30px; width: 250px;" placeholder="Bank IFSC code"/>
                            <br>
                            <label>Basic Salarie</label>
                            <input name="basic_salrie" id="basic_salrie_reg" value="123456" type="text" style="height: 30px; width: 250px;" placeholder="Basic Salari"/>
                            <br>
                            <label>Date of joining</label>
                            <input name="doj"  id="doj_reg" class="datepicker-dob" value="10-2-2015" type="text" style="height: 30px; width: 250px;" placeholder="Date of joining"/>
                            <br>
                            <!--                <label>Documents uploads</label>
                                         <input name="doc" type="file" style="height: 30px; width: 250px;" placeholder="doc"/>
                                         <br>-->
                        </div>
                        <div class="emr_details">
                        </div>
                        <div class="action_btns">
                            <ul class="one_half_last">
                                <li><button class="btn btn-warning" id="Back" value="Back" type="button" style="color: #FF7171;"><i class="mdi-navigation-chevron-left"></i> Back</button></li>
                                <li class="reg-li"><input class="btn btn-success btn_red" id="register-btn" value="Register"></li>
                            </ul>
                        </div>   
                    </div>
                </form>
            </section>
        </div>
        <div id="model_doc" class="popupContainer" style="display:none;">
            <header class="popupHeader6">
                <span class="header_title">Employee docs uploading</span>
                <span class="modal_close"></span>
            </header>
            <section class="popupBody">
                <div><form id="docs-form" enctype="multipart/form-data">
                        <p id="upload-doc-err"></p>
                        Employee Email:<br>
                            <input type="text" name="emp_doc_email" id="emp-doc-emial" class="emp-doc-emial form-control" placeholder="Mail id of employe" style="height: 30px; width: 250px;">
                            <span class="bar"></span>
                        
                        <!--<ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="ui-id-1" tabindex="0" style="display: none;"></ul>-->
                        <div class="clearfix"></div>
                        <div class="upld-fle-itm">
                        Select Document:<br><input type="file" name ="empdoc" id="docs-file1">
                                    <select class="slct-month">
                                        <option value='0' selected>--Select Doc type--</option>
                                        <option value="1">10th</option>
                                        <option value="2">Bachelor</option>
                                        <option value="3">Experience</option>
                                        <option value="4">Address</option>
                                        <option value="4">Other</option>
                                    </select>
                                    <i class="mdi-content-add-circle-outline" id="pluse-doc"></i>
                        </div>
                                    <div class="clearfix"></div>
                                    <button class="btn btn-success" value="POST" id="upload-docs-butn" type="button" style="color: #FF7171;"><i class="mdi-file-cloud-upload" style="color: white"></i>Upload</button>
                       </form>
                       <!--<progress></progress>-->
                </div>
            </section>
        </div>
        <div id="model_holiday" class="popupContainer" style="display:none; ">
            <header class="popupHeader_holiday">
                <span class="header_title hldys">2015 Holidays</span>
                <span class="modal_close"></span>
            </header>
            <section class="popupBody holiday_section">
                <ul class="year_hldys">
                <?php $hldys = $this->get_hldys;?>
                <?php  for($i=0; $i<sizeof($hldys); $i++){?>
                <li class="holidays_li">
                    
                    <p class="hidden h_id"><?php echo $hldys[$i]["_holidays_id"]?></p>
                    <div class="holiday_img"><img src="/images/holidays/<?php echo $hldys[$i]['_holidays_id']?>.jpg" style="max-width: 82px;"></div>
                        <div class="holiday_date"><p class="h_day"><?php echo $hldys[$i]["_holidays_on"]?></p></div>
                        <div class="holiday_desc"><h5><?php echo $hldys[$i]["_holidays_title"]?></h5>
                            <p><?php  echo $hldys[$i]["_holidays_desc"]?></p>
                        </div>
                        <div class="select_hldy">
                            <?php $h_dyas = $this->chosen_hldys[0]['_holidays_chosen_id']; 
                                          $h_dyas = explode(',', $h_dyas);
                                          $temp = $hldys[$i]['_holidays_id'];
                                          $index = array_search($temp, $h_dyas);
                                          if($index >= 0 && $index !== false){
                                                  ?>
                            <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="hldys_chkbx" checked>
                                        </label>
                                    </div>
                                          <?php }else{?>
                            <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="hldys_chkbx">
                                        </label>
                            </div>
                                              <?php  } ?>
                        </div>
                    </li>
                <?php  }?>
                    </ul>
            </section>
            <footer class="popupfooter_holiday"><p class="note_hldy">Note: Choose before JAN 7th 2015</p>
                <span class="footer_title hldys">
                    <button class="btn btn-success"  id="hldy-btn" value="Save" type="button" style="color: white;">Save</button></span></footer>
        </div>
        
        <div id="model_holiday_hr" class="popupContainer" style="display:none; ">
            <header class="popupHeader_holiday">
                <span class="header_title hldys">2015 Holidays</span>
                <span class="modal_close"></span>
            </header>
            <div class="hr-hldy-fltr">
                <input id="emp_srch-list" class="emp_srch-list" type="text" placeholder="Search by name"><span class="srch_or">OR</span>
                <select id="srch-list_drpdn" class="emp_srch-list">
                                <option value='h0'>Search by day</option>   
                                <option value='h1'>New year</option>   
                                <option value='h2'>Sankranti</option>   
                                <option value='h3'>Republic Day</option>   
                                <option value='h4'>Shivaratri</option>   
                                <option value='h5'>Holi</option>
                                <option value='h6'>Ugadi</option>   
                                <option value='h7'>Good Friday</option>
                                <option value='h8'>May day</option>
                                <option value='h9'>Ramzan</option>
                                <option value='h10'>Independence Day</option>
                                <option value='h11'>Rakhi</option>
                                <option value='h12'>Vinayaka Chavithi</option>
                                <option value='h13'>Gandhi Jayanti</option>
                                <option value='h14'>Dasara</option>
                                <option value='h15'>Deepavali</option>
                                <option value='h16'>Christmas</option>
                            </select>
            </div>
            <section class="popupBody holiday_section holiday_section_hr">
               
                <ul class="year_hldys">
                <?php $hldys = $this->get_hldys;?>
                <?php  for($i=0; $i<sizeof($hldys); $i++){?>
                <li class="holidays_li">
                    <div class="holiday_img"><img src="/images/<?php echo $hldys[$i]['h_id']?>.jpg" style="max-width: 82px;"></div>
                        <div class="holiday_date"><p class="h_day"><?php echo $hldys[$i]["h_date"]?></p></div>
                        <div class="holiday_desc"><h5><?php echo $hldys[$i]["title"]?></h5>
                            <p><?php  echo $hldys[$i]["desc"]?></p>
                        </div>
                        <div class="select_hldy">
                            <input type="checkbox" class="hldys_chkbx">
                        </div>
                    </li>
                <?php  }?>
                    </ul>
            </section>
            <footer class="popupfooter_holiday"><p class="note_hldy">Note: Choose before JAN 7th 2015</p>
        </div>
        
        <div id="model_directory" class="popupContainer model_directory" style="display:none; ">
            <header class="popupHeader6">
                <span class="header_title">Directory</span>
                <span class="modal_close"></span>
            </header>
            <section class="popupBody">
                <select id="department_dir" name="department">
                                <option>Select Department</option>   
                                <option>Content</option>   
                                <option>Tech</option>   
                                <option>Marketing</option>   
                                <option>Communications</option>   
                                <option>HR</option>
                                <option>Operations</option>   
                                <option>Management</option>
                                <option>All</option>
                            </select>
                <table class="table table-hover table-condensed table-bordered" id="dir_tbl">
                    <tbody><tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Ph no</th>
                            <th>Department</th>
                        </tr>
<!--                        <tr>
                            <td align="center">Jeswanth reddy</td>
                            <td align="center">hr@saddahhaq.com</td>
                            <td align="center">9948983078</td>
                            <td align="center">HR</td>
                        </tr>-->

                    </tbody>
                    </table>
            </section>
        </div>
        
        <!--body starting here-->
        <div id="main">
        <div class="container all-content">
        <div class="main-content">
        <div class="news">We coudn't find any News!!!</div>
        <?php // if( $this->user_details[0]['notice_alert'] == 1){?>
        <div id="notifc"></div>
        <?php //}?>
        <?php // if( $this->user_details[0]['bdy_alert'] == 1){?>
        <div id="tdy-bdy"></div>
        <?php //}?>
        <script type="text/javascript">
            $(".modal_trigger6").leanModal({top: 10, overlay: 0.5, closeButton: ".modal_close"});
            $("#modal_trigger1").leanModal({top: 120, overlay: 0.5, closeButton: ".modal_close"});
            $.material.init();
        </script>
        <?php // var_dump($this->user_details)?> 