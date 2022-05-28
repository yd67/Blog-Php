<?php

namespace App\Controller\Admin ;

class AdminPostController extends BaseAdminController 
{

    public function index()
    {
        
        $this->twig->display('admin/articles/index.html.twig',[

        ]);
    }

    public function addPost()
    {
        if( !empty($_POST)){

              // treatment of images
            //   if (!empty($file)) {
            //     $extention = explode('.',$file['name']) ;
            //     $extention = $extention[1];
            //     $tmp_name = $file['tmp_name'] ;
                
            //     $imgName = 'profil-'.time().'.'.$extention ;
            //     $path_dest = ROOT.'/public/upload/post/'.$imgName ;

            //     move_uploaded_file($tmp_name,$path_dest);
            // }

            var_dump($_POST);
        }

        $this->twig->display('admin/articles/addPost.html.twig',[

        ]);
    }
}