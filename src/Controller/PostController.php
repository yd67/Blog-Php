<?php

namespace App\Controller;

use App\Model\Comments;
use App\Repo\CommentsRepository;
use App\Repo\PostRepository;

class PostController extends MainController
{
    public function __construct()
    {
        parent::__construct();

        $this->postRepo = new PostRepository;
        $this->commentsRepo = new CommentsRepository;
    }

    public function index()
    {
        $post = $this->postRepo->getPublished();

        $this->twig->display('post/index.html.twig', [
            'post' => $post
        ]);
    }

    public function details($id)
    {
        $post = $this->postRepo->findBy('post', 'id', $id);
        $comment = $this->commentsRepo->validateComments($id);

        $this->twig->display('post/details.html.twig', [
            'post' => $post,
            'comment' => $comment
        ]);
    }

    public function addComments()
    {
        $data = $this->global->get_POST() ;
        $u =  $this->session->get('user') ;

        if ( !empty($data) && !empty($u)) {

            $com = htmlspecialchars($data['comment']);
            $postId = htmlspecialchars($data['postId']);

            $comment = new Comments();

            $timeZone = new \DateTimeZone('Europe/Paris');
            $date = new \DateTime();
            $date->setTimezone($timeZone);

            $comment->setPublished_at($date->format('Y-m-d H:i:s'))
                ->setEtat(2)
                ->setMessage($com)
                ->setUser_id($u['id'])
                ->setPost_id($postId);;

            $this->commentsRepo->create('comments', $comment);

            $this->redirect('post/details/'.$postId) ;
        }
    }
}
