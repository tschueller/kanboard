<!-- added by TSC, 04.02.2022: Show the estimated/spent time of all tasks in a column -->
<tr class="board-swimlane-columns-overview">
    <?php foreach ($swimlane['columns'] as $column): ?>
    <th class="board-column-header board-column-header-overview board-column-header-<?= $column['id'] ?>" data-column-id="<?= $column['id'] ?>">

        <!-- column in collapsed mode -->
        <div class="board-column-collapsed">
        </div>

        <!-- column in expanded mode -->
        <div class="board-column-expanded-header">
            <span class="board-column-title">
                    <span class="dropdown">
                        <!-- TODO move inline styles to board.css -->
                        <a href="#" class="dropdown-menu" style="font-style: italic; color: var(--color-light);">
                            <?= $column['title']; ?> Total
                            (<?= $column['nb_open_tasks']; ?>)
                            <?= $overview['columns'][$column['id']]['time_estimated_or_spent']; ?>h
                            <i class="fa fa-caret-down" style="color: var(--color-light);"></i></a>
                        <ul>
                            <li>
                                <i class="fa fa-minus-square fa-fw"></i>
                                <a href="#" class="board-toggle-column-view" data-column-id="<?= $column['id'] ?>"><?= t('Hide this column') ?></a>
                            </li>

                            <?php if ($column['nb_tasks'] > 0 && $this->projectRole->canChangeTaskStatusInColumn($column['project_id'], $column['id'])): ?>
                                <li>
                                    <?= $this->modal->confirm('close', t('Close all tasks of this column'), 'BoardPopoverController', 'confirmCloseColumnTasks', array('project_id' => $column['project_id'], 'column_id' => $column['id'], 'swimlane_id' => null)) ?>
                                </li>
                            <?php endif ?>
                        </ul>
                    </span>
            </span>
            <span class="pull-right">
            </span>
        </div>

    </th>
    <?php endforeach ?>
</tr>
