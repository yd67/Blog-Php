<?php

namespace App\Controller\Admin;

use App\Repo\CommentsRepository;

class AdminCommentController extends BaseAdminController
{

    public $commentRepo;

    public function __construct()
    {
        parent::__construct();

        $this->commentRepo = new CommentsRepository();
    }

    public function index()
    {
        $comment = $this->commentRepo->waitingComment();

        $this->twig->display('admin/comment/index.html.twig', [
            'comment' => $comment,
        ]);
    }

    public function acceptComment($id)
    {
        if (!empty($id)) {
            $this->commentRepo->approuveComment($id); 
            $this->redirect('adminComment');
        }
    }
}
