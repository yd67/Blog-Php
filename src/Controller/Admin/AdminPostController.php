<?php

namespace App\Controller\Admin;

use App\Model\Post;
use App\Repo\PostRepository;
use DateTime;
use DateTimeZone;

class AdminPostController extends BaseAdminController
{

    public $postRepo;

    public function __construct()
    {
        parent::__construct();

        $this->postRepo = new PostRepository;
    }

    public function index()
    {
        $posts = $this->postRepo->findAll();

        $this->twig->display('admin/post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    public function addPost()
    {
        $info = [];
        $data = $_POST ;

        if (!empty($data)) {
            $data = $_POST ;
            $info = $data;

            if (!empty($data['title']) && !empty($data['chapo']) && !empty($data['auteur']) && !empty($_FILES['file']['name'])) {
                unset($_SESSION['error']);

                // treatment of images
                $file = $_FILES['file'];
                $extention = explode('.', $file['name']);
                $extention = $extention[1];
                $tmp_name = $file['tmp_name'];
                $imgName = 'post-' . time() . '.' . $extention;
                $path_dest = ROOT . '/public/upload/post/' . $imgName;
                move_uploaded_file($tmp_name, $path_dest);


                $post = new Post;

                $timeZone = new DateTimeZone('Europe/Paris');
                $current = new DateTime();
                $current->setTimezone($timeZone);


                $post->setTitle($data['title'])
                    ->setChapo($data['chapo'])
                    ->setAuteur($data['auteur'])
                    ->setContent($data['content'])
                    ->setImage($imgName)
                    ->setIsPublished($data['isPublished'])
                    ->setCreated_at($current->format('Y-m-d H:i:s'));
                $this->postRepo->create('post', $post);

                $this->redirect('adminPost');
            } else {
                $_SESSION['error'] = 'un ou plusieurs des champs obligatoires sont vide ';
            }
        }
        $this->twig->display('admin/post/addPost.html.twig', [
            'info' => $info,
        ]);
    }

    public function updatePost($arg)
    {

        $post = $this->postRepo->findBy('post', 'id', $arg);
        $data = $_POST ;

        if (!empty($data)) {

            $timeZone = new DateTimeZone('Europe/Paris');
            $date = new DateTime();
            $date->setTimezone($timeZone);
            $d =  $date->format('Y-m-d H:i:s');

            $postUpdate = $data;
            $postUpdate['updated_at'] = $d;

            if (!empty($_FILES['file']['name'])) {
                // treatment of images
                $file = $_FILES['file'];
                $extention = explode('.', $file['name']);
                $extention = $extention[1];
                $tmp_name = $file['tmp_name'];
                $imgName = 'post-' . time() . '.' . $extention;
                $path_dest = ROOT . '/public/upload/post/' . $imgName;
                move_uploaded_file($tmp_name, $path_dest);
                $postUpdate['image'] = $imgName;
            }

            $this->postRepo->update('post', $arg, $postUpdate);

            $this->redirect('adminPost');
        }

        $this->twig->display('admin/post/updatePost.html.twig', [
            'post' => $post,
        ]);
    }

    public function deletePost($id)
    {
        if (!empty($id)) {
            $this->postRepo->delete($id);
        }
        $this->redirect('adminPost');
    }
}
