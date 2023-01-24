jQuery(document).ready(function () {
    "use strict";

    var SaveEntries = function save(form = null, reset = null, refresh = null) {
        jQuery(form).ajaxForm({
            success: function (response) {
                if (response.success) {

                    jQuery(success_msg(response.data.message)).insertBefore(form);
                   
                    if (reset == true) {
                        jQuery(form)[0].reset();
                    }
                    if (refresh == true) {
                        location.reload(); 
                    }

                } else {
                    jQuery(error_msg(response.data.message)).insertBefore(form);
                }
            },
            error: function (response) {
                jQuery(error_msg(response.data.message)).insertBefore(form);
            }
        });
    }
    var DeactivateEntities = function (selector) {
		jQuery(document).on( 'click', selector, function (e) {
	        e.preventDefault();
            var action = 'swrj_deactivate_entities_action';
	        var id     = jQuery( this ).attr( 'data-id' );
	        var nounce = ajax_admin.swrj_nonce;
	        var table = jQuery( this ).attr( 'data-table' );
            var tbl = $(this).closest('table');

			jQuery.ajax({
				url: ajax_admin.ajax_url,
				type: "POST",
				data: {
					action: action,
					nounce: nounce,
					id: id,
					table: table,
				},
				success: function(response) {
					if (response) {
						if ( response.status == "error" ) {
                            jQuery(error_msg(response.message)).insertBefore(tbl);
						} else {
                            reload();
                            jQuery(success_msg(response.message)).insertBefore(tbl);
						}
					}
				}
			});
	    });
	}

    function reload(){
        setTimeout(function() {
            location.reload();
        }, 2000);
    }

    /* Save Entities */
    var saveTeams = new SaveEntries('#AddTeamsForm', true, true);
    var editTeams = new SaveEntries('#EditTeamsForm', true, true);

    var AddMembersForm = new SaveEntries('#AddMembersForm', true, false);
    var EditMembersForm = new SaveEntries('#EditMembersForm', false, false);

    /* Delete Entities */
    var deactivateEntities   = new DeactivateEntities( '.deactivate-entities');


    function error_msg(message) {
        var msg = `<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    `+ message + `
                    </div> `;
        return msg;
    }
    function info_msg(message) {
        var msg = `<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Alert!</h5>
        `+ message + `</div>`;

        return msg;
    }
    function success_msg(message) {
        var msg = ` <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        `+ message + `</div>`;

        return msg;
    }

});