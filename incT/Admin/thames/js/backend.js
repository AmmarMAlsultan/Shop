$(function(){
    'use strict';
    //Hide PLaceholdar input type text
    $(['placeholder']).focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    });

    $('input').each(function(){
        if($(this).attr('required') ==='required'){
            $(this).after('<span class="asterisk">*</span>')
        }
    });

    $('.confirm').click(function(){
        return confirm('Are Your Sory ?')
    });

});

