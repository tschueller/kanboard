<div class="page-header">
    <h2><?= t('Do you really want to close all tasks of this column?') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('BoardPopoverController', 'closeColumnTasks', array('project_id' => $project['id'])) ?>">
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('column_id', $values) ?>
    <?= $this->form->hidden('column_title', $values) ?>
    <?= $this->form->hidden('swimlane_id', $values) ?>

    <?php if ($swimlane !== null): ?>
        <p class="alert"><?= t('%d task(s) in the column "%s" and the swimlane "%s" will be closed.', $nb_tasks, $column, $swimlane) ?></p>
    <?php else: ?>
        <p class="alert"><?= t('%d task(s) in the column "%s" (in all swimlanes).', $nb_tasks, $column) ?></p>
    <?php endif; ?>

    <?= $this->modal->submitButtons(array(
        'submitLabel' => t('Yes'),
        'color' => 'red',
    )) ?>
</form>
