<?php $this->load->View("header"); ?>
            <?php foreach ($chat as $key => $value): ?>
            <li>
                <span class="chat-img pull-left">
                    <img src="<?php echo base_url(); ?>images/foto.gif" width="50px" height="50px"  alt="User Avatar" class="img-circle" />
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font"><?php echo $value['username']; ?></strong>
                        <small class="pull-right text-muted">
                            <i class="fa fa-clock-o fa-fw"></i> <?php echo $value['timestamp']; ?>
                        </small>
                    </div>
                    <p>
                        <?php echo $value['chat']; ?>
                    </p>
                </div>
            </li>

            <?php endforeach ?>
    <form action="<?php echo base_url(); ?>home/insertChat" method="post">
    <div class="panel-footer">
        <div class="input-group">
            <input id="btn-input" type="text" name="txtChat" class="form-control input-sm" placeholder="Type your message here..." />
            <span class="input-group-btn">
                <button class="btn btn-warning btn-sm" id="btn-chat">
                    Send
                </button>
            </span>
        </div>
    </div>
    </form>
<?php $this->load->View("footer"); ?>


