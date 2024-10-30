var $ = jQuery.noConflict();
// document ready
$(document).ready(function() {
    // Different Text for Archive and Single is checkbox is checked
    if ($('#wcatct_global_txt_diff').is(':checked')) {
        $('.wcatct_diff_txt_archive_single').removeClass('wcatct_disabled');
        $('.wcatct_global_txt_outer_wrap').addClass('wcatct_disabled');
    } else {
        $('.wcatct_diff_txt_archive_single').addClass('wcatct_disabled');
        $('.wcatct_global_txt_outer_wrap').removeClass('wcatct_disabled');
    }

    // Different Text for Archive and Single on change
    $('#wcatct_global_txt_diff').on('change', function() {
        if ($(this).is(':checked')) {
            $('.wcatct_diff_txt_archive_single').removeClass('wcatct_disabled');
            $('.wcatct_global_txt_outer_wrap').addClass('wcatct_disabled');
        } else {
            $('.wcatct_diff_txt_archive_single').addClass('wcatct_disabled');
            $('.wcatct_global_txt_outer_wrap').removeClass('wcatct_disabled');
        }
    });

    // Archive different product types is checkbox is checked
    if ($('#wcatct_product_type_txt_diff_archive').is(':checked')) {
        $('.wcatct_product_type_items_archive').removeClass('wcatct_disabled');
        $('.wcatct_archive_option_main').addClass('wcatct_disabled');
    }else{
        $('.wcatct_product_type_items_archive').addClass('wcatct_disabled');
        $('.wcatct_archive_option_main').removeClass('wcatct_disabled');
    }

    // Archive different product types on change 
    $('#wcatct_product_type_txt_diff_archive').on('change', function() {
        if ($(this).is(':checked')) {
            $('.wcatct_product_type_items_archive').removeClass('wcatct_disabled');
            $('.wcatct_archive_option_main').addClass('wcatct_disabled');
        }else{
            $('.wcatct_product_type_items_archive').addClass('wcatct_disabled');
            $('.wcatct_archive_option_main').removeClass('wcatct_disabled');
        }
    });

    // Single different product types is checkbox is checked
    if ($('#wcatct_product_type_txt_diff_single').is(':checked')) {
        $('.wcatct_product_type_items_single').removeClass('wcatct_disabled');
        $('.wcatct_single_options_main').addClass('wcatct_disabled');
    }else{
        $('.wcatct_product_type_items_single').addClass('wcatct_disabled');
        $('.wcatct_single_options_main').removeClass('wcatct_disabled');
    }

    // Single different product types on change 
    $('#wcatct_product_type_txt_diff_single').on('change', function() {
        if ($(this).is(':checked')) {
            $('.wcatct_product_type_items_single').removeClass('wcatct_disabled');
            $('.wcatct_single_options_main').addClass('wcatct_disabled');
        }else{
            $('.wcatct_product_type_items_single').addClass('wcatct_disabled');
            $('.wcatct_single_options_main').removeClass('wcatct_disabled');
        }
    });

});