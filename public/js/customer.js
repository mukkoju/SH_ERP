$(document).ready(function(){
   
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
                for(var i=0; i<r.length; i++){
                $('#asgn-lst').find('.slct-itms').append('<li data-asgnmail="'+r[i]._emp_email+'">'+r[i]._emp_name+'</li>');
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
                for(var i=0; i<r.length; i++){
                $('#asgn-lst').find('.slct-itms').append('<li data-asgnmail="'+r[i]._emp_email+'">'+r[i]._emp_name+'</li>');
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
    
    $('.atrbt-itm .select-list').find('.select-menu-item ul').on('click', 'li', function(){
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
    
    
    
    $('#updt-tckt').click(function (){
       
       $.ajax({
            url: '/tickets/updt',
            type: 'post',
            data:{  'tp': 'asgn',
                    'ownr': $('.shw-tckt-opndby').data('ownreml'),
                    'tckt_id': $('.tckt-ttl').data('tcktid'),
                    'asgn1': $('#asgn-selctd').data('slctmail2'), 
                    'asgn2': $('#asgn-selctd').data('slctmail'), 
            }
        });
    });
    
});