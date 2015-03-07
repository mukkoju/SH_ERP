$(document).ready(function () {

    $('#atr-cat').click(function () {
        $('#cat-list').toggle();
    });

    $('#atr-sb-cat').click(function () {
        $('#sb-cat-lst').toggle();
    });

    $('#atr-asgn').click(function () {
        $('#asgn-lst').find('.slct-itms').html('');
        $.ajax({
            url: '/customer_ticket/gtassingees',
            method: 'post',
            data: {'asgns': 'mngr'},
            success: function (d) {
                var r = JSON.parse(d);
                $('#asgn-lst').toggle();
                for (var i = 0; i < r.length; i++) {
                    $('#asgn-lst').find('.slct-itms').append('<li data-asgnmail="' + r[i]._emp_email + '">' + r[i]._emp_name + '</li>');
                }
            }
        });

    });

    $('#atr-asgn-to').click(function () {
        $('#asgn-lst').find('.slct-itms').html('');
        $.ajax({
            url: '/customer_ticket/gtassingees',
            method: 'post',
            data: {'asgns': 'emps'},
            success: function (d) {
                var r = JSON.parse(d);
                $('#asgn-lst').toggle();
                for (var i = 0; i < r.length; i++) {
                    $('#asgn-lst').find('.slct-itms').append('<li data-asgnmail="' + r[i]._emp_email + '">' + r[i]._emp_name + '</li>');
                }
            }
        });

    });

    $(document).click(function (e) {
        if ($(e.target).parents('.select-list').length == 0 && !$(e.target).hasClass("attr-lst")) {
            $('.select-list').css({'display': 'none'});
        }
        else if ($(e.target).parents('.select-list').length == 0 && $(e.target).siblings(".select-list").css("display") == "none") {
            $('.select-list').css({'display': 'none'});
        }
    });

    $('.select-list-rmv').click(function () {
        $('.select-list').css({'display': 'none'});
    });

    $('.atrbt-itm .select-list').find('.select-menu-item ul').on('click', 'li', function () {
        var txt = $(this).text();
        var mail = $(this).data('asgnmail');
        var cat = $(this).data('asgncat');
        var prnt = $(this).parents('.atrbt-itm');
        prnt.children('.atr-slctd').css({'background-color': 'rgb(7, 112, 138)', 'border-radius': '3px', 'font-weight': 'bold', 'color': 'white'})
        prnt.children('.atr-slctd').text(txt);
        prnt.children('.atr-slctd').data('slctmail', mail);
        prnt.children('.atr-slctd').data('slctcat', cat);
        $('.select-list').css({'display': 'none'});

    });

    $('#nw_tckt_btn').click(function (e) {
        e.preventDefault();
        
        var ttl = $('#ticket-subjct').val().trim();
        var desc = $('#ticket-description').val();
        var cat = $('#cat-selctd').data('slctcat').trim();
        var sb_cat = $('#sb-cat-selctd').text();
        var asgni = $('#asgn-selctd').data('slctmail').trim();
        
        if(ttl == ''){
            $('#ticket-subjct').css({'border-color': 'red'});
            $('.sts-strp').css({'background-color': '#f44336'}).html('<i class="icon-warning-sign"></i> Title cannot be left blank').fadeIn('slow');
            return;
        }else if(cat == ''){
            $('.sts-strp').css({'background-color': '#f44336'}).html('<i class="icon-warning-sign"></i> Please mention your ticket is related to wich category').fadeIn('slow');
            return;
        }else if(asgni == ''){
            $('.sts-strp').css({'background-color': '#f44336'}).html('<i class="icon-warning-sign"></i> We cannot resolve your ticket without assining any one').fadeIn('slow');
            return;
        }
        $.ajax({
            url: '/customer_ticket/add_ticket',
            method: 'post',
            data: {'ttl': ttl,
                'desc': desc,
                'catg': cat,
                'sb_catg': sb_cat,
                'asgni': asgni
            },
            success: function (d) {
                var data = JSON.parse(d);
                if(data.sts == 1){
                $('.sts-strp').css({'background-color': '#0f9d58'}).text('Ticket added successfully!! wait while we are redirecting to ticket page.').fadeIn('slow');
                 setTimeout(function () {
                    window.location = '/tickets/view/'+data.tckt_id;
                }, 2500);
            }else if(data.sts == 0){
                $('.sts-strp').css({'background-color': '#f44336'}).text('Sorry!! somthing went wrong while creting new ticket. please try again').fadeIn('slow');
            }
            }

        });
    });

    $('#asgn-lst').find('.slct-itms').on('click', 'li', function () {
        $.ajax({
            url: '/tickets/updt',
            type: 'post',
            data: {'tp': 'asgn',
                'ownr': $('.shw-tckt-opndby').data('ownreml'),
                'tckt_id': $('.tckt-ttl').data('tcktid'),
                'asgn1': $('#asgn-selctd').data('slctmail2'),
                'asgn2': $('#asgn-selctd').data('slctmail'),
            }
        });
    });
    
    $('#cmnt-tckt').click(function(){
       var nw_cmnt = $('#cmnt_vlue').val().trim();
       if(nw_cmnt == ''){
           $('.sts-strp').css({'background-color': '#f44336'}).html('<i class="icon-warning-sign"></i> Comment cannot be empty').fadeIn('slow');
       }
        $.ajax({
           url: '/tickets/updt',
           type: 'post',
           data: { 'tp': 'cmnt',
                   'ownr': $('.shw-tckt-opndby').data('ownreml'),
                   'tckt_id': $('.tckt-ttl').data('tcktid'),
                   'cmnt': nw_cmnt,
           },
           success: function(data){
               var d  = JSON.parse(data);
               if(d.sts == 0){
                   var p_pic = $('#lgdin_prfl_img').find('img').attr('src');
                   var nme = $('#lgdin_nme').find('b').text();
                   var cmnt_htm = '<div class="old-cmnts"><div class="comnt-prfle-img"><img src="'+p_pic+'"></div>';
                       cmnt_htm += '<div class="comnt_old_inpt"><div class="comnt_old_hdr"><b>'+nme+'</b><span class="cmntd_on"> Commented on '+new Date(d.addedon*1000)+'</span>';
                       cmnt_htm += '<span class="edt-cmnt"><i class="icon-pencil"></i></span></div><span class="cmnt-bdy"><p>'+nw_cmnt+'</p></span>';
                       cmnt_htm += '<textarea class="cmnt_edt_vlue" placeholder="Post a comment" data-cmnt_id="'+d.id+'">'+nw_cmnt+'</textarea>';
                       cmnt_htm += '<div class="cmnt-actns cmnt-edt-actns"><button class="btn btn-success updt-edt-cmnt">Update comment</button>';
                       cmnt_htm += '<button class="cls-opn-tckt cncl-cmnt-updt" data-type="clse">Cancel</button></div></div><div class="clearfix"></div>';
                       $('.old-cmnts-sctn').append(cmnt_htm);
                       $('#cmnt_vlue').val('');
                   }
           }
        });
    });
    
    $('.cls-opn-tckt').click(function(){
       $.ajax({
           url: '/tickets/updt',
           type: 'post',
           data: { 'tp': $(this).data('type'),
                   'tckt_id': $('.tckt-ttl').data('tcktid'),
           },
           success: function(d){
               if(d == 0){
                   $('.cls-opn-tckt').attr('data-type', 'ropn').text('Reopen Ticket');
               }
               else if(d == 1){
                   $('.cls-opn-tckt').attr('data-type', 'clse').text('Close Ticket');
               }
           }
        }); 
    });
    
    $('header').on('click', '.notfcn', function (){
      $('.notfcn_vew').toggle();
      
      if($('.notfcn').data("ntfnsize") > 0){
      $.ajax({
           url: '/tickets/ntf',
           type: 'post',
           data: { 'tp': 'read',
           },
           success: function(d){
               if(d == 0){
                   $('.notfcn').attr("data-ntfnsize", '0');
               }
           }
        });
    }
    });
    
    // filtering of tickets
//    $('.sb-nav-ul').find('li').click(function(){
//       $.ajax({
//          url: '/tickets/fltr',
//          type: 'post',
//          data: { 'tp': $(this).data('tp')}
//       });
//       
//    });
    
    $('.sb-nav-ul .sb-nav-li').click(function(e){
        
//       var $this = $(this);
//        var parent = $this.parent()
//        var color = $this.css('color');
//        if ($this.find(".rippl").length == 0) {
//            $this.append("<span class='rippl'></span>");
//        }
//        var rpl = $this.find(".rippl");
//        rpl.removeClass("animate");
//        if (!rpl.height() && !rpl.width())
//        {
//            var d = Math.max($this.outerWidth(), $this.outerHeight());
//            rpl.css({height: d, width: d});
//        }
//        var x = e.pageX - $this.offset().left - rpl.width() / 2;
//        var y = e.pageY - $this.offset().top - rpl.height() / 2;
//        rpl.css({top: y + 'px', left: x + 'px', 'background-color': '#f0f1f2', 'opacity': '0.5'}).addClass("animate");
        
//       setTimeout(function () {
//       $(this).css({'overflow': 'visible'});
       $(this).siblings('li').children('.drpdwn-lst').hide(); 
       $(this).children('.drpdwn-lst').toggle();
       $(this).siblings('li').css({'background-color': 'white', 'color': '#333', 'border-color': '#cccccc'});
       $(this).css({'background-color': '#009587', 'color': 'white', 'border': '1px solid #009587'});
//       }, 600);
    });
    
    
    $('#fltr-asgne').click(function(){
        $('#fltr-asgne').children('.drpdwn-lst').find('ul').html('');
              $.ajax({
            url: '/customer_ticket/gtassingees',
            method: 'post',
            data: {'asgns': 'emps'},
            success: function (d) {
                var r = JSON.parse(d);
                $('#asgn-lst').toggle();
                for (var i = 0; i < r.length; i++) {
                    $('#fltr-asgne').children('.drpdwn-lst').find('ul').append('<li data-slctd="' + r[i]._emp_email + '">' + r[i]._emp_name + '</li>');
                }
            }
    });
    });
    
    
    // filtering of tickets
    $('.drpdwn-lst').on('click', 'li', function(){
          $.ajax({
          url:  '/tickets/fltr',
          type: 'post',
          data: {'tp' : $(this).parents('.sb-nav-li').data('tp'), 
                 'slctd':$(this).data('slctd') },
          beforeSend: function () {
              $('.ligt-box').show();
          },
          success: function(data){
          var d = JSON.parse(data);
          if($('div').hasClass('chart') == true){
              $('.chart').css({'display': 'none'});
          }
          $('.tckts-tbls').html('');
          if(d.length > 0){
          var i;
          for(i=0; i< d.length; i++){
              var lod_tickts = '<tr><td><i class="icon-help"></i><a href="tickets/view/'+d[i]._Id_+'"><span class="ttl-lnk">'+d[i]._cust_servs_tckt_ttl+'</span>';
                  lod_tickts += '<span class="ttl-lnk-cat">'+d[i]._cust_servs_tckt_catg+'</span> ';
                  lod_tickts += '<span class="ttl-lnk-sbcat">'+d[i]._cust_servs_tckt_sbcatg+'</span></a>';
                  lod_tickts += '<div class="tckt-opnd-by">ticket opened on '+new Date(d[i]._cust_servs_tckt_addedon*1000)+' by '+d[i]._emp_name+'</div></td></tr>';
                  $('.tckts-tbls').append(lod_tickts);
              }
              $('.tbl-hdr').children('h2').text('Total '+d.length+' ticket (s)');
          }else{
              lod_tickts = '<tr><td style="height: 300px; background-color: rgba(238, 238, 238, 0.56)"><div class="ntg-fnd"><i class="icon-help"></i><h3>Sorry!! we couldn'+"'"+'t find any tickets.</h3></div></td></tr>';
              $('.tckts-tbls').append(lod_tickts);
              $('.tbl-hdr').children('h2').text('Total 0 tickets');
          }
         
          $('.ligt-box').hide();
          }
          
       });
       
    });
    
    $('#fltr_all').click(function(){
        window.location.reload();
    });
    
    $('#fltr_anlytcs').click(function(){
       
       $.ajax({url:  '/tickets/fltr',
          type: 'post',
          data: {'tp' : $(this).data('tp')},
          success: function(res){
              res = JSON.parse(res);
              var chrtData = {
                  1 : {
                      A : "Ticket Status",
                      B : "Last Week",
                      C : "Last Month",
                      D : "Last Year"
                  },
                  2 : {
                      A : "Pending",
                      B : res.lastweek.pending,
                      C : res.lastmonth.pending,
                      D : res.lastyear.pending,
                  },
                  3: {
                      A : "Closed",
                      B : res.lastweek.closed,
                      C : res.lastmonth.closed,
                      D : res.lastyear.closed,
                  },
                  4: {
                      A : "Created",
                      B : res.lastweek.total,
                      C : res.lastmonth.total,
                      D : res.lastyear.total,
                  }
              };
              var chtStr = '<div class="chart" id="tckt-cht"><h2 class="m-hd err-msg hideElement"></h2>' +
                '<ul class="cht-opts"></ul><svg class="svg"></svg><ul class="chart-tags"></ul>' +
                '</div>';
              $('#tckt-sts-dt').prepend(chtStr);
              $('#tckt-sts-dt').drawChart(chrtData, "l", $(window).width() - ($(window).width() / 4), 320, "tckt-cht", "1");
          } 
       });
    });
    
    $('#ttl-edt-btn').click(function(){
       $('.tckt-ttl h2').hide();
       $(this).hide();
       $('#nw-tckt-btn').hide();
       $('.edt-ttl').show();
       
    });
    
    $('#actn-cncl').click(function(){
        $('.edt-ttl').hide();
       $('.tckt-ttl h2').show();
       $('#ttl-edt-btn').show();
       $('#nw-tckt-btn').show();
       
       
    });
    
    $('#actn-sve').click(function(){
       var nw_ttl =  $('#edt-ttl-inpt').val().trim();
       if(nw_ttl == ''){
           $('#edt-ttl-inpt').css({'border-color': 'red'});
           return;
       }
       
       $.ajax({
           url: '/tickets/updt',
           type: 'post',
           data: {'tp': 'ttlupdt',
                  'tckt_id': $('#edt-ttl-inpt').data('tcktid'),
                  'ttl': nw_ttl },
               success: function(d){
                   
                   if(d == 0){
                       $('.edt-ttl').hide();
                       $('.tckt-ttl h2').show();
                       $('#ttl-edt-btn').show();
                       $('#nw-tckt-btn').show();
                       $('.tckt-ttl h2').text(nw_ttl);
                   }
                   
               }
       })
       
        
    });
    
    $('.old-cmnts-sctn').on('click', '.edt-cmnt', function(){
        $(this).hide();
       var cmt_blck = $(this).parents('.comnt_old_inpt'); 
       cmt_blck.children('.cmnt-bdy').hide();
       cmt_blck.children('.cmnt_edt_vlue').show().focus();
       cmt_blck.children('.cmnt-edt-actns').show();
    });
    
    
    $('.cncl-cmnt-updt').click(function(){
       var cmt_blck = $(this).parents('.comnt_old_inpt'); 
       cmt_blck.children('.cmnt_edt_vlue').hide();
       cmt_blck.children('.cmnt-edt-actns').hide();
       cmt_blck.children('.cmnt-bdy').show();
       $('.edt-cmnt').show();
    });
    
    $('.updt-edt-cmnt').click(function(){
        var cmt_blck = $(this).parents('.comnt_old_inpt');
        var nw_cmnt = cmt_blck.children('.cmnt_edt_vlue');
        
        if(nw_cmnt.val().trim() == ''){
           cmt_blck.children('.cmnt_edt_vlue').css({'border-color': 'red'});
           return;
       }
       $.ajax({
          url: '/tickets/updt',
           type: 'post',
           data: {'tp': 'cmntupdt',
                  'cmnt': nw_cmnt.val(),
                  'cmntid': nw_cmnt.data('cmnt_id'),
                 },
           success: function(d){
               if(d == 0){
                        cmt_blck.children('.cmnt_edt_vlue').hide();
                        cmt_blck.children('.cmnt-edt-actns').hide();
                        cmt_blck.children('.cmnt-bdy').show();
                        cmt_blck.children('.cmnt-bdy').find('p').text(nw_cmnt.val());
                        $('.edt-cmnt').show();
                   }
           }      
       }); 
    });
    
    
    $('#ticket-description').focus(function(){
       $('.atch-strp').css({bottom:'0px'}); 
    });
    
    $('#tckt-loamre-btn').click(function(){
        $.ajax({
           url: '/tickets/lodmre',
           method: 'post',
           data: {
             'pc': $('.tckts-tbls').find('td').length
           },
           success: function (data){
               var d = JSON.parse(data);
               if(d.length == 0){
                   $('#tckt-loamre-btn').attr('disabled','disabled');
               }
               for(var i=0; i<d.length; i++){
                    var htm = '<tr><td><i class="icon-help"></i><a href="tickets/view/' + d[i]._Id_ + '"><span class="ttl-lnk">' + d[i]._cust_servs_tckt_ttl + '</span>';
//                    if (d[i]._cust_servs_tckt_catg != '') {
                        htm += '<span class="ttl-lnk-cat">' + d[i]._cust_servs_tckt_catg + '</span>';
//                    };
//                    if (d[i]._cust_servs_tckt_sbcatg += '') {
                        htm += ' <span class="ttl-lnk-sbcat">' + d[i]._cust_servs_tckt_sbcatg + '</span>';
//                    };
                    htm += '</a><div class="tckt-opnd-by">ticket opened on '+new Date(d[i]._cust_servs_tckt_addedon*1000)+' by ' + d[i]._emp_name + '</div></td></tr>';
                    $('.tckts-tbls').append(htm);
           }
           }
        });
    });
    
});