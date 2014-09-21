<?php

namespace healthlife\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('healthlifeUserBundle:Default:index.html.twig', array('name' => $name));
    }
    
    /**
 * public function showAction($id=1)
 *     {
 *         $product = $this->getDoctrine()
 *         ->getRepository('healthlifeUserBundle:HealthCondition')
 *         ->find($id);var_dump($product);

 *     $categoryName = $product->getSymptom()->getName();echo $categoryName;die;

 *     }
 */
 
    /**
     * Lists all HealthCondition entities.
     *
     * //@Route("/", name="healthcondition")
     * //@Method("GET")
     * @Template()
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('healthlifeUserBundle:HealthCondition')->findAll();
        
        foreach($entities as $data)
        {
            $condName = $data->getName();
            $symptom = $data->getSymptom()->getName();
            $entitiesArr[$condName][] = $symptom;
        }//var_dump($entitiesArr);die;

        return array(
            'entities' => $entitiesArr,
        );
    }
}
