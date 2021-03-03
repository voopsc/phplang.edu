<?php


    /** Class for work on blog database
     *
     */
    class BlogMapper
    {

      /** Get post list for user
      * @return array with data from db
      */
      public function getUserPostList()
      {
        $db = new Db;
        $connection = $db->getConnection();

        $sql = 'SELECT * FROM blog WHERE status = "1" ORDER BY sort_order DESC';

        $result = $connection->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $i = 0;
        $list = array();
        while ($row = $result->fetch()) {
            $list[$i]['post_title'] = $row['post_title'];
            $list[$i]['post_description'] = $row['post_description'];
            $list[$i]['post_button_text'] = $row['post_button_text'];
            $list[$i]['url'] = $row['url'];
            $i++;
        }
        return $list;
      }

      // end of class
    }
