<?php
class MainController extends Controller
{
    public function IndexAction($params = null)
    {
        $this->view->GetTemplate("DefaultPage.php", "MainView.php");
    }
}