<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/11/15
 * Time: 19:19
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{
    /**
     * @Route("/user_index", name="user")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('/user/index.html.twig');
    }

    /**
     * @Route("/user_mostrar", name="mostrar")
     */
    public function mostrarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        return $this->render(
            ':user:mostrar.html.twig',
            [
                'users' => $users,
            ]
        );
    }

    /**
     * @Route("/user_insert", name="app_user_insert")
     */
    public function insertAction()
    {
        return $this->render('/user/insert.html.twig');
    }
    /**
     * @Route("/user_do-insert", name="app_user_doInsert")
     */

    public function doInsertAction(Request $request)
    {
        $user = $this->get('app.entity.user');
        $usuario = $request->request->get('user');
        $password = $request->request->get('pass');
        $email = $request->request->get('mail');
        if ($usuario != null && $password != null && $email != null){
            $user->setUsername($usuario);
            $user->setPassword($password);
            $user->setEmail($email);
            $user->setCreatedAt(new \Datetime("now"));
            $user->setUpdatedAt(new \Datetime("now"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->render(
                ':user:do-insert.html.twig',
                [
                    'user' => $usuario,
                    'title' => 'Usuario añadido',
                ]
            );
        }/**retornar vista error*/
    }

    /**
     * @Route("/user_update", name="app_user_update")
     */
    public function updateAction()
    {
        return $this->render('/user/update.html.twig');
    }
    /**
     * @Route("/user_do-update", name="app_user_doUpdate")
     */

    public function doUpdateAction(Request $request)
    {
        $username = $request->get('user');
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $em = $this->getDoctrine()->getManager();
        $user = $repository->findOneBy(array('username' => $username));
        if (!$user){
            throw $this->createNotFoundException('Usuario con este nombre no encontrado');
        }
        $password = $request->request->get('pass');
        $email = $request->request->get('mail');
        if ($password == null){
            $password = $user->getPassword();
        }
        if ($email == null){
            $email = $user->getEmail();
        }
        $user->setPassword($password);
        $user->setEmail($email);
        $user->setUpdatedAt(new \Datetime("now"));
        $em->flush();
        return $this->render(
            ':user:do-update.html.twig',
            [
                'user' => $username,
                'title' => 'Usuario modificado',
            ]
        );
    }
    /**
     * @Route("/user_delete", name="app_user_delete")
     */
    public function deleteAction()
    {
        return $this->render('/user/delete.html.twig');
    }
    /**
     * @Route("/user_do-delete", name="app_user_doDelete")
     */

    public function doDeleteAction(Request $request)
    {

            $username = $request->get('user');
            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            $em = $this->getDoctrine()->getManager();
            $user = $repository->findOneBy(array('username' => $username));
            if (!$user){
                throw $this->createNotFoundException('Usuario con este nombre no encontrado');
            }
            $em->remove($user);
            $em->flush();
            return $this->render(
                ':user:do-delete.html.twig',
                [
                    'user' => $username,
                    'title' => 'Usuario eliminado',
                ]
            );

    }
}