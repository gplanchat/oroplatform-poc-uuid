<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ticket;
use AppBundle\Form\Type\TicketType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ticket")
 */
class TicketController extends Controller
{
    /**
     * @return Response|array
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return [
            'gridName' => 'app-ticket-grid',
        ];
    }

    /**
     * @param Ticket $ticket
     *
     * @return Response|array
     *
     * @Route("/{uuid}/update")
     * @ParamConverter("node",
     *     class="AppBundle:Ticket",
     *     options={
     *         "mapping": {"uuid": "uuid"},
     *         "map_method_signature" = true,
     *     }
     * )
     * @Template()
     */
    public function createAction(Request $request)
    {
        return $this->update($request, new Ticket());
    }

    /**
     * @param Ticket $ticket
     *
     * @return Response|array
     *
     * @Route("/{uuid}/update")
     * @ParamConverter("node",
     *     class="AppBundle:Ticket",
     *     options={
     *         "mapping": {"uuid": "uuid"},
     *         "map_method_signature" = true,
     *     }
     * )
     * @Template()
     */
    public function updateAction(Request $request, Ticket $ticket)
    {
        return $this->update($request, $ticket);
    }

    /**
     * @param Ticket
     *
     * @return Response|array
     *
     * @Route("/{uuid}")
     * @ParamConverter("node",
     *     class="AppBundle:Ticket",
     *     options={
     *         "mapping": {"uuid": "uuid"},
     *         "map_method_signature" = true,
     *     }
     * )
     * @Template()
     */
    public function viewAction(Request $request, Ticket $ticket)
    {
        return [
            'entity' => $ticket,
            'id' => $ticket->getUuid(),
            'data' => [],
            'dataBlocks' => [],
        ];
    }
    /**
     * @param Request               $request
     * @param Ticket $ticket
     *
     * @return array|Response
     */
    private function update(Request $request, Ticket $ticket)
    {
        return $this->get('oro_form.update_handler')->update(
            $ticket,
            $this->createForm(TicketType::class),
            $this->get('translator')->trans('app.ticket.updated.label'),
            $request
        );
    }
}
