<ul class="list-group">
    <?php foreach($iterator as $row) { ?>
    <li class="list-group-item d-flex justify-content-between">
        <div><span class="expand_text btn btn-link" data-fulltext="<?=$row->instance_token?>"><?=substr($row->instance_token,0, 32)?>...</span></div>
        <div class="align-self-center"><?=$row->date->toDateTime()->format('d/m/Y H:i:s')?></div>
        <div>
            <i style="cursor:pointer;" onclick="showLogsOfInstance('<?=$row->instance_token?>');" class="fas fa-arrow-circle-right"></i>
            <i style="cursor:pointer;" onclick="expandInstanceData('<?=$row->_id?>');" class="fas fa-database"></i>
        </div>
    </li>
    <li class="list-group-item instance_data" id="<?=$row->_id?>" style="display:none;">
        <pre><?=json_encode($row->data)?></pre>
    </li>
    
    <?php } ?>
</ul>

<script>
function expandInstanceData(_id) {
    $(".instance_data:not(#"+_id+")").hide();
    $("#" + _id).toggle();
}
</script>