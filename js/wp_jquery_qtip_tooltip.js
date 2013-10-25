//$(document).ready(function()
jQuery(document).ready(function()
{
    jQuery('a[title]').qtip({
        style: {
            name: wp_jquery_qtip_params.tooltip_color,
            tip: true,
            textAlign: 'center'
        },
        position: {
            corner: {
                target: wp_jquery_qtip_params.tooltip_target,
                tooltip: wp_jquery_qtip_params.tooltip_position
            }
        }
    });

    jQuery('area').each(function()
    {
        jQuery(this).qtip(
        {
            content: jQuery(this).attr('alt'),
            style: {
                name:  wp_jquery_qtip_params.tooltip_color,
                //border: {
                //    width: 0,
                //    radius: 4
                //},
                tip: true
            },
            position: {
                corner: {
                    target: wp_jquery_qtip_params.tooltip_target,
                    tooltip: wp_jquery_qtip_params.tooltip_position
                }
            }
        });
    });

});
