<?php
class RequestsController extends Controller
{
  public function AjaxAction($params = null)
  {
    $data = $this->model->GetData($params);

    $this->view->GetTemplate("DefaultPage.php", "RequestsView.php", $data);
  }
}