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
    const ERROR_DELETE_WORKLOG = 'Error while updating worklog.';

}
