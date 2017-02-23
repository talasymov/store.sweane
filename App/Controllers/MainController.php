<?php
class MainController extends Controller
{
    public function IndexAction($params = null)
    {
        $data = $this->model->GetData();

        $this->view->GetTemplate("DefaultPage.php", "MainView.php", $data);
    }
}