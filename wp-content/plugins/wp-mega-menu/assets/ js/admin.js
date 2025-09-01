jQuery(document).ready(function($) {
    // Make sure our fields are visible
    $('.menu-item-settings').each(function() {
        if (!$(this).find('.field-mega-menu').length) {
            $(this).append(`
                <div class="field-mega-menu description description-wide">
                    <label>
                        <input type="checkbox" 
                            name="menu-item-mega-menu[${$(this).closest('.menu-item').attr('id').replace('menu-item-', '')}]" 
                            value="1" />
                        Enable Mega Menu
                    </label>
                </div>
            `);
        }
    });
});