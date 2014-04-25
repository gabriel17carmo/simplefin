<!-- File: /app/View/Posts/index.ctp -->


<?php 
function ConverteGrupo($grupoNum) {
    switch ($grupoNum) {
        case 1:
            return 'Administrador';
        case 2:
            return 'Usuário';
        default:
            return 'Erro!';
    }
}
$userName = $this->Session->read('Auth.User.nome');
?>
<table >
    <thead>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>


<p>Olá, <?php echo $userName; ?> ! Seja bem vindo(a) !</p>
<h4>Usuários</h4>
<table class="table table-hover">
    <thead>
        <tr class="">
            <th>ID</th>
            <th>Nome</th>
            <th>Login</th>
            <th>Grupo</th>
            <th>E-mail</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>

    <!-- Aqui é onde nós percorremos nossa matriz $posts, imprimindo
         as informações dos posts -->
    <tbody>

    <?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?php echo $usuario['Usuario']['id']; ?></td>
        <td><?php echo $usuario['Usuario']['nome']; ?></td>
        <td><?php echo $usuario['Usuario']['login']; ?></td>
        <td><?php echo ConverteGrupo($usuario['Usuario']['grupo']); ?></td>
        <td><?php echo $usuario['Usuario']['email']; ?></td>
        <td>
            <?php echo $this->Html->link('Editar',
array('controller' => 'usuarios', 'action' => 'edit', $usuario['Usuario']['id'])); ?>
        </td>
        <td>
<?php
if($usuario['Usuario']['id'] == $this->Session->read('Auth.User.id')){
    echo $this->Form->postLink('Deletar', array('controller' => 'usuarios', 'action' => 'delete_logout', $usuario['Usuario']['id']));
}else{
    echo $this->Form->postLink('Deletar', array('controller' => 'usuarios', 'action' => 'delete', $usuario['Usuario']['id']));
} ?>
        </td>
    </tr>
    <?php endforeach; ?>


    </tbody>
</table>

    <?php 
    echo $this->Html->link('Criar Usuário',
        array('controller' => 'usuarios', 'action' => 'add'),
        array('class' => 'btn btn-info')
    );
    ?>