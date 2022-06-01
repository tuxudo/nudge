<div id="nudge-tab"></div>
<h2 data-i18n="nudge.nudge"></h2>

<script>
$(document).on('appReady', function(){
    $.getJSON(appUrl + '/module/nudge/get_tab_data/' + serialNumber, function(data){
       
        var skipThese = ['id','serial_number','serial'];
        $.each(data, function(i,d){

            // Generate rows from data
            var rows = ''
            for (var prop in d){
                // Skip skipThese
                if(skipThese.indexOf(prop) == -1){
                    // Do nothing for empty values to blank them
                    if (d[prop] == '' || d[prop] == null){
                        rows = rows

                    // Format connected
                    } else if(prop == "deferral_date" || prop.includes("_event")){
                        var date = new Date(d[prop] * 1000);
                        rows = rows + '<tr><th>'+i18n.t('nudge.'+prop)+'</th><td>'+moment(date).fromNow()+' - '+moment(date).format('llll')+'</td></tr>';

                    // Format newlines
                    } else if(prop == "json_config" || prop == "profile_config"){
                        rows = rows + '<tr><th>'+i18n.t('nudge.'+prop)+'</th><td>'+d[prop].replace(/\n/g, "<br>").replace(/\\n/g, "<br>").replace(/ /g, "&nbsp;")+'</td></tr>';
                    } else if(prop == "nudge_log"){
                        rows = rows + '<tr><th>'+i18n.t('nudge.'+prop)+'</th><td>'+d[prop].replace(/\n/g, "<br>").replace(/\\/g, "")+'</td></tr>';

                    // Format Yes/No
                    } else if(prop == 'past_required_install_date' && d[prop] == "1"){
                        rows = rows + '<tr><th>'+i18n.t('nudge.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'past_required_install_date' && d[prop] == "0"){
                        rows = rows + '<tr><th>'+i18n.t('nudge.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';

                                            
                    // Else, build out rows
                    } else {
                        rows = rows + '<tr><th>'+i18n.t('nudge.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    }
                }
            }
            
            $('#nudge-tab')
                .append($('<div style="max-width:1600px;">')
                    .append($('<table>')
                        .addClass('table table-striped table-condensed')
                        .append($('<tbody>')
                            .append(rows))))
               
        })
    });
});
</script>
