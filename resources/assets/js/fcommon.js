/**
 * Created by Gary.P.Dong on 2016/6/29.
 */
jQuery(document).ready(function () {

    //Laravel csrf token verify
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});