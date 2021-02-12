<ul class="list-group">
    <?php foreach($iterator as $row) { ?>
    <li class="list-group-item d-flex justify-content-between">
        <div><?=$row->message?></div>
        <div><?=$row->name?></div>
        <div>
            <?php foreach($row->tags as $tag) { ?>
                <span class="badge badge-secondary"><?=$tag?></span>
            <?php } ?>
            <?php if($row->level == 4) { ?>
                <span class="badge badge-success">Info</span>
            <?php } ?>
            <?php if($row->level == 3) { ?>
                <span class="badge badge-primary">Debug</span>
            <?php } ?>
            <?php if($row->level == 2) { ?>
                <span class="badge badge-warning">Warning</span>
            <?php } ?>
            <?php if($row->level == 1) { ?>
                <span class="badge badge-danger">Error</span>
            <?php } ?>
        </div>
        <div class="align-self-center"><?=$row->date->toDateTime()->format('d/m/Y H:i:s')?>.<?=$row->milliseconds?></div>
        <div><i style="cursor:pointer;" onclick="expandLogInfo('<?=$row->_id?>');" class="fas fa-arrow-circle-right"></i></div>
    </li>
    <li class="list-group-item log_info" style="display:none;" id="<?=$row->_id?>">
        <div class="d-flex justify-content-between">
            <div>id:</div>
            <div><?=$row->_id?></div>
        </div>
        <div class="d-flex justify-content-between">
            <div>Instance token:</div>
            <div class="btn btn-link" onclick="showLogsOfInstance('<?=$row->instance_token?>');"><?=$row->instance_token?></div>
        </div>
        <div class="d-flex justify-content-between">
            <div>Session token:</div>
            <div><?=$row->session_token?></div>
        </div>
        <?php if($row->data !== null) { ?>
        <pre><?=json_encode($row->data)?></pre>
        <?php } ?>
    </li>
    <?php } ?>
</ul>

<script>
function expandLogInfo(_id) {
    $(".log_info:not(#"+_id+")").hide();
    $("#" + _id).toggle();
}
</script>