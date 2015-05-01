<?php




namespace Kamran\TaxonomyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Kamran\TaxonomyBundle\Entity\Vocabulary;
use Kamran\TaxonomyBundle\Entity\VocabularyTerms;
use Kamran\TaxonomyBundle\Entity\Repository\TermsRepository;
use Kamran\TaxonomyBundle\Commons\TaxonomyHlp;
use Kamran\TaxonomyBundle\Form\Type\TermsType;
use Kamran\TaxonomyBundle\Model\FormModel;


/**
 * Taxonomy controller.
 *
 * @Route("/taxonomy")
 */

class IndexController extends Controller
{


    /**
     * @Route("/", name="vocabulary_index")
     * @Template("KamranTaxonomyBundle:Index:index.html.twig")
     */
    public function showVocabularyAction()
    {
        $vocabulary = $this->getDoctrine()->getRepository('KamranTaxonomyBundle:Vocabulary')->findAll();
        return array('vocabulary'=>$vocabulary);
    }

    /**
     *
     * @Route("/add", name="vocabulary_add")
     * @Template()
     */
    public function addVocabularyAction(){
        $entity = new Vocabulary();
        $form = $this->createForm('vocabulary_form',$entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     *
     * @Route("/create", name="vocabulary_create")
     * @Template("TaxonomyBundle:Index:add.html.twig")
     */
    public function createVocabularyAction(){

        $entity = new Vocabulary();
        $form = $this->createForm('vocabulary_form',$entity);
        $request = $this->getRequest();

        $form->handleRequest($request);

        if ($form->isValid()) {

            //$entity->setMachineName('abc');
            $entity->setWeight(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Vocabulary has been created.');

            return $this->redirect($this->generateUrl('vocabulary_add'));
        }
        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }


    /**
     *
     * @Route("/{id}/edit", name="vocabulary_edit")
     * @Template()
     */
    public function editVocabularyAction($id)
    {
        
        $entity = $this->getDoctrine()->getRepository('KamranTaxonomyBundle:Vocabulary')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vocabulary entity.');
        }

        $editForm = $this->createForm('vocabulary_form', $entity);
        $deleteForm = $this->createVocabularyDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     *
     * @Route("/{id}/update", name="vocabulary_update")
     * @Method("post")
     * @Template("KamranTaxonomy:Index:editvocabulary.html.twig")
     */
    public function updateVocabularyAction($id)
    {
        $entity = $this->getDoctrine()->getRepository('KamranTaxonomyBundle:Vocabulary')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vocabulary entity.');
        }

        $editForm = $this->createForm('vocabulary_form', $entity);
        $deleteForm = $this->createVocabularyDeleteForm($id);

        $request = $this->getRequest();
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vocabulary_index'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     *
     * @Route("/{id}/delete", name="vocabulary_delete")
     * @Method("post")
     */
    public function deleteVocabularyAction($id)
    {
        
        $form = $this->createVocabularyDeleteForm($id);
        
        $request = $this->getRequest();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('KamranTaxonomyBundle:Vocabulary')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vocabulary entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vocabulary_index'));
    }

    private function createVocabularyDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }



    /*
    *
    *   @Terms Actions
    *
    */



    /**
     * @Route("/term/{id}", name="terms_show")
     * @Template()
     */
    public function showTermsAction($id){

        $em = $this->getDoctrine()->getManager();
        $foundTerms = $em->getRepository('KamranTaxonomyBundle:VocabularyTerms')->findByVocabularyTerms(1);
        //$foundTerms = $em->getRepository('Kamran\TaxonomyBundle\Entity\Repository\VocabularyTermsRepository')->findByVocabularyTerms(1);
    }



    /**
     * @Route("/term/{id}/add", name="term_add")
     * @Template()
     */
    public function addTermAction($id)
    {


        $em = $this->getDoctrine()->getManager();

        $entity = new VocabularyTerms();
        $form = $this->createForm(new TermsType($id, $em  ) ,$entity);

        return array(
            'id' => $id,
            'entity' => $entity,
            'form'   => $form->createView()
        );
        
    }


    /**
     *
     * @Route("/term/{id}/create", name="terms_create")
     * @Template("KamranTaxonomyBundle:Index:addterm.html.twig")
     */
    public function createTermAction($id){

        $entity = new VocabularyTerms();
        $form = $this->createForm(new TermsType($id, $this->getDoctrine()->getManager()) ,$entity);


        $request = $this->getRequest();

        $form->handleRequest($request);

        if ($form->isValid()) {

            echo "<pre>";
            print_r($form->getData());
            echo "</pre>";

/*            echo "<pre>";
            print_r($request);
            echo "</pre>";
            exit();*/


            /*
            $em = $this->getDoctrine()->getManager();
            $vocabulary = $em->find("KamranTaxonomyBundle:Vocabulary", $id);
            $entity->setVid($vocabulary);
            $entity->setWeight(0);

            $em->persist($entity);
            $em->flush();
            */

            //return $this->redirect($this->generateUrl('terms_add'));

        }

        return array(
            'id' => $id,
            'entity' => $entity,
            'form'   => $form->createView()
        );

    }



}

