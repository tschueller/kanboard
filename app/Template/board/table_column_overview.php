<!-- added by TSC, 04.02.2022: Show the estimated/spent time of all tasks in a column -->
<tr class="board-swimlane-columns-overview">
    <?php foreach ($swimlane['columns'] as $column): ?>
    <th class="board-column-header board-column-header-overview board-column-header-<?= $column['id'] ?>" data-column-id="<?= $column['id'] ?>">

        <!-- column in collapsed mode -->
        <div class="board-column-collapsed">
        </div>

        <!-- column in expanded mode -->
        <div class="board-column-expanded-header">
            <!-- TODO move inline styles to board.css -->
            <span class="board-column-title" style="font-style: italic; color: var(--color-light);">
                <?= $column['title']; ?> Total
                (<?= $column['nb_open_tasks']; ?>)
                <?= $overview['columns'][$column['id']]['time_estimated_or_spent']; ?>h
            </span>

            <span class="pull-right">
            </span>
        </div>

    </th>
    <?php endforeach ?>
</tr>
