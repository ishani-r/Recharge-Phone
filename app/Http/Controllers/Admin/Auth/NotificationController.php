<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\NotificationDatatable;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function notificationList(NotificationDatatable $NotificationDatatable)
    {
        return $NotificationDatatable->render('admin.User.list-notification');
    }

    public function destroyNotifi($id)
    {   
        $data = Notification::find($id);
        $data->delete();
        return $data;
    }
}
