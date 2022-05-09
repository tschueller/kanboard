<?php

namespace Kanboard\Controller;

/**
 * Board Popover Controller
 *
 * @package  Kanboard\Controller
 * @author   Frederic Guillot
 */
class BoardPopoverController extends BaseController
{
    /**
     * Confirmation before to close all column tasks
     *
     * @access public
     */
    public function confirmCloseColumnTasks()
    {
        $project = $this->getProject();
        $column_id = $this->request->getIntegerParam('column_id');
        $column_title = $this->columnModel->getColumnTitleById($column_id);
        $swimlane_id = $this->request->getIntegerParam('swimlane_id', null);
        if ($swimlane_id !== null) {
            $nb_tasks = $this->taskFinderModel->countByColumnAndSwimlaneId($project['id'], $column_id, $swimlane_id);
        } else {
            $nb_tasks = $this->taskFinderModel->countByColumnTitle($project['id'], $column_title);
        }

        $this->response->html($this->template->render('board_popover/close_all_tasks_column', array(
            'project' => $project,
            'nb_tasks' => $nb_tasks,
            'column' => $column_title,
            'swimlane' => $swimlane_id === null ? null : $this->swimlaneModel->getNameById($swimlane_id),
            'values' => array('column_id' => $column_id, 'swimlane_id' => $swimlane_id, 'column_title' => $column_title),
        )));
    }

    /**
     * Close all column tasks
     *
     * @access public
     */
    public function closeColumnTasks()
    {
        $project = $this->getProject();
        $values = $this->request->getValues();
        $column_id = $values['column_id'];
        $column_title = $this->columnModel->getColumnTitleById($column_id);
        $swimlane_id = $values['swimlane_id'];

        if ($swimlane_id !== '') {
            $this->taskStatusModel->closeTasksBySwimlaneAndColumn($swimlane_id, $column_id);
            $this->flash->success(t('All tasks of the column "%s" and the swimlane "%s" have been closed successfully.', $column_title, $this->swimlaneModel->getNameById($swimlane_id)));
        } else {
            $this->taskStatusModel->closeTasksByProjectAndColumnTitle($project['id'], $column_title);
            $this->flash->success(t('All tasks of the column "%s" have been closed successfully.', $column_title));
        }
        $this->response->redirect($this->helper->url->to('BoardViewController', 'show', array('project_id' => $project['id'])));
    }
}
