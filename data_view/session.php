<ul class="list-group">
    <?php foreach($iterator as $row) { ?>
    <li class="list-group-item d-flex justify-content-between">
        <div><span class="expand_text btn btn-link" data-fulltext="<?=$row->session_token?>"><?=substr($row->session_token,0, 32)?>...</span></div>
        <div class="align-self-center"><?=$row->date->toDateTime()->format('d/m/Y H:i:s')?></div>
        <div><i style="cursor:pointer;" onclick="showInstancesOfSession('<?=$row->session_token?>');" class="fas fa-arrow-circle-right"></i></div>
    </li>
    
    <?php } ?>
</ul>

<script>
function showInstancesOfSession(session_token) {
    $('#view_type_instance').prop('checked',true);
    $('input[name=session_token]').val(session_token);
    $('input[name=date_from], input[name=date_to]').val('');
    $('form').submit();
}
</script>