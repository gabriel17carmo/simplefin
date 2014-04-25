<!-- File: /app/View/Posts/view.ctp -->
<?php
echo $this->Html->link('Edit Post', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id']));
?>
<br>
<br>
<h1><?php echo $post['Post']['title']?></h1>

<p><small>Created: <?php echo $post['Post']['created']?></small></p>

<p><?php echo $post['Post']['body']?></p>