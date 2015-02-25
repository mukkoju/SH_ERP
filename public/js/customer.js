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
        var prnt = $(this).parents('.atrbt-itm');
        prnt.children('.atr-slctd').css({'background-color': 'rgb(7, 112, 138)', 'border-radius': '3px', 'font-weight': 'bold', 'color': 'white'})
        prnt.children('.atr-slctd').text(txt);
        prnt.children('.atr-slctd').attr('data-slctmail', mail);
        $('.select-list').css({'display': 'none'});

    });

    $('#nw_tckt_btn').click(function (e) {
        e.preventDefault();

        var ttl = $('#ticket-subjct').val();
        var desc = $('#ticket-description').val();
        var cat = $('#cat-selctd').text();
        var sb_cat = $('#sb-cat-selctd').text();
        var asgni = $('#asgn-selctd').data('slctmail');

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
                alert(d);
            }

        });
    });

    $('#updt-tckt').click(function () {

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
       
        $.ajax({
           url: '/tickets/updt',
           type: 'post',
           data: { 'tp': 'cmnt',
                   'ownr': $('.shw-tckt-opndby').data('ownreml'),
                   'tckt_id': $('.tckt-ttl').data('tcktid'),
                   'cmnt': $('#cmnt_vlue').val(),
           }
        });
    });
    
    $('.cls-opn-tckt').click(function(){
       $.ajax({
           url: '/tickets/updt',
           type: 'post',
           data: { 'tp': $(this).data('type'),
                   'tckt_id': $('.tckt-ttl').data('tcktid'),
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
    
    $('.sb-nav-ul .sb-nav-li').click(function(){
       $(this).siblings('li').children('.drpdwn-lst').hide(); 
       $(this).children('.drpdwn-lst').toggle();
       $(this).siblings('li').css({'background-color': 'white', 'color': '#333'});
       $(this).css({'background-color': 'rgba(0, 0, 0 , .75)', 'color': 'white'});
    });
    
    
    $('#fltr-asgne').click(function(){
        $('#fltr-asgne').children('.drpdwn-lst').find('ul').html('');
              $.ajax({
            url: '/customer_ticket/gtassingees',
            method: 'post',
            data: {'asgns': 'mngr'},
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
          }else{
              lod_tickts = '<tr><td style="height: 300px; background-color: rgba(238, 238, 238, 0.56)"><div class="ntg-fnd"><i class="icon-help"></i><h3>Sorry!! we couldn'+"'"+'t find any tickets.</h3></div></td></tr>';
              $('.tckts-tbls').append(lod_tickts);
          }
         
          $('.ligt-box').hide();
          }
          
       });
       
    });
    
    $('#fltr_all').click(function(){
        window.location.reload();
    });
});