<?php


    /**
     *
     */
    class SiteController
    {

      public function actionHome()
      {
        $pageData = New Voopsc\DataReciver;

        $postList = [];
        $postList = $pageData->getDataAsArray(ROOT . '/template/posts-data.php');

        require_once(ROOT . '/template/layout.php');
        return true;
      }

      public function actionTest($param = '')
      {

        Functions::debug($param);
      }

      // end of class
    }
