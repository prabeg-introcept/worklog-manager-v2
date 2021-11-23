<?php

namespace App\Constants;

final class FlashMessages
{
    const SUCCESS_REGISTER_USER = 'User registration successful. Login to continue.';
    const ERROR_FETCH_WORKLOG = 'Error while fetching worklog(s).';
    const SUCCESS_CREATE_WORKLOG = 'Worklog created successfully.';
    const ERROR_CREATE_WORKLOG = 'Error while creating worklog.';
    const SUCCESS_UPDATE_WORKLOG = 'Worklog updated successfully.';
    const ERROR_UPDATE_WORKLOG_ON_DIFFERENT_DATE = 'Worklogs can be updated only on the day they are created.';
    const ERROR_UPDATE_WORKLOG = 'Error while updating worklog.';
    const SUCCESS_DELETE_WORKLOG = 'Worklog deleted successfully.';
    const ERROR_DELETE_WORKLOG = 'Error while deleting worklog.';
    const SUCCESS_CREATE_FEEDBACK = 'Feedback created successfully.';
    const ERROR_CREATE_FEEDBACK = 'Error while creating feedback.';
    const SUCCESS_UPDATE_FEEDBACK = 'Feedback updated successfully.';
    const ERROR_UPDATE_FEEDBACK = 'Error while updating feedback.';
    const SUCCESS_DELETE_FEEDBACK = 'Feedback deleted successfully.';
    const ERROR_DELETE_FEEDBACK = 'Error while deleting feedback.';
}
