<?php

namespace App\Controller\Admin;

use App\Model\Post;
use App\Repo\MainRepository;
use App\Repo\PostRepository;
use DateTime;
use DateTimeZone;

class AdminPostController extends BaseAdminController
{

    public function index()
    {
        $this->twig->display('admin/articles/index.html.twig', []);
    }

    public function addPost()
    {
        $info = [];
        if (!empty($_POST)) {
            $info = $_POST;

            if (!empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['auteur']) && !empty($_FILES['file']['name'])) {
                unset($_SESSION['error']);

                // treatment of images
                $file = $_FILES['file'];
                $extention = explode('.', $file['name']);
                $extention = $extention[1];
                $tmp_name = $file['tmp_name'];
                $imgName = 'post-' . time() . '.' . $extention;
                $path_dest = ROOT . '/public/upload/post/' . $imgName;
                move_uploaded_file($tmp_name, $path_dest);

                $isPublished = false;
                if (!empty($_POST['isPublished'])) {
                    $isPublished = $_POST['isPublished'];
                }

                $repo = new PostRepository;
                $post = new Post;

                $post->setTitle($_POST['title'])
                    ->setChapo($_POST['chapo'])
                    ->setAuteur($_POST['auteur'])
                    ->setContent($_POST['content'])
                    ->setImage($imgName)
                    ->setIsPublished($isPublished)
                    ->setCreated_at();
                $repo->create('post', $post);
                header('Location: index.php?path=adminPost');
                die();
            } else {
                $_SESSION['error'] = 'un ou plusieurs des champs obligatoires sont vide ';
            }
        }
        $this->twig->display('admin/articles/addPost.html.twig', [
            'info' => $info,
        ]);
    }
}
