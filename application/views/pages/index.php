<table class="table table-hover">
    <thead>
    <tr>
        <td>#</td>
        <td>Página</td>
        <td class="text-right">Ações</td>
    </tr>
    </thead>
    <tdoby>
        <?php foreach($pages as $page):  ?>
        <tr>
            <td><?php echo $page->id?></td>
            <td><?php echo $page->title?></td>
            <td>
                <a href="/pages/view/<?php echo $page->id;?>" class="btn  btn-success">
                    VER
                </a>
                <a href="/pages/edit/<?php echo $page->id;?>" class="btn  btn-info">
                    EDITAR
                </a>
                <form action="/pages/delete/<?php echo $page->id;?>" method="post" style="display: inline;">
                    <input type="submit" value="Remover" class="btn  btn-danger">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tdoby>
</table>