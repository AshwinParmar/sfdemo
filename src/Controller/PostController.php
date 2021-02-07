<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Form\PostType;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
	 * @return Response
     */
    public function index(PostRepository $postRepository): Response
    {
		// Get list of posts from DB
		$posts = $postRepository->findAll();
		
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
	
    /**
     * @Route("/create", name="create")
	 * @param Request $request
     */
    public function create(Request $request): Response
    {
		// Create a new Post with title
		/*$post = new Post();
		$post->setTitle("Post - " . rand(1, 100000));
		// Get Entity Manager
		$entityManager = $this->getDoctrine()->getManager();
		// Persist Post
		$entityManager->persist($post);
		// Create entity in DB
		$entityManager->flush();
		
		$this->addFlash('success', 'Post <strong>' . $post->getTitle() . '</strong> was created.');
		
		return $this->redirect($this->generateUrl('post.index'));
		*/
		
		$post = new Post();
		$form = $this->createForm(PostType::class, $post);
		$form->handleRequest($request);
		
		if ($form->isSubmitted()) {
			// Get Entity Manager
			$entityManager = $this->getDoctrine()->getManager();
			// Persist Post
			$entityManager->persist($post);
			// Create entity in DB
			$entityManager->flush();
			
			$this->addFlash('success', 'Post <strong>' . $post->getTitle() . '</strong> was created.');
			
			return $this->redirect($this->generateUrl('post.index'));
		}
		
		return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
	
	/**
	 * @Route("/show/{id}", name="show")
	 * @param Post $post
	 * @return Response
	 */
	public function show(Post $post): Response
	{
		// Get list of posts from DB
		// function show($id, PostRepository $postRepository)
		// $post = $postRepository->find($id);
		
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
	}
	
    /**
     * @Route("/remove/{id}", name="remove")
	 * @param Post $post
     */
    public function remove(Post $post): Response
    {
		$title = $post->getTitle();
		// Get Entity Manager
		$entityManager = $this->getDoctrine()->getManager();
		// Persist Post
		$entityManager->remove($post);
		// Create entity in DB
		$entityManager->flush();
		
		$this->addFlash('warning', 'Post <strong>' . $title . '</strong> was removed.');

		return $this->redirect($this->generateUrl('post.index'));
    }
}
