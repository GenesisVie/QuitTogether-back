<?php

namespace App\Controller\API;

use App\Entity\Blog;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * UserController
 * @Rest\Route("/api/blog", name="api_")
 */
class BlogController extends AbstractFOSRestController
{
    /**
     * List all blogs
     * @Rest\Get("/all")
     */
    public function getAllBlogs()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();
        $jsonObject = $serializer->serialize($blogs, 'json', [
            'circular_reference_handler' => function($object) {
                return $object;
            }
        ]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Get blog by Id
     * @Rest\Get("/id/{id}")
     */
    public function getBlogById($id)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $blog = $this->getDoctrine()->getRepository(Blog::class)->findOneBy(['id'=>$id]);
        if ($blog === null) {
            return new Response('{}', 500, ['Content-Type' => 'application/json']);
        }
        $jsonObject = $serializer->serialize($blog, 'json', [
            'circular_reference_handler' => function($object) {
                return $object;
            }
        ]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }
}
