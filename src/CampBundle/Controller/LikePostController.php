<?php

namespace CampBundle\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use CampBundle\Entity\likePost;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LikePostController extends Controller
{

    public function likepostAction(Request $request){

        $user = $this->getUser();

        if(!$user) {
            return new JsonResponse(array('check'=>false));
        }

        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('CampBundle:blog')->find($id);
        $like = $em->getRepository('CampBundle:LikePost')->findOneBy(array('post'=>$blog,'user'=>$user));

        if($like){
            $em->remove($like);
            $em->flush();
            return new JsonResponse('dislike');

        }else {
            $like = new LikePost();
            $like->setPost($blog);
            $like->setUser($user);

            $em->persist($like);
            $em->flush();

            return new JsonResponse('like');
        }



    }

    public function affichepostAction()
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $likes = $em->getRepository('CampBundle:likePost')->findBy(array('user'=>$user));
        $blog=$em->getRepository('CampBundle:blog')->findAll();

        return $this->render('@Camp/blog/affichepostlike.html.twig',array('blog'=> $blog , 'likes'=>$likes));
    }

}
